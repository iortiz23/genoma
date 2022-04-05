<?php

date_default_timezone_set('America/Bogota');
require_once('DataBase.class.php');
require_once('EnvioCorreo.class.php');
require_once ('loadFiles/loadFiles.class.php');

/**
 * Description of CapturaInformacion
 *
 * @author Sneider Rocha
 */
class CapturaInformacion {

    var $codigo_campana = '00250';
    var $baseUsuarios = '[Usuarios].[dbo].';

    public function __construct() {
        $this->database = DataBase::getDatabaseObject(DataBase::MYSQL);
    }

    public function getDatosUsuario($_usuario, $_password) {
        $sql = " SELECT IdPerson, Name, Email, Passw, PasswUpdate, IdProfile  "
                . "FROM tb_person "
                . "WHERE State = 1 AND Email = '" . trim($_usuario) . "'";
        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            if (sha1($_password) === $row['Passw']) {
                if ($row['PasswUpdate'] === '1') {
                    $_SESSION['Email'] = trim($row['Email']);
                    $_SESSION['Passw'] = trim($row['Passw']);
                    header("Location: ../login/recover-password.php");
                } else {
                    $_SESSION['IdPerson'] = $row['IdPerson'];
                    $_SESSION['Name'] = $row['Name'];
                    $_SESSION['IdProfile'] = $row['IdProfile'];
                    header("Location: ..\index.php");
                }
            } else {
                $data = 'Contraseña incorrecta';
            }
        } else {
            $data = 'Credenciales incorrectas';
        }
        return $data;
    }

    public function setNewPassword($_email) {
        $sql = " SELECT IdPerson, Name, Email, Passw, IdProfile "
                . "FROM tb_person "
                . "WHERE State = 1 AND Email = '" . trim($_email) . "'";
        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            if ($_email === $row['Email']) {

                $newPasword = $this->getNewPassword();
                $envioCorreo = new EnvioCorreo();
                $resulEnvio = $envioCorreo->enviaCorreoDuponte($_email, $newPasword);
                $queryUpdate = "UPDATE tb_person SET Passw = SHA1('" . $newPasword . "'), PasswUpdate = 1 WHERE IdPerson = " . $row['IdPerson'];
                $data = $this->database->query($queryUpdate);
                $resulEnvio = 'Tu nueva contraseña fue enviada exitosamente al correo: ' . $_email;
            } else {
                $resulEnvio = 'No existe el Correo: ' . $_email;
            }
        } else {
            $resulEnvio = 'No existe el Correo: ' . $_email;
        }
        return $resulEnvio;
    }

    public function getNewPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function setPassword($_email, $_password_old, $_password_new) {
        $sql = " SELECT IdPerson, Name, Email, Passw, IdProfile "
                . "FROM tb_person "
                . "WHERE State = 1 AND Email = '" . $_email . "' AND Passw = SHA1('" . $_password_old . "')";

        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $queryUpdate = "UPDATE tb_person SET Passw = SHA1('" . $_password_new . "'), PasswUpdate = 0 WHERE IdPerson = " . $row['IdPerson'];
            $data = $this->database->query($queryUpdate);
            $resulEnvio = 'EXITOSO';
        } else {
            $resulEnvio = 'NOEXITOSO';
        }
        return $resulEnvio;
    }

    public function loadFile($_inputName, $_inputObservation, $_inputFile) {
        $sql = " SELECT IdLoad, NameDocument, Description, State, DateCreate, IdTypeLoad, IdPerson"
                . " FROM tb_load"
                . " WHERE NameDocument = '" . $_inputName . "'";
        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists <= 0) {
            $loadFile = new loadFiles();
            $resultCreateFile = $loadFile->createFileVarient($_inputFile);
            if ($resultCreateFile['result_move_uploaded_file']) {

//                $queryUpdate = "UPDATE tb_person SET Passw = SHA1('" . $_password_new . "'), PasswUpdate = 0 WHERE IdPerson = " . $row['IdPerson'];
//                $data = $this->database->query($queryUpdate);
                $resul = 'EXITOSO';
            } else {
                $resul = 'NOCREATEFILE';
            }
        } else {
            $resul = 'YAEXISTE';
        }
        return $resul;
    }

    public function getParametros($tipoParametro) {
        $sql = "select pa_IdParametro_pk,pa_NombreParametro,pa_Estado from Parametros
                WHERE pa_Padre='$tipoParametro'";
        $data = $this->database->query(utf8_decode($sql));
        $htmlObject = "";
        $htmlObject .= "<option value='-1'>Seleccione...</option>";
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['pa_Estado'] == 1) {
                $htmlObject .= "<option value='" . $data[$i]['pa_IdParametro_pk'] . "'>" . utf8_encode($data[$i]['pa_NombreParametro']) . "</option>";
            }
        }
        return $htmlObject;
    }

    public function getBases() {
        $sql = "SELECT [Id_Base],[B_NombreBase]
                FROM [EgresadosPopular].[dbo].[NombreBase]
                WHERE [B_Estado] = '1'";

        $data = $this->database->query(utf8_decode($sql));
        $htmlObject = "<option value='-1'>Seleccione...</option>";

        if (count($data) > 0) {
            for ($i = 0; $i < count($data); $i++) {
                $htmlObject .= "<option value='" . utf8_encode($data[$i]['Id_Base']) . "'>" . utf8_encode($data[$i]['B_NombreBase']) . "</option>";
            }
        }
        return $htmlObject;
    }

    public function guardaGestion($_InteractionId, $_NumDocAsesor, $_tel_Contact, $_ContEgre, $_ResulEgre, $_txtObservacion, $_NumDocEgre, $idGestion) {
        $update1 = "UPDATE [EgresadosPopular].[dbo].[CargueBase] 
                    SET  [cb_NumeroDoc] = '" . $_NumDocEgre . "'
                    WHERE cb_IdCargueBase = '" . $idGestion . "'";
        $this->database->nonReturnQuery($update1);

        $select = "SELECT * FROM [EgresadosPopular].[dbo].[Gestion] WHERE [G_IdCargueBase] = '" . $idGestion . "' ";
        $dataselect = $this->database->Query($select);
        if (count($dataselect) > 0) {
            $UPDATE = "UPDATE [EgresadosPopular].[dbo].[Gestion]
                        SET [G_InteractionId] = ''      
                           ,[G_Observaciones] = '" . $_txtObservacion . "'
                           ,[G_ResultadoGestion] = '" . $_ResulEgre . "'
                           ,[G_Contacto] = '" . $_ContEgre . "'
                           ,[G_FechaGestion] = GETDATE()
                           ,[G_DocAsesor] = '" . $_NumDocAsesor . "'
                      WHERE [G_IdCargueBase] = '" . $idGestion . "'";
            $dataupdate = $this->database->nonReturnQuery($UPDATE);
        } ELSE {

            $sql = "INSERT INTO [EgresadosPopular].[dbo].[Gestion]
           ([G_InteractionId]
           ,[G_Telefono]
           ,[G_Observaciones]
           ,[G_ResultadoGestion]
           ,[G_Contacto]           
           ,[G_DocAsesor]
           ,[G_IdCargueBase])
     VALUES
           ('" . $_InteractionId . "'
           ,'" . $_tel_Contact . "'
           ,'" . $_txtObservacion . "'
           ,'" . $_ResulEgre . "'
           ,'" . $_ContEgre . "'           
           ,'" . $_NumDocAsesor . "'
           ,'" . $idGestion . "')";
            $data = $this->database->nonReturnQuery($sql);
        }
        return 1;
    }

    //LOGIN

    /**
     * Funcion Login
     * Retorna retirn en posicion 0 1 efectivo, 2 Error de contraseña,3 inactivo
     * 4 actualizar contraseña
     * 
     * si es efectivo retorna return en la posicion 1 la cedula del asesor 
     * y en la posicion 0 1 de efectivo
     */
    public function validaLogin($usuario, $clave) {

        $sql = "Select * ,datediff(month,us_FechaActualizacion,getdate()) 'Datediff'
                from Usuarios
                where us_Usuario=$usuario 
                and us_Clave=(SELECT dbo.EncriptaVYS('" . base64_decode($clave) . "'))";
        $data = $this->database->query($sql);

        if (sizeof($data) > 0) {
            if ($data[0]['us_Estado'] == 0) {
                $return[0] = 3;
            } else {
                if ($data[0]['Datediff'] > 3) {
                    $return[0] = 4;
                } else {
                    $return[0] = 1;
                    $return[1] = $data[0]['us_Usuario'];
                }
            }
        } else {
            $return[0] = 2;
        }
        return $return;
    }

    public function validaClave($usuario, $clave, $claveN) {
        $sql = "Select * 
                from Usuarios
                where us_Usuario=$usuario 
                and us_Clave=(SELECT dbo.EncriptaVYS('" . base64_decode($clave) . "'))";
        $data = $this->database->query($sql);
        if (sizeof($data) > 0) {
            $Update = "Update Usuarios 
                         set us_FechaActualizacion=getdate(), us_Clave=dbo.EncriptaVYS('" . base64_decode($claveN) . "')
                     where  us_Usuario=$usuario";
            $this->database->nonReturnQuery($Update);
            $return[0] = 1;
            $return[1] = $data[0]['us_Usuario'];
        } else {
            $return[0] = 2;
        }
        return $return;
    }

    public function ConsultaDatosCliente($_NumCedula, $_txtIdBase, $_Asesor) {
        $sql = " SELECT TOP 1 *
                 FROM [EgresadosPopular].[dbo].[CargueBase]
                 WHERE cb_NumeroDoc = '" . $_NumCedula . "'
                 AND cb_IdBase = '" . $_txtIdBase . "'";
        $data = $this->database->query($sql);
        return $data;
    }

    public function getUsuarios() {
        $sql = " SELECT * FROM tb_person";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTiposClientes() {
        $sql = " SELECT * FROM tb_typeclient";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getUsuarios1($id) {
        $sql = " SELECT TOP 1 * FROM tb_person WHERE IdPerson=" . $id . " State=1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function eliminarUsuarios($id) {
        $sql = " DELETE FROM tb_person WHERE IdPerson=" . $id . "  and State=1";
        $data = $this->database->nonReturnQuery(utf8_decode($sql));

        // print_r($return);
        return 1;
    }

    public function getPerfilesActivos() {
        $sql = " SELECT * FROM tb_profile WHERE  State=1 ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTiposDocumentos() {
        $sql = " SELECT * FROM tb_typedocument WHERE  State=1 ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTiposCliente() {
        $sql = " SELECT * FROM tb_typeclient WHERE  State=1 ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function setUsuarios($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient) {

        $select = "SELECT TOP 1 * FROM tb_person  WHERE Name like '%" . $Nombre . "%' ";
        $dataselect = $this->database->QueryArray($select);
        if (sizeof($data) > 0) {
            $UPDATE = "UPDATE tb_person
                        SET Name = '" . $Nombre . "'      
                           ,Document = '" . $Documento . "'
                           ,Phone = " . $Telefono . "
                           ,Email = '" . $Email . "'
                           ,Passw = '" . sha1($Contraseña) . "'
                           ,State = " . $Status . "
                           ,DateCreate=now(),
                           ,IdTypeDocument=" . $idTypeDocument . ",
                           ,IdProfile=" . $idProfile . ",
                           ,IdTypeClient=" . $idClient . ",
                      WHERE IdPerson = '" . $data[0]["IdPerson"] . "'";
            $dataupdate = $this->database->nonReturnQuery($UPDATE);
        } ELSE {

            $sql = "INSERT INTO tb_person
           (Name
           ,Document
           ,Phone
           ,Email
           ,Passw           
           ,State
           ,DateCreate
           ,IdTypeDocument
           ,IdProfile)
     VALUES
           ('" . $Nombre . "'
           ,'" . $Documento . "'
           ,'" . $Telefono . "'
           ,'" . $Email . "'
           ,'" . sha1($Contraseña) . "'           
           ,'" . $Status . "'
           ,now()
           ," . $idTypeDocument . ""
                    . "," . $idProfile . ")";
            $data = $this->database->nonReturnQuery($sql);
        }
        return 1;
    }

    public function getControl($_IdCargueBase, $_IdBase) {
        $sql = "  UPDATE [EgresadosPopular].[dbo].[CargueBase] 
                  SET [cb_FechaGestion] = GETDATE(),[cb_Estado]='I'
                  WHERE [cb_IdCargueBase] = " . $_IdCargueBase . " AND cb_IdBase=" . $_IdBase;
        $this->database->nonReturnQuery($sql);
        return 1;
    }

    public function getSiguienteNivel($_CogPadre) {
        $data = $this->database->query(utf8_encode("SELECT pa_NombreParametro,
                                                           pa_IdParametro_pk 
                                                    FROM Parametros 
                                                    WHERE pa_Estado = 1 
                                                      AND pa_Padre = " . $_CogPadre));

        return $data;
    }

}

?>