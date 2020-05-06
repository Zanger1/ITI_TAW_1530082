<?php
class SucursalesController{

	function index(){
		$listaSucursales=SucursalesModel::all();
		require_once('Views/sucursales/index.php');
	}



	function register(){
		require_once('Views/sucursales/register.php');
	}

    function all_json(){
		/*
		jlopezl
		$listaClientes=ClientesModel::all_json();
		echo $listaClientes;
        */

        $listaSucursales= SucursalesModel::all_json();
		echo  $listaSucursales;

	}

	function save(){

		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		/*
		$sucursales= new SucursalesModel(null, $_POST['IdSucursal'],$_POST['Nombre'],$_POST['NombreContacto'],$_POST['CorreoContacto'],iudad'],$_POST['Direc
		$_POST['],$_POST['Telefono'],$_POST['IdTiIdCcion'poSucursal'],$_POST['LetraFolio']);
		*/

		$sucursales = new SucursalesModel(null, $_POST['Nombre'], $_POST['NombreContacto'], $_POST['CorreoContacto'], $_POST['IdCiudad'], $_POST['Direccion'], $_POST['Telefono'], $_POST['IdTipoSucursal'], $_POST['LetraFolio'], null);
		SucursalesModel::save($sucursales);
		#$this->show();
	}

	function show(){
		$listaSucursales=SucursalesModel::all();
		require_once('Views/sucursales/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$sucursal=SucursalesModel::searchById($id);
		require_once('Views/sucursales/modal.php');
		//require_once('Views/sucursales/modal/ver.php');
	}


	function update(){
		$sucursales = new SucursalesModel($_POST['IdSucursal'],$_POST['Nombre'],$_POST['NombreContacto'],$_POST['CorreoContacto'],
		$_POST['IdCiudad'],$_POST['Direccion'],$_POST['Telefono'],$_POST['IdTipoSucursal'],$_POST['LetraFolio'],null);
		SucursalesModel::update($sucursales);
		#$this->show();
	}

	function delete(){
		$id=$_GET['id'];
		SucursalesModel::delete($id);
		#$this->show();
	}



	function error(){
		require_once('Views/sucursales/error.php');
	}



}



?>