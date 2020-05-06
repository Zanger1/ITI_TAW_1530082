<?php 
class DOrdenCierreController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaCierre=DOrdenCierreModel::all();
		require_once('Views/inventario/index.php');
	}

	function register(){
		require_once('Views/inventario/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$cierre= new DOrdenCierreModel(null, $_POST['IdDetalleOrdenCierre'],$_POST['IdOrdenCierreRenta'],$_POST['IdEmpleado']);

		DOrdenCierreModel::save($cierre);
		$this->show();
	}

	function show(){
		$listaCierre=DOrdenCierreModel::all();

		require_once('Views/inventario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdDetalleOrdenCierre'];
		$cierre=DOrdenCierreModel::searchById($id);
		require_once('Views/inventario/updateshow.php');
	}

	function test_modal(){
		$id=$_GET['id'];
		$cierre=DOrdenCierreModel::searchById($id);
		require_once('Views/inventario/modal/ver.php');
	}

	function update(){
		$cierre = new DOrdenCierreModel($_POST['IdDetalleOrdenCierre'],$_POST['IdOrdenCierreRenta'],$_POST['IdEmpleado']);
		DOrdenCierreModel::update($cierre);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdDetalleOrdenCierre'];
		DOrdenCierreModel::delete($IdDetalleOrdenCierre);
		$this->show();
	}
	function error(){
		require_once('Views/inventario/error.php');
	}

}

?>