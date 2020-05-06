<?php

class ExtrasMatrizController {

	function index(){
		include_once("Views/nomina/ExtrasMatriz/index.php");
	}

	function updateshow(){
		include_once("Views/nomina/ExtrasMatriz/modal.php");
	}
		
	function save(){
/*		
		$extras = new ExtrasMatrizModel($_POST['IdExtra'],$_POST['NomExtra'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
		ExtrasMatrizModel::save($extras);
*/
		//NULL = idCiudad
		ExtrasMatrizModel::save($_POST['NomExtra'], $_POST['MontoSugerido']);
	}
	
	function update(){
		
	$extras = new ExtrasMatrizModel($_POST['idExtra'],$_POST['NomExtra'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
	ExtrasMatrizModel::update($extras);
	}
	
	function delete(){
			ExtrasMatrizModel::delete($_GET['id']);
	}

  	function all_json(){
		$listaExtrasMatriz=ExtrasMatrizModel::all_json();
		echo $listaExtrasMatriz;
	}

} ?>
