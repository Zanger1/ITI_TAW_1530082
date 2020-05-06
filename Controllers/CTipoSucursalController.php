<?php 
class CTipoSucursalController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listatipoSucursal=CTipoSucursalModel::all();
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
		$tipoSucursal= new CTipoSucursalModel(null,$_POST['IdTipoSucursal'],$_POST['TipoSucursal']);

		CTipoSucursalModel::save($tipoSucursal);
		$this->show();
	}

	function show(){
		$listatipoSucursal=CTipoSucursalModel::all();

		require_once('Views/inventario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdTipoSucursal'];
		$tipoSucursal=CTipoSucursalModel::searchById($id);
		require_once('Views/inventario/updateshow.php');
	}

	function update(){
		$tipoSucursal = new CTipoSucursalModel($_POST['IdTipoSucursal'],$_POST['TipoSucursal']);
		CTipoSucursalModel::update($tipoSucursal);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdTipoSucursal'];
		CTipoSucursalModel::delete($IdTipoSucursal);
		$this->show();
	}
	function error(){
		require_once('Views/inventario/error.php');
	}
}

?>