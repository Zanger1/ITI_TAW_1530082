<?php 
class CTipoUnidadesController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listatipoUnidades=CTipoUnidadesModel::all();
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
		$tipoUnidades= new CTipoUnidadesModel(null,$_POST['IdTipoUnidades'],$_POST['DescTipoUnidad']);

		CTipoUnidadesModel::save($tipoUnidades);
		$this->show();
	}

	function show(){
		$listatipoUnidades=CTipoUnidadesModel::all();

		require_once('Views/inventario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdTipoUnidades'];
		$tipoUnidades=CTipoUnidadesModel::searchById($id);
		require_once('Views/inventario/updateshow.php');
	}

	function update(){
		$tipoUnidades = new CTipoUnidadesModel($_POST['IdTipoUnidades'],$_POST['DescTipoUnidad']);
		CTipoUnidadesModel::update($tipoUnidades);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdTipoUnidades'];
		CTipoUnidadesModel::delete($IdTipoUnidades);
		$this->show();
	}
	function error(){
		require_once('Views/inventario/error.php');
	}
}

?>