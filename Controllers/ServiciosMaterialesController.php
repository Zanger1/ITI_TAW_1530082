<?php 
class ServiciosMaterialesController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaServiciosM=ServicioMaterialesModel::all();
		require_once('Views/empleados/index.php');
	}

	function register(){
		require_once('Views/empleados/register.php');
	}

	function save(){
		$servicioM= new ServicioMaterialesModel(null, $_POST['IdServicioMateriales'],$_POST['IdServicio'],$_POST['IdMaterialesServicio'],$_POST['Catidad']);
		ServicioMaterialesModel::save($servicioM);
		$this->show();
	}

	function show(){
		$listaServiciosM=ServicioMaterialesModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$servicio=ServicioMaterialesModel::searchById($id);
		//require_once('Views/empleados/updateshow.php');
		require_once('Views/empleados/modal/ver.php');
	}

	function update(){
		$servicioM = new ServicioMaterialesModel($_POST['IdServicioMateriales'],$_POST['IdServicio'],$_POST['IdMaterialesServicio'],$_POST['Catidad']);
		ServicioMaterialesModel::update($servicioM);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdServicioMateriales'];
		ServicioMaterialesModel::delete($IdServicioMateriales);
		$this->show();
	}

	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>