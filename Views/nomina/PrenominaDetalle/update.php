<?php
$extras = ExtrasSucursalModel::ExtrasNomb($_SESSION["id_sucursal"]);
 foreach ($extras as $ex) {

  $prendet = new PreNominaDetallesModel($_POST["IdPrenomidaDetalle".$ex->getIdExtra()],$_POST["idPrenominaExtra".$ex->getIdExtra()],$_POST["idEmpleado".$ex->getIdExtra()],$_POST["idExtraSucursal".$ex->getIdExtra()],$_POST["monto".$ex->getIdExtra()],$_POST["Cantidad".$ex->getIdExtra()],$_POST["Comentario".$ex->getIdExtra()],2," ",0);


  PreNominaDetallesModel::update($prendet);

 }


 ?>
