<?php 

class NominaController {


	function index(){
		include_once("Views/nomina/Nomina/index.php");
	}

	function all_json(){
		
		$listaNomina=NominaModel::all_json();
		echo $listaNomina;
        
        //NominaModel::all_json(); 

	}

	function updateshow(){
		include_once("Views/nomina/Nomina/modal.php");
	}

	function addshow(){
		include_once("Views/nomina/Nomina/modalA.php");
	}

		
	function save(){
		/*
		$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],$_POST['idNominaSucursal'],$_POST['idEmpleado'],$_POST['idCategoriaEmpleado'],$_POST['NoDiasTrabajados'],$_POST['SeptimoDia'],$_POST['SueldoBase'],$_POST['Sueldo'],$_POST['TotalExtras'],$_POST['Infonavit'],$_POST['Prestamo'],$_POST['SaldoAnterior'],$_POST['Abono'],$_POST['SueldoActual'],$_POST['SueldoNeto'],$_POST['Comentarios'] );
		NominaModel::save($Nomina);
		*/

		//if(isset($_SESSION['id_sucursal']) && isset($_POST['semana']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_termino'])){
	//Formulario para guardar datos en la tabla de nomina sucursal 
		$idSucursal=$_SESSION["id_sucursal"];
		$NoSemana=$_POST['semana'];
		$FechaInicio=$_POST['fecha_inicio'];
		$FechaTermino=$_POST['fecha_termino'];

		NominaModel::save($idSucursal,$NoSemana,$FechaInicio,$FechaTermino);


	}



	
	function update(){
		/*$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],$_POST['idNominaSucursal'],$_POST['idEmpleado'],$_POST['idCategoriaEmpleado'],$_POST['NoDiasTrabajados'],$_POST['SeptimoDia'],$_POST['SueldoBase'],$_POST['Sueldo'],$_POST['TotalExtras'],$_POST['Infonavit'],$_POST['Prestamo'],$_POST['SaldoAnterior'],$_POST['Abono'],$_POST['SueldoActual'],$_POST['SueldoNeto'],$_POST['Comentarios']);*/
		/*
		$comentarios="a";
		if ($_POST['rol']==1) {
			$comentarios = $_POST['Comentarios'];
		}else{
			$comentarios = $_POST['ComentariosSucursal'];
		}

		$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],null,null,null,$_POST['NoDiasTrabajados'],null,null,null,null,null,null,null,$_POST['Abono'],null,null,$comentarios);
		NominaModel::update($Nomina);
      */
		$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],$_POST['idNominaSucursal'],$_POST['idEmpleado'],$_POST['idCategoriaEmpleado'],$_POST['NoDiasTrabajados'],$_POST['Septimo_Dia'],$_POST['SueldoBase'],$_POST['Sueldo'],$_POST['TotalExtras'],$_POST['Infonavit'],$_POST['Prestamo'],$_POST['SaldoAnterior'],$_POST['Abono'],$_POST['SueldoActual'],$_POST['SueldoNeto'],$_POST['ComentariosSucursal'],$_POST['ComentariosMatriz']);
		NominaModel::update($Nomina);

	}
	
	function delete(){
		//NominaModel::delete($_GET['id']);
		NominaModel::actualizar($_GET['id']);
	}

} ?>