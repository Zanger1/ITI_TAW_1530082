<?php

	$MontoRestante = $_POST['CreditoInfonavit'];
	$liquido=1;
	$Status=0;
	$empleadoInfonavit = new EmpleadoInfonavitModel(null,$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_POST['EmpleadoCaptura'], $liquido, $_POST['Comentarios'],$Status);
	EmpleadoInfonavitModel::save($empleadoInfonavit);
?>