<?php 
class SucursalServicioController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaSucursalS=SucursalServicioModel::all();
		require_once('Views/empleados/index.php');
	}

	function register(){
		require_once('Views/empleados/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$sucursal= new SucursalServicioModel(null, $_POST['idEmpleado'],$_POST['NobreEmpelado'],$_POST['ApellidoPat']);

		SucursalServicioModel::save($sucursal);
		$this->show();
	}

	function show(){
		$listaSucursalS=SucursalServicioModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$sucursalS=SucursalServicioModel::searchById($id);
		//require_once('Views/sucursal/updateshow.php');
		require_once('Views/empleados/modal/ver.php');
	}

	function update(){
		$sucursal = new SucursalServicioModel($_POST['idEmpleado'],$_POST['NobreEmpelado'],$_POST['ApellidoPat']);
		SucursalServicioModel::update($sucursal);
		$this->show();
	}
	function delete(){
		$id=$_GET['idEmpleado'];
		SucursalServicioModel::delete($idEmpleado);
		$this->show();
	}

	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>