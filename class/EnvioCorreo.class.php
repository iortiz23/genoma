<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('mailer/src/PHPMailer.php');
require_once('mailer/src/SMTP.php');
require_once('mailer/src/Exception.php');


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EnvioCorreo
 *
 * @author Sneider Rocha
 */
class EnvioCorreo {

    public function enviaCorreoDuponte($_email, $_NewPassword) {
        $mail = new PHPMailer(true);
        try {

            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
//            $mail->Username = 'soporte@ciclibi.com.co';
            $mail->Username = 'neider.1991@gmail.com';
            $mail->Password = 'Kartal1*';
//            $mail->Password = 'Ciclibi2020.';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('neider.1991@gmail.com', 'Esneider');
//            $mail->setFrom('soporte@ciclibi.com.co', 'Tubids.com.co');
            $mail->addAddress($_email);
            $mail->addEmbeddedImage('../dist/img/duponte-icono.png', 'duponte-icono.png');
            $mail->IsHTML(true);
            $mail->Subject = utf8_decode('Tu nueva contraseña esta lista!!!');

            $htmlBodyEmail = "<html>
                            <head>
                                <title>Correo</title>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                                <style type='text/css'>
                                    body{
                                        background: #201C42;
                                        display: flex;
                                        flex-wrap: wrap;
                                        justify-content: center;
                                        align-items: center;
                                        padding: 100px 15px 15px 15px;
                                        font-family: 'Trebuchet MS'
                                    }
                                    .p {
                                        color: #E50850;
                                        width: 960px;
                                        background: #C3E4E5;
                                        border-radius: 10px;
                                        overflow: hidden;
                                        flex-wrap: wrap;
                                        justify-content: space-between;
                                        padding: 50px;
                                    }
                                </style>
                            </head>

                            <body >
                                <div  class='p'>
                                    <table>
                                        <tr>
                                            <td> <img src='cid:duponte-icono.png' width='210' alt=''/></td>

                                            <td>&nbsp;&nbsp;</td>
                                            <td style='color:#201C42;'>Hola, tu nueva constrase&ntilde;a es la siguiente: <strong>" . $_NewPassword . "</strong> (Te remocentamos copiar y pegar). </td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'><strong>&nbsp;&nbsp;</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan='3'><strong>Este es un correo autom&aacute;tico, por favor NO responder.</strong></td>
                                        </tr>
                                    </table>

                                </div>
                            </body>
                        </html>";
            $mail->Body = $htmlBodyEmail;
            $mail->send();
            return $exito = 'Correo enviado!';
        } catch (Exception $e) {
            return $exito = "Error al enviar: " . $mail->ErrorInfo;
        }
    }

}

?>
