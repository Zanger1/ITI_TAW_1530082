<?php 
class 	CStatusController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listastatus=CStatusModel::all();
		require_once('Views/inventario/index.php');
	}

	function register(){
		require_once('Views/inventario/register.php');
	}

	function save(){
		$status= new CStatusModel(null, $_POST['IdStatus'],$_POST['Descripcion']);

		CStatusModel::save($status);
		$this->show();
	}

	function show(){
		$listastatus=CStatusModel::all();

		require_once('Views/inventario/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$Status=CStatusModel::searchById($id);
		//require_once('Views/status/updateshow.php');
		require_once('Views/inventario/modal/ver.php');
	}

	function update(){
		$status = new CStatusModel($_POST['IdStatus'],$_POST['Descripcion']);
		CStatusModel::update($status);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdStatus'];
		CStatusModel::delete($IdStatus);
		$this->show();
	}

	function error(){
		require_once('Views/inventario/error.php');
	}

}

?>