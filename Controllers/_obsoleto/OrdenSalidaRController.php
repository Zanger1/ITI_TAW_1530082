<?php 
class OrdenSalidaRController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaOrden=OrdenSalidaRModel::all();
		require_once('Views/OrdenS/index.php');
	}

	function register(){
		require_once('Views/OrdenS/register.php');
	}

	function save(){
		$OrdenS= new OrdenSalidaRModel(null,$_POST['IdOrdenSalidaRenta'],$_POST['IdOredenRenta'],$_POST['Fecha'],$_POST['Hora'],$_POST['Colonia']);

		OrdenSalidaRModel::save($OrdenS);
		$this->show();
	}

	function show(){
		$listaOrden=OrdenSalidaRModel::all();

		require_once('Views/OrdenS/index.php');
	}

	function updateshow(){
		$id=$_GET['IdOrdenSalidaRenta'];
		$OrdenS=OrdenSalidaRModel::searchById($id);
		require_once('Views/OrdenS/updateshow.php');
	}

	function update(){
		$OrdenS = new OrdenSalidaRModel($_POST['IdOrdenSalidaRenta'],$_POST['IdOredenRenta'],$_POST['Fecha'],$_POST['Hora'],$_POST['Colonia']);
		OrdenSalidaRModel::update($OrdenS);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdOrdenSalidaRenta'];
		OrdenSalidaRModel::delete($IdOrdenSalidaRenta);
		$this->show();
	}

	function error(){
		require_once('Views/OrdenS/error.php');
	}

}

?>