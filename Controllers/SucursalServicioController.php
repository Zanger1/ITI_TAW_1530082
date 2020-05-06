<?php 

class SucursalServicioController

{
	function __construct()
	{

	}



	function index(){
		require_once('Views/inventario/Servicios/index.php');
	}

	function all_json(){
		$listaSucursalS=SucursalServicioModel::all_json();
	}


	function register(){
		require_once('Views/empleados/register.php');
	}



	function save(){

		$id_sucursal = '';
		if(isset($_SESSION["id_role"]) && $_SESSION["id_role"] !== '1'){	//NO ES EL ADMIN GENERAL
			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION
		} else {
			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST
		}

		//$UnidadesRenta= new UnidadesRentaModel(null,$_POST['DesUnidad']);
		//UnidadesRentaModel::save($UnidadesRenta);
		$sucursal= new SucursalServicioModel(null, $id_sucursal, $_POST['IdServicio'], $_POST['IdTamano'], $_POST['precio'], $_POST['descripcion'], $_POST['incluye']
		);
		SucursalServicioModel::save($sucursal);
		#$this->show();
	}



	function show(){
		$listaSucursalS=SucursalServicioModel::all();
		require_once('Views/empleados/index.php');
	}



	function updateshow(){
		$id=$_GET['id'];
		$sucursalS=SucursalServicioModel::searchById($id);
		//require_once('Views/sucursal/updateshow.php');
		//require_once('Views/empleados/modal/ver.php');
		require_once('Views/inventario/Servicios/modal.php');
	}



	function update(){
		$id_sucursal = '';
		if(isset($_SESSION["id_role"]) && $_SESSION["id_role"] !== '1'){	//NO ES EL ADMIN GENERAL
			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION
		} else {
			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST
		}

	$sucursal= new SucursalServicioModel($_POST['IdSucursalServicio'], $id_sucursal, $_POST['IdServicio'], $_POST['IdTamano'], $_POST['precio'], $_POST['descripcion'], $_POST['incluye']
		);


		SucursalServicioModel::update($sucursal);
		#$this->show();
	}

	function delete(){
		$id=$_GET['id'];
		SucursalServicioModel::delete($id);
		#$this->show();
	}

	function error(){
		require_once('Views/empleados/error.php');
	}



}



?>