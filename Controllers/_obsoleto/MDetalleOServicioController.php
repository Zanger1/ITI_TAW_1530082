<?php 
class MDetalleOServicioController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaMDetalleO=MDetalleOServicioModel::all();
		require_once('Views/MDetalleO/index.php');
	}

	function register(){
		require_once('Views/MDetalleO/register.php');
	}

	function save(){
		
		$MDetalleO= new MDetalleOServicioModel(null,$_POST['IdMaterialesDetalleServicio'],$_POST['IdDetalleOrdenServicio'],$_POST['IdMaterialesServicio'],$_POST['Cantidad'],$_POST['Precio']);
		MDetalleOServicioModel::save($MDetalleO);
		$this->show();
	}

	function show(){
		$listaMDetalleO=MDetalleOServicioModel::all();

		require_once('Views/MDetalleO/index.php');
	}

	function updateshow(){
		$id=$_GET['IdMaterialesDetalleServicio'];
		$MDetalleO=MDetalleOServicioModel::searchById($id);
		require_once('Views/MDetalleO/updateshow.php');
	}

	function update(){
		$MDetalleO = new MDetalleOServicioModel($_POST['IdMaterialesDetalleServicio'],$_POST['IdDetalleOrdenServicio'],$_POST['IdMaterialesServicio'],$_POST['Cantidad'],$_POST['Precio']);
		MDetalleOServicioModel::update($MDetalleO);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdMaterialesDetalleServicio'];
		MDetalleOServicioModel::delete($IdMaterialesDetalleServicio);
		$this->show();
	}

	function error(){
		require_once('Views/MDetalleO/error.php');
	}

}

?>