<?php

date_default_timezone_set('America/Bogota');
require_once('DataBase.class.php');
require_once('EnvioCorreo.class.php');

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

    public function getDatosCliente($_id_base) {
        $sql = " SELECT TOP 1 [cb_IdCargueBase],[cb_NumeroTel]
        ,[cb_NombresApellidos]
        ,[cb_Correo]
         ,[cb_NumeroDoc]
         ,[cb_IdBase]
         ,[cb_FechaGestion]
         ,[cb_Estado]
         FROM [EgresadosPopular].[dbo].[CargueBase]
        WHERE cb_Estado = 'A' 
        AND cb_IdBase = '" . $_id_base . "'";
        $data = $this->database->query(utf8_decode($sql));
        if (count($data) > 0) {
            $return = $data;
        } else {
            $sql1 = "  SELECT TOP 1 CB.[cb_IdCargueBase]
                        ,G.[G_ResultadoGestion]
                        ,[cb_NumeroTel]
                        ,[cb_NombresApellidos]
                        ,[cb_Correo]
                        ,[cb_NumeroDoc]
                        ,[cb_IdBase]
                        ,[cb_FechaGestion]
                        ,[cb_Estado],*
                FROM [EgresadosPopular].[dbo].[CargueBase] CB
                INNER JOIN [EgresadosPopular].[dbo].[Gestion] G  ON CB.cb_NumeroTel = G.G_Telefono  
                WHERE G_ResultadoGestion NOT IN (4,5,6,13)
                    AND CB.cb_IdBase = '" . $_id_base . "'"
                    . "   ORDER BY CB.[cb_IdCargueBase] ";
            $data1 = $this->database->query(utf8_decode($sql1));
            if (count($data1) > 0) {
                $return = $data1;
            } else {
                $return = null;
            }
        }
//        print_r($return);
        return $return;
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