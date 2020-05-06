<?php 

class PrestamosController {

	function index(){
		include_once("Views/nomina/Prestamos/index.php");
	}
	
	function updateshow(){
		include_once("Views/nomina/Prestamos/modal.php");
	}
	
	function all_json(){
		$listaPrestamos=PrestamosModel::all_json();
		echo $listaPrestamos;
	}
	
	function save(){
		/*
		$MontoRestante = $_POST['MontoPrestamo'];
		$liquido=1;
		$Status=0;
		$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,$liquido, $_POST['Comentarios'],$Status);
		PrestamosModel::save($empleadoPrestamo);
*/
	$MontoRestante = $_POST['MontoPrestamo'];
	$liquido=0;
	$Status=0;
	$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'],$_POST['EmpleadoCaptura'],null,null,null,$liquido,$_POST['Comentarios'],$Status);
	PrestamosModel::save($empleadoPrestamo);


	}
	
	function update(){

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
		/*
		Puntos faltantes
		-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
		*/
	}
	
	function delete(){
		//PrestamosModel::delete($_GET['id']);
		PrestamosModel::delete($_GET['id'], $_SESSION['id_employe']);
	}

} ?>