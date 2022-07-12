<?php
session_start();
require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');
switch ($_REQUEST['metodo']) {
    case 'setPassword':
        XML::xmlResponse(setPassword($_REQUEST['email'], $_REQUEST['password_old'], $_REQUEST['password_new']));
        break;
    case 'loadFile':
        XML::xmlResponse(loadFile($_REQUEST['idPerson'], $_REQUEST['inputName'], $_REQUEST['inputObservation'], $_REQUEST['idTypeLoad'], $_FILES['inputFile']));
        break;
    case 'getUser':
        XML::xmlResponse(getUser());
        break;
    case 'getBusqueda':
        XML::xmlResponse(getBusqueda());
        break;
    case 'getGen':
        XML::xmlResponse(getGen($_REQUEST['id']));
        break;
    case 'getSNP1':
        XML::xmlResponse(getSNP1($_REQUEST['id']));
        break;
    case 'getProteina1':
        XML::xmlResponse(getProteina1($_REQUEST['id']));
        break;
    case 'getTranscripto1':
        XML::xmlResponse(getTranscripto1($_REQUEST['id']));
        break;
    case 'getGQ1':
        XML::xmlResponse(getGQ1($_REQUEST['id']));
        break;
    case 'getACMG1':
        XML::xmlResponse(getACMG1($_REQUEST['id']));
        break;
    case 'getEfecto1':
        XML::xmlResponse(getEfecto1($_REQUEST['id']));
        break;
    case 'getCigosidad1':
        XML::xmlResponse(getCigosidad1($_REQUEST['id']));
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
    case 'getTypeIllnes':
        XML::xmlResponse(getTypeIllnes());
        break;
    case 'getTypeMedicine':
        XML::xmlResponse(getTypeMedicine());
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
    case 'deleteTypeIllnes':
        XML::xmlResponse(deleteTypeIllnes($_REQUEST['id']));
        break;
    case 'deleteTypeMedicine':
        XML::xmlResponse(deleteTypeMedicine($_REQUEST['id']));
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
    case 'setTipoMedicamento':
        XML::xmlResponse(setTipoMedicamento($_POST['Description'], $_POST['Status'], $_POST['Id']));
        break;
    case 'setTipoEnfermedad':
        XML::xmlResponse(setTipoEnfermedad($_POST['Description'], $_POST['Status'], $_POST['Id']));
        break;
    case 'offSession':
        XML::xmlResponse(offSession());
        break;
    case 'getLoads':
        XML::xmlResponse(getLoads($_REQUEST['idTypeLoad']));
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

function setTipoEnfermedad($Descripcion, $Status, $Id)
{
    $captura = new CapturaInformacion();
    $data = $captura->setTiposEnfermedad($Descripcion, $Status, $Id);
    if ($data != 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
function setTipoMedicamento($Descripcion, $Status, $Id)
{
    $captura = new CapturaInformacion();
    $data = $captura->setTiposMedicamento($Descripcion, $Status, $Id);
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

function loadFile($_idPerson, $_inputName, $_inputObservation, $_idTypeLoad, $_inputFile)
{
    $captura = new CapturaInformacion();
    $data = $captura->loadFile($_idPerson, $_inputName, $_inputObservation, $_idTypeLoad, $_inputFile);
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
                        Type_client='" . utf8_encode(trim($data[$i]['type_client'])) . "'                                          
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

function getBusqueda()
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getBusqueda();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        IdLoad='" . utf8_encode(trim($data[$i]['IdLoad'])) . "'                    
                        NameLoad='" . utf8_encode(trim($data[$i]['NameLoad'])) . "'                    
                        Description='" . utf8_encode(trim($data[$i]['Description'])) . "'                                          
                        DateCreate='" . utf8_encode(trim($data[$i]['DateCreate'])) . "'
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

function getGen($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getGenoma($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                                 
                Num_Gen='" . utf8_encode(trim($data[$i]['Num_Gen'])) . "'                                                               
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

function getSNP1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getSNP($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                                    
                Num_IDdbSNP='" . utf8_encode(trim($data[$i]['Num_IDdbSNP'])) . "'                                                               
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

function getProteina1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getProteina($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro  
                Num_VarianteProteina='" . utf8_encode(trim($data[$i]['Num_VarianteProteina'])) . "'                                                               
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

function getTranscripto1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getTranscripto($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                                       
                VarianteTranscripto1='" . utf8_encode(trim($data[$i]['VarianteTranscripto1'])) . "'                                                               
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

function getGQ1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getGQ($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                        
                Num_GQ='" . utf8_encode(trim($data[$i]['Num_GQ'])) . "'                                                               
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

function getCigosidad1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getCigosidad($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                Cigosidad='" . utf8_encode(trim($data[$i]['Cigosidad'])) . "'                    
                Cigosidad1='" . utf8_encode(trim($data[$i]['Cigosidad1'])) . "'                                                               
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

function getACMG1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getACMG($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                ACMG='" . utf8_encode(trim($data[$i]['ACMG'])) . "'                    
                Num_ACMG='" . utf8_encode(trim($data[$i]['Num_ACMG'])) . "'                                                               
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

function getEfecto1($id)
{
    $xml = "";
    $captura = new CapturaInformacion();

    $data = $captura->getEfecto($id);
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                Efect='" . utf8_encode(trim($data[$i]['Efect'])) . "'                    
                Num_Efect='" . utf8_encode(trim($data[$i]['Num_Efect'])) . "'                                                               
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

function getTypeIllnes()
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposEnfermedad();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['idTypeIllnes'])) . "'                    
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

function getTypeMedicine()
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getTiposMedicina();
    if (count($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            if (sizeof($data) > 0) {
                $xml .= "<registro                    
                        Id='" . utf8_encode(trim($data[$i]['idTypeMedicine'])) . "'                    
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

function deleteTypeIllnes($id)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarTiposEnfermedad($id);
    if (sizeof($data) > 0) {
        $xml = "<registro>EXITOSO</registro>";
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}

function deleteTypeMedicine($id)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->eliminarTiposMedicina($id);
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
function offSession()
{
    session_destroy();
    $xml = "<registro>EXITOSO</registro>";
    return $xml;
}
function getLoads($_idTypeLoad)
{
    $xml = "";
    $captura = new CapturaInformacion();
    $data = $captura->getLoads($_idTypeLoad);
    if (sizeof($data) > 0) {
        for ($i = 0; $i < count($data); $i++) {
            $xml .= "<registro                    
                        IdLoad='" . utf8_encode(trim($data[$i]['IdLoad'])) . "'                    
                        NameLoad='" . utf8_encode(trim($data[$i]['NameLoad'])) . "'                    
                        NameDocument='" . utf8_encode(trim($data[$i]['NameDocument'])) . "'                                          
                        Description='" . utf8_encode(trim($data[$i]['Description'])) . "'  
                        DescriptionState='" . utf8_encode(trim($data[$i]['DescriptionState'])) . "'  
                        DateCreate='" . utf8_encode(trim($data[$i]['DateCreate'])) . "'
                        Processedrows='" . utf8_encode(trim($data[$i]['Processedrows'])) . "' 
                        Name='" . utf8_encode(trim($data[$i]['Name'])) . "'
                    ></registro>";
        }
    } else {
        $xml = "<registro>NOEXITOSO</registro>";
    }
    return $xml;
}
