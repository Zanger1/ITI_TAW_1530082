<?php

	$MontoRestante = $_POST['MontoPrestamo'];
	$liquido=0;
	$Status=0;
	$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'],$_POST['EmpleadoCaptura'],null,null,null,$liquido,$_POST['Comentarios'],$Status);
	PrestamosModel::save($empleadoPrestamo);
?>