<?php
#include("../connection.php");
if(isset($_GET["for_operation"]) && isset($_GET["clave_unica"])){
	$tbl = 'orden_'.$_GET["for_operation"];
	$estatus_correo = DataBase::check_current_value($tbl, 'correo_enviado', 'clave_unica', $_GET["clave_unica"]);

	$boton='';
	if($estatus_correo>0)
	{
		//$boton = '<button type="button" class="btn btn-sucess">Enviado</button>';
	} 
	else 
	{
	if(isset($_GET["sent"]) && $_GET["sent"]=='true')
		{
			$boton = '<button type="button" class="btn btn-secondary">Enviado</button>';
		} else 
		{
			$boton = '<button type="button" class="btn btn-info btn-md"  id="button-send-mail">Enviar correo</button>';		
		}
	}
	$email_info = VentasModel::getEmailsByUk($_GET["clave_unica"], $_GET["for_operation"]);

?>
<div class="row">
<!-- correo -->
				<!-- #Paulina 
					modificado para acomodar los campos de manera correcta -->
			
						<div class="row">
							<div class="form-group col-sm-6" >
								<label for="Cliente" class="mr-sm-2">Cliente</label>							
								<input type="email" class="form-control" id="email-cliente2" name="email-cliente2" placeholder="" value="<?php echo $email_info[1];?>" required>
							</div>
						
							<div class="form-group col-sm-6">
								<label for="Contacto" class="mr-sm-2">Contacto</label>
								<input type="email" class="form-control" id="email-contacto2" placeholder="Contacto - Correo" value="<?php echo $email_info[3]; ?>">
							</div>
							<div class="form-group col-sm-6" >
								<label for="Cliente" class="mr-sm-2">Otros</label>
								<input type="email" class="form-control" id="email-otro2" placeholder="Otro correo">
								<br>
								<?php 	echo $boton; ?>
							</div>
							
						</div>
						
						<!--
						<button type="submit" class="btn btn-info mb-2" id="button-send-mail">Enviar Correo</button>
					-->
				
				
	
	<!--form action="get" >
		<div class="form-group col-sm-5">
			<label for="Cliente">Cliente:</label>
			<input type="email-cliente2" class="form-control" id="email" placeholder="Enter email" name="email" required>
		</div>
		<div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" required>
		</div>
		<button-- type="submit" class="btn btn-info" id="button-send-mail">Enviar Correo</button-->
   			
</div> 





<?php
	//$boton = '<button type="submit" class="btn btn-info" id="button-send-mail">Enviar Correo</button>';		


	

}

//Los iff de arriba se pueden comentar e inclusive poner el boton enviar de forma directa 


#include("../Models/PHPMailerModel.php");
#$pm = new PHPMailerModel;
#####....
#1. Generar PDF
#2. PHPMailer
	#$pm->send('manuelruiz.1240@gmail.com', 'Nombre quien envia', 'manuelruiz.1240@gmail.com', 'Nombre quien recive', '../storage/Docs/2019/10/rentas-WJFWZ8DayPnUESE.pdf', 'nuevo_doc_actualizado.pdf', true, 'Test Subject', 'This is the HTML message body <b>in bold!</b>', 'This is the body in plain text for non-HTML mail clients'); */
#PD, al editar una cotizacion, la columna "correo_enviado" debe resetearse en = 0; Por si el cliente quiere cambios, se modifica una vez mas y se vuelve a enviar 1 sola vez por modificacion
?>