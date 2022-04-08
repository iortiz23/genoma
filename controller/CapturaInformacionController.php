<?php

require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');
switch ($_REQUEST['metodo']) {
    case 'setPassword':
        XML::xmlResponse(setPassword($_REQUEST['email'], $_REQUEST['password_old'], $_REQUEST['password_new']));
        break;
    case 'loadFile':
        XML::xmlResponse(loadFile($_REQUEST['idPerson'], $_REQUEST['inputName'], $_REQUEST['inputObservation'], $_FILES['inputFile']));
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
    case 'validateTypeDocument':
        XML::xmlResponse(validateTypeDocument($_REQUEST['id']));
        break;
    case 'validateTypeClient':
        XML::xmlResponse(validateTypeClient($_REQUEST['id']));
        break;
    case 'validatePerfil':
        XML::xmlResponse(validatePerfil($_REQUEST['id']));
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
        XML::xmlResponse(setPerfil($_POST['Description'], $_POST['Status'], $_POST['Id']));
        break;
    case 'setTipoCliente':
        XML::xmlResponse(setTipoCliente($_POST['Description'], $_POST['Status'], $_POST['Id']));
        break;
    case 'setTipoDocumento':
        XML::xmlResponse(setTipoDocumento($_POST['Description'], $_POST['Status'], $_POST['Id']));
        break;

    default:
        echo 'No se encontro el metodo';
        break;
}

function setUser($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient)
{
    $captura = new CapturaInformacion();
    $data = $captura->setUsuarios($Nombre, $Documento, $Telefono, $Email, $Contraseña, $Status, $idTypeDocument, $idProfile, $idClient);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function setPerfil($Descripcion, $Status, $Id)
{
    $captura = new CapturaInformacion();
    $data = $captura->setPerfiles($Descripcion, $Status, $Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function setTipoCliente($Descripcion, $Status, $Id)
{
    $captura = new CapturaInformacion();
    $data = $captura->setTiposCliente($Descripcion, $Status, $Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function setTipoDocumento($Descripcion, $Status, $Id)
{
    $captura = new CapturaInformacion();
    $data = $captura->setTiposDocumento($Descripcion, $Status, $Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function setPassword($_email, $_password_old, $_password_new)
{
    $captura = new CapturaInformacion();
    $data = $captura->setPassword($_email, $_password_old, $_password_new);
    $xml = "<registro>" . $data . "</registro>";
    return $xml;
}

function loadFile($_idPerson, $_inputName, $_inputObservation, $_inputFile)
{
    $captura = new CapturaInformacion();
    $data = $captura->loadFile($_idPerson, $_inputName, $_inputObservation, $_inputFile);
    $xml = "<registro"
        . " idLoad = '" . $data['idLoad'] . "'"
        . " columna = '" . $data['columna'] . "'"
        . " fila = '" . $data['fila'] . "'"
        . " result = '" . $data['result'] . "'"
        . "></registro>";
    return $xml;
}

function getUser()
{
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

function getPerfil()
{
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

function getTypeClients()
{
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

function getTypeDocuments()
{
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

function getUsers($id)
{
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

function deleteUsers($id)
{
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

function deleteTypeClient($id)
{
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

function deleteTypeDocument($id)
{
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

function deletePerfiles($id)
{
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
function validateTypeDocument($id)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->validarTipoDocumento($id);
    if (sizeof($data) > 0) {
        if ($data[0]['conteo'] >= 1) {
            $xml = "<registro Flag='1'>EXITOSO</registro>";
        } else {
            $xml = "<registro Flag='0'>EXITOSO</registro>";
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function validateTypeClient($id)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->validarTipoCliente($id);
    if (sizeof($data) > 0) {
        if ($data[0]['conteo'] >= 1) {
            $xml = "<registro Flag='1'>EXITOSO</registro>";
        } else {
            $xml = "<registro Flag='0'>EXITOSO</registro>";
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function validatePerfil($id)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->validarPerfil($id);
    if (sizeof($data) > 0) {
        if ($data[0]['conteo'] >= 1) {
            $xml = "<registro Flag='1'>EXITOSO</registro>";
        } else {
            $xml = "<registro Flag='0'>EXITOSO</registro>";
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function getProfile()
{
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

function getTypeDocument()
{
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

function getTypeClient()
{
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