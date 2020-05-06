<?php

class ExtrasSucursalController{

	function index(){
		include_once("Views/nomina/ExtrasSucursal/index.php");
	}

	function all_json(){
		$listaExtrasSucursal=ExtrasSucursalModel::all_json();
		echo $listaExtrasSucursal;
	}
	
	function updateshow(){
		include_once("Views/nomina/ExtrasSucursal/modal.php");
	}
		
	function save(){
		  $extrasSuscursal = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);
 //print_r($extrasSuscursal);
  ExtrasSucursalModel::save($extrasSuscursal);
/*
		  $extrasSuscursal = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);
 			//print_r($extrasSuscursal);
  		ExtrasSucursalModel::save($extrasSuscursal);

  		*/
		/*pendiente*/
	}
	
	function update(){

			$extras = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtraBn'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
			ExtrasSucursalModel::update($extras);

		/*
		$extras = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
		ExtrasSucursalModel::update($extras);
		*/
		/*
	$extras = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
	ExtrasSucursalModel::update($extras); */

	}
	
	function delete(){
		ExtrasSucursalModel::delete($_GET['id'],$_SESSION['id_sucursal']);

		/*
		$extras = new ExtrasSucursalModel($_POST['idExtraSucursal'],$_POST['IdExtra'],$_POST['idSucursal'],$_POST['MontoSugerido'],$_POST['Status']);	//NULL = idCiudad
		ExtrasSucursalModel::delete($extras);


	*/

	}

}

?>

