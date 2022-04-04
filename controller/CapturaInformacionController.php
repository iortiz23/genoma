<?php

require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');
switch ($_REQUEST['metodo']) {
    case 'setPassword':
        XML::xmlResponse(setPassword($_REQUEST['email'], $_REQUEST['password_old'], $_REQUEST['password_new']));
        break;
    case 'validaLogin':
        XML::xmlResponse(validaLogin(str_replace("'", "", $_REQUEST['usuario']), str_replace('"', '', $_REQUEST['clave'])));
        break;
    case 'validaClave':
        XML::xmlResponse(validaClave(str_replace("'", "", $_REQUEST['usuario']), str_replace('"', '', $_REQUEST['clave']), str_replace('"', '', $_REQUEST['claveN'])));
        break;
    case 'getParametros':
        XML::xmlResponse(getParametros($_REQUEST['Id_Padre']));
        break;
    case 'getValidaTel':
        XML::xmlResponse(getValidaTel($_REQUEST['InteractionID'], $_REQUEST['NumTel'], $_REQUEST['Asesor']));
        break;
    case 'getControl':
        XML::xmlResponse(getControl($_REQUEST['IdCargueBase'], $_REQUEST['IdBase']));
        break;
    case 'getSiguienteNivel':
        XML::xmlResponse(getSiguienteNivel($_POST['codPadre']));
        break;
    case 'getUser':
        XML::xmlResponse(getUser());
        break;
    case 'getPerfil':
        XML::xmlResponse(getPerfil());
        break;
    case 'getTypeClients':
        XML::xmlResponse(getTypeClients());
        break;
    case 'getTypeDocuments':
        XML::xmlResponse(getTypeDocuments());
        break;
    case 'deleteUser':
        XML::xmlResponse(deleteUsers($_REQUEST['id']));
        break;
    case 'deletePerfil':
        XML::xmlResponse(deletePerfiles($_REQUEST['id']));
        break;
    case 'deleteTypeClient':
        XML::xmlResponse(deleteTypeClient($_REQUEST['id']));
        break;
    case 'deleteTypeDocument':
        XML::xmlResponse(deleteTypeDocument($_REQUEST['id']));
        break;
    case 'getUsers':
        XML::xmlResponse(getUsers($_REQUEST['Id']));
        break;
    case 'getProfile':
        XML::xmlResponse(getProfile());
        break;
    case 'getTypeDocument':
        XML::xmlResponse(getTypeDocument());
        break;
    case 'getTypeClient':
        XML::xmlResponse(getTypeClient());
        break;
    case 'setUser':
        XML::xmlResponse(setUser($_POST['Nombre'], $_POST['Documento'], $_POST['Telefono'], $_POST['Email'], $_POST['Contraseña'], $_POST['Status'], $_POST['idTypeDocument'], $_POST['idProfile'], $_POST['idClient']));
        break;
    case 'setPerfil':
        XML::xmlResponse(setPerfil($_POST['Description'],$_POST['Status'],$_POST['Id']));
        break;
    case 'setTipoCliente':
        XML::xmlResponse(setTipoCliente($_POST['Description'],$_POST['Status'],$_POST['Id']));
        break;
    case 'setTipoDocumento':
        XML::xmlResponse(setTipoDocumento($_POST['Description'],$_POST['Status'],$_POST['Id']));
        break;
    case 'ConsultaDatosCliente':
        XML::xmlResponse(ConsultaDatosCliente($_POST['txtNumCedula'], $_POST['txtIdBase'], $_POST['Asesor']));
        break;
    default :
        echo 'No se encontro el metodo';
        break;
}

