<?php 
class 	CRolesController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaRol=CRolesModel::all();
		require_once('Views/roles/index.php');
	}

	function register(){
		require_once('Views/c_roles/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$roles= new CRolesModel(null, $_POST['IdRol'],$_POST['Rol']);

		CRolesModel::save($roles);
		$this->show();
	}

	function show(){
		$listaRol=CRolesModel::all();

		require_once('Views/c_roles/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$rol=CRolesModel::searchById($id);
		//require_once('Views/roles/updateshow.php');
		require_once('Views/c_roles/modal/ver.php');
	}

	function update(){
		$roles = new CRolesModel($_POST['IdRol'],$_POST['Rol']);
		CRolesModel::update($roles);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdRol'];
		CRolesModel::delete($IdRol);
		$this->show();
	}


	function error(){
		require_once('Views/c_roles/error.php');
	}

}

?>