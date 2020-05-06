<?php
	$extras = new ExtrasMatrizModel($_POST['IdExtra'],$_POST['NomExtra'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
	ExtrasMatrizModel::update($extras);
		print_r($_POST['IdExtra']);
?>