function guardaGestion($InteractionId, $NumDocAsesor, $tel_Contact, $ContEgre, $ResulEgre, $txtObservacion, $NumDocEgre, $idGestion) {
    $captura = new CapturaInformacion();
    $data = $captura->guardaGestion($InteractionId, $NumDocAsesor, $tel_Contact, $ContEgre, $ResulEgre, $txtObservacion, $NumDocEgre, $idGestion);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function setUser($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient) {
    $captura = new CapturaInformacion();
    $data = $captura->setUsuarios($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function setPerfil($Descripcion,$Status,$Id) {
    $captura = new CapturaInformacion();
    $data = $captura->setPerfiles($Descripcion,$Status,$Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function setTipoCliente($Descripcion,$Status,$Id) {
    $captura = new CapturaInformacion();
    $data = $captura->setTiposCliente($Descripcion,$Status,$Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function setTipoDocumento($Descripcion,$Status,$Id) {
    $captura = new CapturaInformacion();
    $data = $captura->setTiposDocumento($Descripcion,$Status,$Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function setPassword($_email, $_password_old, $_password_new) {
    $captura = new CapturaInformacion();
    $data = $captura->setPassword($_email, $_password_old, $_password_new);
    $xml = "<registro>" . $data . "</registro>";
    return $xml;
}

function getControl($_IdCargueBase, $_IdBase) {
    $captura = new CapturaInformacion();
    $data = $captura->getControl($_IdCargueBase, $_IdBase);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function validaLogin($usuario, $clave) {
    $captura = new CapturaInformacion();
    $data = $captura->validaLogin($usuario, $clave);
    switch ($data[0]) {
        case 1:
            session_start();
            $_SESSION['ElectricaribeUser'] = $data[1];
            $xml = "<registro>EXITOSO</registro>";
            break;
        case 2:
            $xml = "<registro error='Error de Usuario o Clave, por favor Verifique'>NOEXITOSO</registro>";
            break;
        case 3:
            $xml = "<registro error='Este Usuario esta inactivo, por favor comuniquese con el departamento de tecnologia.'>NOEXITOSO</registro>";
            break;
        case 4:
            $xml = "<registro>ACTUALIZAR</registro>";
            break;
        default:
            break;
    }

    return $xml;
}

function validaClave($usuario, $clave, $claveN) {
    $captura = new CapturaInformacion();
    $data = $captura->validaClave($usuario, $clave, $claveN);
    if ($data[0] == 1) {
        session_start();
        $_SESSION['ElectricaribeUser'] = $data[1];
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getSiguienteNivel($_CodPadre) {

    $captura = new CapturaInformacion();
    $data = $captura->getSiguienteNivel($_CodPadre);
    if (sizeof($data) > 0) {
        $xml .= '<option value="-1">Seleccione...</option>';

        for ($i = 0; $i < count($data); $i++)
            $xml .= '<option value="' . $data[$i]['pa_IdParametro_pk'] . '">' . utf8_encode($data[$i]['pa_NombreParametro']) . '</option>';

        $xml = '<registro><![CDATA[' . $xml . ']]></registro>';
    } else
        $xml .= '<error>NOEXITOSO</error>';

    return $xml;
}

function getUser() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getUsuarios();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['IdPerson'])) . "'                    
                        Name='" . utf8_encode(trim($data[$i]['Name'])) . "'                    
                        Document='" . utf8_encode(trim($data[$i]['Document'])) . "'                                          
                        State='" . utf8_encode(trim($data[$i]['State'])) . "'                                          
                        ></registro>";
            } else {
                $xml = "<registro>NOEXITOSO</registro>";
            }
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getPerfil() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getPerfiles();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['IdProfile'])) . "'                    
                        Description='" . utf8_encode(trim($data[$i]['Description'])) . "'                                        
                        State='" . utf8_encode(trim($data[$i]['State'])) . "'                                          
                        ></registro>";
            } else {
                $xml = "<registro>NOEXITOSO</registro>";
            }
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTypeClients() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposClientes();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['idTypeClient'])) . "'                    
                        Description='" . utf8_encode(trim($data[$i]['Description'])) . "'                                        
                        State='" . utf8_encode(trim($data[$i]['State'])) . "'                                          
                        ></registro>";
            } else {
                $xml = "<registro>NOEXITOSO</registro>";
            }
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTypeDocuments() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposDocumento();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['IdTypeDocument'])) . "'                    
                        Description='" . utf8_encode(trim($data[$i]['Description'])) . "'                                        
                        State='" . utf8_encode(trim($data[$i]['State'])) . "'                                          
                        ></registro>";
            } else {
                $xml = "<registro>NOEXITOSO</registro>";
            }
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getUsers($id) {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getUsuarios1($id);
    if (sizeof($data) > 0) {
        $xml .= "<registro                    
                    IdPerson='" . utf8_encode(trim($data[0]['IdPerson'])) . "'                    
                    Name='" . utf8_encode(trim($data[0]['Name'])) . "'                    
                    Document='" . utf8_encode(trim($data[0]['Document'])) . "'                                          
                    Phone='" . utf8_encode(trim($data[0]['Phone'])) . "'  
                    Email='" . utf8_encode(trim($data[0]['Email'])) . "'
                    Passw='" . utf8_encode(trim($data[0]['Passw'])) . "' 
                    idTypeDocument='" . utf8_encode(trim($data[0]['idTypeDocument'])) . "'
                    idProfile='" . utf8_encode(trim($data[0]['idProfile'])) . "'
                    idTypeClient='" . utf8_encode(trim($data[0]['idTypeClient'])) . "'
                    Status='" . utf8_encode(trim($data[0]['State'])) . "'
                    ></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function deleteUsers($id) {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarUsuarios($id);
    if (sizeof($data) > 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function deleteTypeClient($id) {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarTiposCliente($id);
    if (sizeof($data) > 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function deleteTypeDocument($id) {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarTiposDocumento($id);
    if (sizeof($data) > 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function deletePerfiles($id) {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarPerfiles($id);
    if (sizeof($data) > 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getProfile() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getPerfilesActivos();
    $htmlOption = "";
    if (count($data) > 0) {
        $htmlOption = "<option value='-1'>--Seleccione</option>";
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $htmlOption .= "<option value=" . $data[$i]['IdProfile'] . ">" . $data[$i]['Description'] . "</option>";
            }
        }
        $xml = "<registro><![CDATA[' . $htmlOption . ']]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTypeDocument() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposDocumentos();
    $htmlOption = "";
    if (count($data) > 0) {
        $htmlOption = "<option value='-1'>--Seleccione</option>";
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $htmlOption .= "<option value=" . $data[$i]['IdTypeDocument'] . ">" . $data[$i]['Description'] . "</option>";
            }
        }
        $xml = "<registro><![CDATA[' . $htmlOption . ']]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getTypeClient() {
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposCliente();
    $htmlOption = "";
    if (count($data) > 0) {
        $htmlOption = "<option value='-1'>--Seleccione</option>";
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $htmlOption .= "<option value=" . $data[$i]['idTypeClient'] . ">" . $data[$i]['Description'] . "</option>";
            }
        }
        $xml = "<registro><![CDATA[' . $htmlOption . ']]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getParametros($_tipoParametro) {
    $captura = new CapturaInformacion();
    $data = $captura->getParametros($_tipoParametro);

    $xml = "<registro><![CDATA[" . $data . "]]></registro>";

    return $xml;
}

function ConsultaDatosCliente($_NumCedula, $_txtIdBase, $_Asesor) {
    $captura = new CapturaInformacion();
    $data = $captura->ConsultaDatosCliente($_NumCedula, $_txtIdBase, $_Asesor);
    if (sizeof($data) > 0) {
        $xml .= "<registro                    
                    IdCargueBase='" . utf8_encode(trim($data[0]['cb_IdCargueBase'])) . "'                    
                    TelEgre='" . utf8_encode(trim($data[0]['cb_NumeroTel'])) . "'                    
                    CorreoEgre='" . utf8_encode(trim($data[0]['cb_Correo'])) . "'                                          
                    NumDocEgre='" . utf8_encode(trim($data[0]['cb_NumeroDoc'])) . "'                                          
                    ><![CDATA[" . trim($data[0]['cb_NombresApellidos']) . "]]></registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

?>