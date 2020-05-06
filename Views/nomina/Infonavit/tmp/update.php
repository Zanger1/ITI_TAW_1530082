<?php

	$MontoRestante = $_POST['MontoRestante'] - $_POST['MontoSugerido'];
	$liquido=1;
	$Status=0;
	if ($MontoRestante<=0) {
		$MontoRestante=0;
		$liquido=0;
	}
	$empleadoInfonavit = new EmpleadoInfonavitModel($_POST['IdEmpleadoInfonavit'],$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_POST['EmpleadoCaptura'], $liquido, $_POST['Comentarios'],$Status);
	EmpleadoInfonavitModel::update($empleadoInfonavit);

	/*
	Puntos faltantes
	-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
	*/
?>