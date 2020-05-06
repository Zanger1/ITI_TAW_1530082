<?php
	//if(isset($_SESSION['id_sucursal']) && isset($_POST['semana']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_termino'])){
	//Formulario para guardar datos en la tabla de nomina sucursal 
	$idSucursal=$_SESSION["id_sucursal"];
	$NoSemana=$_POST['semana'];
	$FechaInicio=$_POST['fecha_inicio'];
	$FechaTermino=$_POST['fecha_termino'];

	NominaModel::save($idSucursal,$NoSemana,$FechaInicio,$FechaTermino);
?>