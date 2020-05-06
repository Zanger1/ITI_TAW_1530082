<?php 
class DOrdenServiciosController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaOrdenServicios=DOrdenServiciosModel::all();
		require_once('Views/OrdenServicios/index.php');
	}

	function register(){
		require_once('Views/OrdenServicios/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$OrdenServicios= new DOrdenServiciosModel(null, $_POST['IdDetalleOrdenServicio'],$_POST['IdOrdenServicio'],$_POST['IdServicio'],$_POST['Precio'],
		$_POST['Cantidad']);

		DOrdenServiciosModel::save($OrdenServicios);
		$this->show();
	}

	function show(){
		$listaOrdenServicios=DOrdenServiciosModel::all();

		require_once('Views/invetario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdDetalleOrdenServicio'];
		$OrdenServicios=DOrdenServiciosModel::searchById($id);
		require_once('Views/invetario/updateshow.php');
	}

	function test_modal(){
		$id=$_GET['id'];
		$OrdenServicios=DOrdenServiciosModel::searchById($id);
		require_once('Views/invetario/modal/ver.php');
	}

	function update(){
		$OrdenServicios = new DOrdenServiciosModel($_POST['IdDetalleOrdenServicio'],$_POST['IdOrdenServicio'],$_POST['IdServicio'],$_POST['Precio'],
		$_POST['Cantidad']);
		DOrdenServiciosModel::update($OrdenServicios);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdDetalleOrdenServicio'];
		DOrdenServiciosModel::delete($IdDetalleOrdenServicio);
		$this->show();
	}

	/*function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$OrdenServicios=DOrdenServiciosModel::searchById($id);
			$listaOrdenServicios[]=$OrdenServicios;
			//var_dump($id);
			//die();
			require_once('Views/Alumno/show.php');
		} else {
			$listaOrdenServicios=DOrdenServiciosModel::all();

			require_once('Views/OrdenServicios/show.php');
		}
		
		
	}*/

	function error(){
		require_once('Views/invetario/error.php');
	}

}

?>