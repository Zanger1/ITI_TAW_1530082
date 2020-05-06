<?php 
class SucursalesController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaSucursales=SucursalesModel::all();
		require_once('Views/sucursales/index.php');
	}

	function register(){
		require_once('Views/sucursales/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$sucursales= new SucursalesModel(null, $_POST['IdSucursal'],$_POST['Nombre'],$_POST['NombreContacto'],$_POST['CorreoContacto'],
		$_POST['IdCiudad'],$_POST['Direccion'],$_POST['Telefono'],$_POST['IdTipoSucursal'],$_POST['LetraFolio']);

		SucursalesModel::save($sucursales);
		$this->show();
	}

	function show(){
		$listaSucursales=SucursalesModel::all();

		require_once('Views/sucursales/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$sucursal=SucursalesModel::searchById($id);
		//require_once('Views/sucursales/updateshow.php');
		require_once('Views/sucursales/modal/ver.php');
	}

	function update(){
		$sucursales = new SucursalesModel($_POST['IdSucursal'],$_POST['Nombre'],$_POST['NombreContacto'],$_POST['CorreoContacto'],
		$_POST['IdCiudad'],$_POST['Direccion'],$_POST['Telefono'],$_POST['IdTipoSucursal'],$_POST['LetraFolio']);
		SucursalesModel::update($sucursales);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdSucursal'];
		SucursalesModel::delete($IdSucursal);
		$this->show();
	}

	function error(){
		require_once('Views/sucursales/error.php');
	}

}

?>