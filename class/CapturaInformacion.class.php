<?php

date_default_timezone_set('America/Bogota');
require_once('DataBase.class.php');
require_once('EnvioCorreo.class.php');
require_once('loadFiles/loadFiles.class.php');

/**
 * Description of CapturaInformacion
 *
 * @author Sneider Rocha
 */
class CapturaInformacion
{

    public function __construct()
    {
        $this->database = DataBase::getDatabaseObject(DataBase::MYSQL);
    }

    public function getDatosUsuario($_usuario, $_password)
    {
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

    public function setNewPassword($_email)
    {
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

    public function getNewPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function setPassword($_email, $_password_old, $_password_new)
    {
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

    public function loadFile($_idPerson, $_inputName, $_inputObservation, $_inputFile)
    {
        $sql = " SELECT IdLoad, NameLoad, NameDocument, Description, State, DateCreate, IdTypeLoad, IdPerson"
            . " FROM tb_load"
            . " WHERE State  = 1"
            . " AND NameLoad = '" . $_inputName . "'";
        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists <= 0) {
            $loadFile = new loadFiles();
            $resultCreateFile = $loadFile->createFileVarient($_inputFile);
            if ($resultCreateFile['result_move_uploaded_file']) {
                $resultCreateFile += ['idPerson' => $_idPerson];
                $resultCreateFile += ['nameLoad' => $_inputName];
                $resultCreateFile += ['descriptionLoad' => $_inputObservation];
                $resultCreateFile += ['typeLoad' => '1'];
                $resultCreateLoad = $this->createLoad($resultCreateFile);
                if ($resultCreateLoad > 0) {
                    $resultCreateFile += ['idLoad' => $resultCreateLoad];
                    $resultLoadFile = $loadFile->readDataFileVarient($resultCreateFile);
                    $result = $resultLoadFile;
                } else {
                    $loadFile->delateLocalFileVarient($resultCreateFile);
                    $result = array(
                        'idLoad' => 0,
                        'columna' => 0,
                        'fila' => 0,
                        'result' => 'CARGUE_NO_CREADO',
                    );
                }
            } else {
                $result = array(
                    'idLoad' => 0,
                    'columna' => 0,
                    'fila' => 0,
                    'result' => 'ARCHIVO_NO_CARGADO',
                );
            }
        } else {
            $row = $data->fetch_assoc();
            $result = array(
                'idLoad' => $row['IdLoad'],
                'columna' => 0,
                'fila' => 0,
                'result' => 'NOMBRE_YA_EXISTE',
            );
        }
        return $result;
    }

    public function getUsuarios()
    {
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

    public function getUserById($id)
    {
        $sql = " SELECT  * FROM tb_person WHERE IdPerson=" . $id . " and  State=1 LIMIT 1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTypeClientById($id)
    {
        $sql = " SELECT  * FROM tb_typeclient WHERE idTypeClient=" . $id . " and  State=1 LIMIT 1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTypeDocumentById($id)
    {
        $sql = " SELECT  * FROM tb_typedocument WHERE IdTypeDocument=" . $id . " and  State=1 LIMIT 1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getProfileById($id)
    {
        $sql = " SELECT  * FROM tb_profile WHERE IdProfile=" . $id . " and  State=1 LIMIT 1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }
    public function validarPerfil($id)
    {
        $sql = " SELECT  count(*) as conteo FROM tb_person WHERE IdProfile=" . $id . " ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }
    public function validarTipoCliente($id)
    {
        $sql = " SELECT  count(*) as conteo FROM tb_person WHERE IdTypeClient=" . $id . " ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }
    public function validarTipoDocumento($id)
    {
        $sql = " SELECT  count(*) as conteo FROM tb_person WHERE IdTypeDocument=" . $id . " ";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getPerfiles()
    {
        $sql = " SELECT * FROM tb_profile";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getTiposClientes()
    {
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

    public function getTiposDocumento()
    {
        $sql = " SELECT * FROM tb_typedocument";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function getUsuarios1($id)
    {
        $sql = " SELECT  * FROM tb_person WHERE IdPerson=" . $id . " and  State=1 LIMIT 1";
        $data = $this->database->queryArray(utf8_decode($sql));

        if (sizeof($data) > 0) {

            $return = $data;
        } else {

            $return = null;
        }
        // print_r($return);
        return $return;
    }

    public function eliminarPerfiles($id)
    {
        $sql = " DELETE FROM tb_profile WHERE IdProfile=" . $id . "  and State=1";
        $data = $this->database->nonReturnQuery(utf8_decode($sql));

        // print_r($return);
        return 1;
    }

    public function eliminarTiposCliente($id)
    {
        $sql = " DELETE FROM tb_typeclient WHERE idTypeClient=" . $id . "  and State=1";
        $data = $this->database->nonReturnQuery(utf8_decode($sql));

        // print_r($return);
        return 1;
    }

    public function eliminarTiposDocumento($id)
    {
        $sql = " DELETE FROM tb_typedocument WHERE IdTypeDocument=" . $id . "  and State=1";
        $data = $this->database->nonReturnQuery(utf8_decode($sql));

        // print_r($return);
        return 1;
    }

    public function eliminarUsuarios($id)
    {
        $sql = " DELETE FROM tb_person WHERE IdPerson=" . $id . "  and State=1";
        $data = $this->database->nonReturnQuery(utf8_decode($sql));

        // print_r($return);
        return 1;
    }

    public function getPerfilesActivos()
    {
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

    public function getTiposDocumentos()
    {
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

    public function getTiposCliente()
    {
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

    public function setUsuarios($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient)
    {
        if ($Email != "") {
            $select = "SELECT  * FROM tb_person  WHERE Email like '%" . $Email . "%' LIMIT 1 ";
            $data = $this->database->QueryArray($select);
            if (sizeof($data) > 0) {
                $valor = "";
                if ($Contraseña != "" && $Contraseña != $data[0]["Passw"]) {
                    $valor = "',Passw = '" . sha1($Contraseña) . "'";
                }
                $UPDATE = "UPDATE tb_person
                        SET Name = '" . $Nombre . "'      
                           ,Document = '" . $Documento . "'
                           ,Phone = " . $Telefono . "
                           ,Email = '" . $Email . "'
                           " . $valor . "
                           ,State = " . $Status . "
                           ,DateCreate=now()
                           ,IdTypeDocument=" . $idTypeDocument . ",
                           ,IdProfile=" . $idProfile . ",
                           ,IdTypeClient=" . $idClient . ",
                      WHERE IdPerson = " . $data[0]["IdPerson"] . "";
                $dataupdate = $this->database->nonReturnQuery($UPDATE);
            } else {

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
        } else {
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

    public function setPerfiles($Descripcion, $Status, $Id)
    {
        if ($Id != "") {
            $select = "SELECT  * FROM tb_profile  WHERE IdProfile=" . $Id . " LIMIT 1";
            $data = $this->database->QueryArray($select);
            if (sizeof($data) > 0) {
                $UPDATE = "UPDATE tb_profile
                        SET Description = '" . $Descripcion . "'
                           ,State = " . $Status . "
                           ,DateCreate=now()
                      WHERE IdProfile=" . $data[0]['IdProfile'] . "";
                $dataupdate = $this->database->nonReturnQuery($UPDATE);
            } else {

                $sql = "INSERT INTO tb_profile
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
                $data = $this->database->nonReturnQuery($sql);
            }
        } else {
            $sql = "INSERT INTO tb_profile
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
            $data = $this->database->nonReturnQuery($sql);
        }

        return 1;
    }

    public function setTiposCliente($Descripcion, $Status, $Id)
    {
        if ($Id != "") {
            $select = "SELECT  * FROM tb_typeclient  WHERE idTypeClient=" . $Id . " LIMIT 1";
            $data = $this->database->QueryArray($select);
            if (sizeof($data) > 0) {
                $UPDATE = "UPDATE tb_typeclient
                        SET Description = '" . $Descripcion . "'
                           ,State = " . $Status . "
                           ,DateCreate=now()
                      WHERE idTypeClient=" . $data[0]['idTypeClient'] . "";
                $dataupdate = $this->database->nonReturnQuery($UPDATE);
            } else {

                $sql = "INSERT INTO tb_typeclient
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
                $data = $this->database->nonReturnQuery($sql);
            }
        } else {
            $sql = "INSERT INTO tb_typeclient
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
            $data = $this->database->nonReturnQuery($sql);
        }

        return 1;
    }

    public function setTiposDocumento($Descripcion, $Status, $Id)
    {
        if ($Id != "") {
            $select = "SELECT  * FROM tb_typedocument  WHERE IdTypeDocument=" . $Id . " LIMIT 1";
            $data = $this->database->QueryArray($select);
            if (sizeof($data) > 0) {
                $UPDATE = "UPDATE tb_typedocument
                        SET Description = '" . $Descripcion . "'
                           ,State = " . $Status . "
                           ,DateCreate=now()
                      WHERE IdTypeDocument=" . $data[0]['IdTypeDocument'] . "";
                $dataupdate = $this->database->nonReturnQuery($UPDATE);
            } else {

                $sql = "INSERT INTO tb_typedocument
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
                $data = $this->database->nonReturnQuery($sql);
            }
        } else {
            $sql = "INSERT INTO tb_typedocument
           (Description           
           ,State
           ,DateCreate)
     VALUES
           ('" . $Descripcion . "'           
           ,'" . $Status . "'
           ,now())";
            $data = $this->database->nonReturnQuery($sql);
        }

        return 1;
    }

    public function createLoad($dataLoad)
    {
        $queryInsert = "INSERT INTO tb_load ("
            . " NameLoad,"
            . " NameDocument,"
            . " Description,"
            . " State, "
            . " DateCreate,"
            . " IdTypeLoad, "
            . " IdPerson,"
            . " IdStateLoad)"
            . " VALUES ("
            . "'" . $dataLoad['nameLoad'] . "',"
            . "'" . $dataLoad['nameFileOld'] . "',"
            . "'" . $dataLoad['descriptionLoad'] . "',"
            . "'1',"
            . "now(),"
            . $dataLoad['typeLoad'] . ","
            . $dataLoad['idPerson'] . ", 
            4)";

        $this->database->nonReturnQuery($queryInsert);

        $sql = " SELECT IdLoad, NameLoad, NameDocument, Description, State, DateCreate, IdTypeLoad, IdPerson "
            . " FROM tb_load "
            . " WHERE State = 1 "
            . " AND NameLoad = '" . $dataLoad['nameLoad'] . "'"
            . " AND NameDocument = '" . $dataLoad['nameFileOld'] . "'"
            . " AND Description = '" . $dataLoad['descriptionLoad'] . "'"
            . " AND IdTypeLoad = " . $dataLoad['typeLoad']
            . " AND IdPerson = " . $dataLoad['idPerson'];
        $data = $this->database->query(utf8_decode($sql));
        $exists = $data->num_rows;
        if ($exists == 1) {
            $row = $data->fetch_assoc();
            $resul = $row['IdLoad'];

            $queryUpdate = "UPDATE tb_load SET IdStateLoad = 7 WHERE IdLoad = " . $resul;
            $this->database->nonReturnQuery($queryUpdate);
        } else {
            $resul = $exists;
        }
        return $resul;
    }

    function updateStateLoad($_idLoad, $_idStateLoad, $_idState, $_Processedrows)
    {
        $queryUpdate = "UPDATE tb_load SET "
            . " IdStateLoad = " . $_idStateLoad . ","
            . " State = " . $_idState . ","
            . " Processedrows = " . $_Processedrows
            . " WHERE IdLoad = " . $_idLoad;
        $this->database->nonReturnQuery($queryUpdate);
    }
}
