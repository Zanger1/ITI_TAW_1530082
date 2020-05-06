<?php


		$extras = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
	ExtrasSucursalModel::delete($extras);


 ?>
