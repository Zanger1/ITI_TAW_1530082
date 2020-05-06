<?php 

class CServiciosController
{
	
	function __construct()
	{
		
	}

	function index(){
				$listaServicio=CServiciosModel::all();
		require_once('Views/servicio-chica/index.php');
	

	}

	function register(){
		require_once('Views/servicio-chica/register.php');
	}

	function save(){
		$servicio= new CServiciosModel(null, $_POST['IdServicio'],$_POST['NombreServicio'], $_POST['Precio']);

		CServiciosModel::save($servicio);
		$this->show();
	}

	function show(){
		$listaServicio=CServiciosModel::all();

		require_once('Views/servicio-chica/index.php');
	}

	function updateshow(){
		$id=$_GET['IdCliente'];
		$servicio=CServiciosModel::searchById($id);
		require_once('Views/servicio-chica/updateshow.php');
	}

	function update(){
		$servicio = new CServiciosModel($_POST['IdServicio'],$_POST['NombreServicio'], $_POST['Precio']);
		CServiciosModel::update($servicio);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdServicio'];
		CServiciosModel::delete($IdServicio);
		$this->show();
	}


	function error(){
		require_once('Views/servicio/error.php');
	}

}

?>