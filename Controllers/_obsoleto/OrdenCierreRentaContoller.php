<?php 
class OrdenCierreRentaController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaOrdenCierreR=OrdenCierreRentaModel::all();
		require_once('Views/ordenc/index.php');
	}

	function register(){
		require_once('Views/ordenc/register.php');
	}

	function save(){
		$ordenc= new OrdenCierreRentaModel(null,$_POST['IdOrdenCierreRenta'],$_POST['IdOrdenRenta'],
		$_POST['Fecha'],$_POST['Hora'],$_POST['IdEmpleadoCaptura'],$_POST['IdSucursalEntrega']);

		OrdenCierreRentaModel::save($ordenc);
		$this->show();
	}

	function show(){
		$listaOrdenCierreR=OrdenCierreRentaModel::all();

		require_once('Views/ordenc/index.php');
	}

	function updateshow(){
		$id=$_GET['IdOrdenCierreRenta'];
		$ordenc=OrdenCierreRentaModel::searchById($id);
		require_once('Views/ordenc/updateshow.php');
	}

	function update(){
		$ordenc = new OrdenCierreRentaModel($_POST['IdOrdenCierreRenta'],$_POST['IdOrdenRenta'],
		$_POST['Fecha'],$_POST['Hora'],$_POST['IdEmpleadoCaptura'],$_POST['IdSucursalEntrega']);
		OrdenCierreRentaModel::update($ordenc);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdOrdenCierreRenta'];
		OrdenCierreRentaModel::delete($IdOrdenCierreRenta);
		$this->show();
	}


	function error(){
		require_once('Views/ordenc/error.php');
	}

}

?>