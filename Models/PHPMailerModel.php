<?php 
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerModel {
    ///modificado por Paulina en modo de prueba
	/*public static function send($from_email, $from_fullname, $to_email, $to_fullname, $attachment_path, $attachment_new_filename, $is_html, $subject, $body, $alt_body){*/
	///---------------- PRUEBA ----------------------------------------
	public static function send($from_email, $from_fullname, $to_email, $to_fullname, $fullname_receive, $email_receive, $email_other, $attachment_path, $is_html, $subject, $body, $alt_body){
	/////------------------------------------------------------

		$mail = new PHPMailer(true);
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);
		
		
			##### Server settings
			$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'correopruebapollo@gmail.com';                     // SMTP username
			$mail->Password   = 'PoMeMiMa_M29112019';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 25; //587;// (25 en la escuela porque 587 esta bloqueado)                                   // TCP port to connect to

/////----------------------------------------------------------------
			##### FROM:
			//De quien envia			
			if(is_null($from_fullname))
			{
				$mail->setFrom($from_email);			
			} 
			else 
			{
				$mail->setFrom($from_email, $from_fullname);
			}

			//Para quien
			//Cliente
			/*if(is_null($to_fullname))
			{
				$mail->addAddress($to_email);
			}
			else
			{
				$mail->addAddress($to_email, $to_fullname);
			}*/

			if ((!is_null($to_fullname)) &&  (strlen(trim($to_email)) > 0))   //(!is_null($email_receive)))
			{
				$mail->addAddress($to_email, $to_fullname);				
			}
			else if (strlen(trim($to_email)) > 0) //!is_null($email_receive))
			{
				$mail->addAddress($to_email);
			}

             
            //Contacto o quien recibe
            //CC
			/*if(is_null($fullname_receive))
			{
				$mail->addCC($email_receive);
			}
			else
			{
				$mail->addCC($email_receive, $fullname_receive);
			}*/


			if ((!is_null($fullname_receive)) &&  (strlen(trim($email_receive)) > 0))   //(!is_null($email_receive)))
			{
				$mail->addCC($email_receive, $fullname_receive);				
			}
			else if (strlen(trim($email_receive)) > 0) //!is_null($email_receive))
			{
				$mail->addCC($email_receive);
			}


			//Otro
			if (strlen(trim($email_other)) > 0)//!is_null($email_other))
			{
				$mail->addBCC($email_other);
			}


			##### TO: (Is not prepared for multiple recipient!!!.. I'll Will add an array)
			/*
			if(is_null($to_fullname))
			{
				$mail->addAddress($to_email);
				//$mail->addCC('abigailgarza907@gmail.com');
				$mail->addCC($email_receive);
				$mail->addBCC($email_other);
			} else if(is_null($to_email)){
				$mail->addAddress($email_receive);
				$mail->addCC($email_other);

			} else if(is_null($email_receive)){
				$mail->addAddress($to_email, $to_fullname);
				$mail->addCC($email_other);

			} else if(is_null($email_other)){ ///si no tiene el correo otro
				$mail->addAddress($to_email, $to_fullname);
				$mail->addCC($email_receive);
				//$mail->addBCC($email_other);
			} else if(is_null($to_fullname) && is_null($email_other)){
				
				$mail->addAddress($to_email);
				$mail->addCC($email_receive);
				///$mail->addBCC($email_other)
			} else if(is_null($to_fullname) && is_null($email_receive)){
				
				$mail->addAddress($to_email);
				$mail->addCC($email_other);
				///$mail->addBCC($email_other)

			} else if(is_null($to_fullname) ||  is_null($to_email) && is_null($email_other)  )
			{

				$mail->addAddress($email_receive);
				
			} else if(is_null($to_fullname) || is_null($email_receive) && is_null($email_other))
			{

				$mail->addAddress($to_email);

			} else if(is_null($to_fullname) || is_null($to_email) && is_null($email_receive))
			{

				$mail->addAddress($email_other);

			} else { //este si lo envia a los tres correos
				$mail->addAddress($to_email, $to_fullname);
				$mail->addCC($email_receive);
				$mail->addBCC($email_other, 'Otro');
			}
			
			*/
			//$mail->addAddress('ellen@example.com');             
			#$mail->addReplyTo($, 'Information');

			##### Optional (Not configured with params)
			#$mail->addCC('cc@example.com');
			#$mail->addBCC('abigailgarza907@gmail.com');

			### Attachments: (Is not prepared for multiple recipient!!!.. I'll Will add an array)
			/*
			if(is_null($attachment_new_filename)){
				$mail->addAttachment($attachment_path);
			} else {
				$mail->addAttachment($attachment_path, $attachment_new_filename);
			}
			*/
			//jlopezl
			//se puso directo sin checar el $attachment_new_filename
			$mail->addAttachment($attachment_path);

			
			//$subjectFolio = VentasModel::
/////---------------------------------------------------------------

    		//$mail->setFrom('correopruebapollo@gmail.com', ' otra vez');
    		//$mail->addAddress('paulina.09castro@gmail.com', 'paulina');

			##### Content

//////---------------------------------------------------------------------------			
			////modificado por paulina para pruebas
  			///$mail->isHTML(true);                                  // Set email format to HTML
			////----Modificado por paulina en modo de prueba
		/*	$mail->Subject = 'Prueba 8 - traer valores del subject';
			
			$mail->Body    = 'Subject: '.$subject.'<br> Body: '.$body.'<br> alt_Body:  '.$alt_body.'<br> from_fullname: '.$from_email .' | from_email: '. $from_email.'<br> to_fullname: '. $to_fullname.' | to_email: '. $to_email.' <br>
							  Attachement_path <br>'.
							  $attachment_path .'<br>
							  Attachement_new_filename <br>'.
							  $attachment_new_filename;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		*/	

			
			$mail->isHTML($is_html);	// Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $body;
			$mail->AltBody = $alt_body;
			
			try 
			{
				$mail->send();
  
				if($mail)
				{
					echo 'Message has been sent';
				}
			} catch (Exception $e) 
			{
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
	}
	
	public static function callback()
	{
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM _pending_mail_queue WHERE sent=0');
		$select->execute();
		$results=$select->fetchAll();
		foreach($results as $item){

			if (!file_exists('./'.$item["attachment_path"]))
			{
				#echo '<br>no existe';
			} 
			else 
			{
				///Modificado por paulina en modo de prueba
					/*$mail_sent = self::send($item["from_email"], $item["from_fullname"], $item["to_email"],$item["to_fullname"], './'.$item["attachment_path"], null, true, $item["subject"], $item["msg"], $item["msg"]);*/
				
					$mail_sent = self::send($item["from_email"], 
						$item["from_fullname"], 
						$item["to_email"],
						$item["to_fullname"], 
						$item["fullname_receive"], 
						$item["email_receive"], 
						$item["email_other"], './'.$item["attachment_path"], true, $item["subject"], $item["msg"], $item["msg"]);                    
				if($mail_sent)
				{
					$mail_sent_status = 0;
				} else 
				{
					$mail_sent_status = 1;
				}
				
				//si se envio el correo marcarlo como enviado en la tabla _pending_mail_queue
				if($mail_sent_status==1){

					DataBase::speed_crud("UPDATE _pending_mail_queue SET sent=1 WHERE uk='".$item["uk"]."' ");
					if(file_exists('./'.$item["attachment_path"])){						
						unlink('./'.$item["attachment_path"]); #echo '<br>file deleted'; //Se borra en ese mismo instante
					} else 
					{
						#echo '<br>file to delete not found';
					}
				} else if($mail_sent_status==0) {
					//Error al enviar. Regresa a la cola y espera un nuevo intento para ser enviado
					DataBase::speed_crud("UPDATE _pending_mail_queue SET error='1' WHERE uk='".$item["uk"]."' ");
				}
			}
		}
		DataBase::speed_crud("DELETE FROM _pending_mail_queue WHERE sent=1");	//Borramos registros viejos (YA ENVIADOS)
	}

}

/*$pm = new PHPMailerModel;
$pm->send('envia@gmail.com', 'Nombre quien envia', 'recive@gmail.com', 'Nombre quien recive', './storage/Docs/2019/10/rentas-XXX.pdf', 'nuevo_doc_actualizado.pdf', true, 'Test Subject', 'This is the HTML message body <b>in bold!</b>', 'This is the body in plain text for non-HTML mail clients'); */
?>