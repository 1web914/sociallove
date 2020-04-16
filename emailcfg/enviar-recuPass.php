<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
//require 'C:\xampp\htdocs\sociallove\vendor\autoload.php';
// Instantiation and passing `true` enables exceptions
require 'vendor/autoload.php';

include_once('messageRecuPass.php');

//$message = 'message.php';
//$body = @readfile('message.html');   falla

$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'redsociallove@gmail.com';         // SMTP cuenta que utilizara la web para enviar
    $mail->Password   = 'patata4444';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('redsociallove@gmail.com','SocialLove :: Recuperar clave');   //desde donde
    $mail->addAddress($emaildestino);     // DESTINO a quien enviamos
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Recuperacion de tu clave';
    //$mail->Body    = 'Para activar tu cuenta pulsa aqui <b>ENLACE!</b>';

    $mail->Body = $messageRecuPass;
    //include 'enviar-confirmacion.php';

    $mail->send();
    //echo 'Message enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
