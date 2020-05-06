<?php

	//$AgregarNomina = new AgregarNominaModel(null,$_SESSION["id_sucursal"],$_POST['semana'],$_POST['fecha_inicio'],$_POST['fecha_termino'],null, null, null, null, null, null, null, null, null, null,null,null);
	//AgregarNominaModel::agregar($AgregarNomina);

		$idSucursal=$_SESSION["id_sucursal"];
		$NoSemana=$_POST['semana'];
		$FechaInicio=$_POST['fecha_inicio'];
		$FechaTermino=$_POST['fecha_termino'];


	$db=Database::getConnect();

		$insert = $db->prepare('INSERT INTO nominasucursal(idSucursal, NoSemana, FechaInicio, FechaTermino) VALUES (?,?,?,?)');
		#$insert = $db->prepare('INSERT INTO nominasucursal VALUES (NULL, NULL,:NoSemana,:TIME,TIME,:TotalSeptimoDia,:TotalSueldoBase,:TotalSueldo,:TotalExtras,:TotalInfonavit,:TotalPrestamo,:TotalSaldoAnterior,:TotalAbono,:TotalSueldoActual,:TotalSueldoNeto,:idEmpleadoCaptura,:FechaCaptura');
		#Hacer procedimientos almacenados
		#$insert->bindvalue('IdRuta', $Rutas->getIdRuta());
		$insert->bindvalue(1, $idSucursal);
		$insert->bindvalue(2, $NoSemana);
		$insert->bindvalue(3, $FechaInicio);
		$insert->bindvalue(4, $FechaTermino);

		#$insert->bindvalue('FechaCaptura', $AgregarNomina->getFechaCaptura());
		#$insert->bindvalue('IdEmpleadoCierre', $Rutas->getIdEmpleadoCierre());
		#$insert->bindvalue('FechaCierre', $Rutas->getFechaCierre());
		
		$insert->execute();#Validar antes de 
		//header("Location :/Views/Nomina/agregar.php");
		NominaModel::cargarDatos($idSucursal);




?>