<?php 
class CEstadosController {
	function __construct()
	{
	}

	function index(){
		$listaClientes=CEstadosModel::all();
		require_once('Views/invetario/index.php');
	}
	function register(){
		require_once('Views/invetario/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$Estados= new CEstadosModel(null,$_POST['IdEstado'],$_POST['Estado']);
		CEstadosModel::save($Estados);
		$this->show();
	}
	function show(){
		$listaClientes=CEstadosModel::all();
		require_once('Views/invetario/index.php');
	}
	function updateshow(){
		$id=$_GET['IdEstado'];
		$Estados=CEstadosModel::searchById($id);
		require_once('Views/invetario/updateshow.php');
	}
	function update(){
		$Estados = new CEstadosModel($_POST['IdEstado'],$_POST['Estado']);
		CEstadosModel::update($Estados);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdEstado'];
		CEstadosModel::delete($IdEstado);
		$this->show();
	}
	function error(){
		require_once('Views/invetario/error.php');
	}	
}
?>