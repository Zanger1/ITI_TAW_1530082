<?php

class EmpleadoInfonavitController {

	function index(){
		include_once("Views/nomina/Infonavit/index.php");
	}

	function all_json(){
		$listaEmpleadosInfonavit=EmpleadoInfonavitModel::all_json();
		echo $listaEmpleadosInfonavit;
	}

	function updateshow(){
		include_once("Views/nomina/Infonavit/modal.php");
	}
		
	function save(){
		/*$MontoRestante = $_POST['CreditoInfonavit'];
		$liquido=1;
		$Status=0;
		$empleadoInfonavit = new EmpleadoInfonavitModel(null,$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_POST['EmpleadoCaptura'], $liquido, $_POST['Comentarios'],$Status);
		EmpleadoInfonavitModel::save($empleadoInfonavit);*/
		$MontoRestante = $_POST['CreditoInfonavit'];
		$liquido=0;
		$Eliminado=0;
		$empleadoInfonavit = new EmpleadoInfonavitModel(null,$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_SESSION['id_employe'], null, null, $liquido, $_POST['Comentarios'],$Eliminado);
		EmpleadoInfonavitModel::save($empleadoInfonavit);
	}
	
	function update(){

		$MontoRestante = $_POST['MontoRestante'];
		$liquido=0;
		$Eliminado=0;
		if ($MontoRestante<=0) {
			$MontoRestante=0;
			$liquido=1;
		}
		$empleadoInfonavit = new EmpleadoInfonavitModel($_POST['IdEmpleadoInfonavit'],$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_SESSION['id_employe'], null, null, $liquido, $_POST['Comentarios'],$Eliminado);
		EmpleadoInfonavitModel::update($empleadoInfonavit);

		/*$MontoRestante = $_POST['MontoRestante'] - $_POST['MontoSugerido'];
		$liquido=1;
		$Status=0;
		if ($MontoRestante<=0) {
			$MontoRestante=0;
			$liquido=0;
		}
		$empleadoInfonavit = new EmpleadoInfonavitModel($_POST['IdEmpleadoInfonavit'],$_POST['NameEmpleado'],$_POST['CreditoInfonavit'],$_POST['MontoSugerido'], $MontoRestante, null,$_POST['EmpleadoCaptura'], $liquido, $_POST['Comentarios'],$Status);
		EmpleadoInfonavitModel::update($empleadoInfonavit);*/

		/*
		Puntos faltantes
		-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
		*/
	}
	
	function delete(){
		//EmpleadoInfonavitModel::delete($_GET['id']);
		EmpleadoInfonavitModel::delete($_GET['id'], $_SESSION['id_employe']);
	}



} ?>