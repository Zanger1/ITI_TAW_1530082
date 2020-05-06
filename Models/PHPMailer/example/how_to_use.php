<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Exception.php';
require '../PHPMailer.php';
require '../SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    /////prueba1
    /*$email_user = "paulina.09castro@gmail.com";
    $email_password = "closeloverange09";
    $the_subject = "Phpmailer prueba by Evilnapsis.com";
    $address_to = "paulina.castro.alejoscbtis271@gmail.com";
    $from_name = "crayola09";
    $phpmailer = new PHPMailer();
    
    // ---------- datos de la cuenta de Gmail -------------------------------
    $phpmailer->Username = $email_user;
    $phpmailer->Password = $email_password; 
    //-----------------------------------------------------------------------
    // $phpmailer->SMTPDebug = 1;
    $phpmailer->SMTPSecure = 'ssl';
    $phpmailer->Host = "smtp.gmail.com"; // GMail
    $phpmailer->Port = 465;
    $phpmailer->IsSMTP(); // use SMTP
    $phpmailer->SMTPAuth = true;


    $phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email*/

//------>
    
    
    //Server settings
    $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    //$mail->IsSMTP();  
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->SMTPSecure = 'ssl';//'tls';
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->Port       = 25;// (25 en la escuela porque 587 esta bloqueado) 

    //$mail->Username   = 'manuelruiz.1240@gmail.com';                     // SMTP username
    //$mail->Password   = 'manuelruiz21';                               // SMTP password
    $mail->Username   = 'paulina.09castro@gmail.com';                     // SMTP username
    $mail->Password   = 'closeloverange09'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                                      // TCP port to connect to
////
   /* $mail->SMTPKeepAlive = true;  
    $mail->Mailer = "smtp"; 
    $mail->CharSet = 'utf-8'; 
*/
///


    //Recipients
    //$mail->setFrom('manuelruiz.1240@gmail.com', 'el Mannuel');
    //$mail->addAddress('manuelruiz.1240@gmail.com', 'Joe User');     // Add a recipient

    $mail->setFrom('paulina.castro.alejoscbtis271@gmail.com', ' otra vez');
    $mail->addAddress('paulina.09castro@gmail.com', 'Paulina Castro');

////<------
    #$mail->addAddress('ellen@example.com');               // Name is optional
#    $mail->addReplyTo('info@example.com', 'Information');
#    $mail->addCC('cc@example.com');
#    $mail->addBCC('bcc@example.com');

    // Attachments
	//$mail->addAttachment('../../../storage/Docs/2019/10/rentas-WJFWZ8DayPnUESE.pdf', 'demo.pdf');         // Add attachments
#	$mail->addAttachment('../doc.txt');         // Add attachments
#    $mail->addAttachment('../themes/lte/assets/plugins/PDF/invoicr/example/index.php?for=rentas&uk=WJFWZ8DayPnUESE', 'test.pdf');         // Add attachments
#    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
#    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}