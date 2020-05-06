<?php 

class PrenominaController {

	function index(){
		include_once("Views/nomina/Prenomina/index.php");
	}
	
	function updateshow(){
		include_once("Views/nomina/Prenomina/modal.php");
	}
	
	function all_json(){
		
		$listaPrenomina=PrenominaModel::all_json();
		echo $listaPrenomina;
	}
	
	function save(){
        /*
		$MontoRestante = $_POST['MontoPrestamo'];
		$liquido=1;
		$Status=0;
		$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,$liquido, $_POST['Comentarios'],$Status);
		PrestamosModel::save($empleadoPrestamo);
		*/
 		$Pren = new PrenominaModel($_POST['idPrenomina'], $_POST['idSucursal'], $_POST['NoSemana'], $_POST['FechaInicio'], $_POST['FechaTermino'],trim($_POST['ComentarioSucursal']),3,$_POST['idEmpleado'],$_POST['FechaCaptura']);
		PrenominaModel::save($Pren);
		
		
		$this->index();
		

	}
	
	function update()
	{

		$Pren = new PrenominaModel($_POST['idPrenomina'], $_POST['idSucursal'], $_POST['NoSemana'], $_POST['FechaInicio'], $_POST['FechaTermino'],$_POST['ComentarioSucursal'], $_POST['Status'],$_POST['idEmpleado'],$_POST['FechaCaptura']);
 			PrenominaModel::update($Pren);
		$this->index();
		/*
		$MontoRestante = $_POST['MontoRestante'] - $_POST['AbonoSemana'];
		$liquido=1;
		$Status=0;
		if ($MontoRestante<=0) {
			$MontoRestante=0;
			$liquido=0;
		}
		$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,$liquido, $_POST['Comentarios'],$Status);
		PrestamosModel::update($empleadoPrestamo);
		*/

		/* ya estaba
		Puntos faltantes
		-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
		*/
	}
	
	function delete()
	{
		
		PrenominaModel::delete($_GET['id']);
		$this->index();
	}

} ?>