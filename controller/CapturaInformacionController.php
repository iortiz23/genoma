<?php

require_once('../class/CapturaInformacion.class.php');
require_once('../class/XML.class.php');
switch ($_REQUEST['metodo']) {
    case 'setPassword':
        XML::xmlResponse(setPassword($_REQUEST['email'], $_REQUEST['password_old'], $_REQUEST['password_new']));
        break;
    //LOGIN
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
    case 'getDatosCliente':
        XML::xmlResponse(getDatosCliente($_POST['id_base']));
        break;
    case 'ConsultaDatosCliente':
        XML::xmlResponse(ConsultaDatosCliente($_POST['txtNumCedula'], $_POST['txtIdBase'], $_POST['Asesor']));
        break;
    default :
        echo 'No se encontro el metodo';
        break;
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

//LOGIN
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

function getDatosCliente($_id_base) {
    $captura = new CapturaInformacion();
    $data = $captura->getDatosCliente($_id_base);
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
