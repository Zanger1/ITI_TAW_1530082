<?php

	$MontoRestante = $_POST['MontoRestante'];
	$liquido=0;
	$Status=0;
	if ($MontoRestante<=0) {
		$MontoRestante=0;
		$liquido=1;
	}
	$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,null,null,$liquido, $_POST['Comentarios'],$Status);
	PrestamosModel::update($empleadoPrestamo);
	/*
	Nota
	-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
	*/
?>