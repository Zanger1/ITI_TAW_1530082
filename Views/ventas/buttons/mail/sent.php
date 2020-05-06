<?php
#include("../Models/PHPMailerModel.php");
#$pm = new PHPMailerModel;

#include("../connection.php");
//$db = new DataBase;

/*
lo comentamos por que ya no se checa si el correo se envio o no.
la cotizacion se puede mandar en cualquier momento

if(isset($_GET["for_operation"]) && isset($_GET["clave_unica"])){
	$tbl = 'orden_'.$_GET["for_operation"];
	$sql = "UPDATE ".$tbl." SET correo_enviado='1' WHERE clave_unica='".$_GET["clave_unica"]."'";
	DataBase::speed_crud($sql);
}
*/

?>