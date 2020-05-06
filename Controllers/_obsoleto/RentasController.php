<?php class RentasController {
	function __construct(){
	}
	function index(){
		$listaRentas=RentasModel::all();
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
		$rentas= new RentasModel(null, $_POST['IdUnidadRenta'],$_POST['DesUnidad']);
		RentasModel::save($rentas);
		$this->show();
	}
	function show(){
		$listaRentas=RentasModel::all();
		require_once('Views/inventario/index.php');
	}	function updateshow(){
		$id=$_GET['IdUnidadRenta'];
		$rentas=RentasModel::searchById($id);
		require_once('Views/inventario/updateshow.php');
	}
	function test_modal(){
		$id=$_GET['id'];
		$rentas=RentasModel::searchById($id);
		require_once('Views/inventario/modal/ver.php');
	}
	function update(){
		$rentas = new RentasModel($_POST['IdUnidadRenta'],$_POST['DesUnidad']);
		RentasModel::update($rentas);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdUnidadRenta'];
		RentasModel::delete($IdUnidadRenta);
		$this->show();
	}
	function error(){
		require_once('Views/inventario/error.php');
	}
} ?>