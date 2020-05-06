<?php 

class EmpleasosOSalidaController
{
	
	function __construct()
	{
		
	}

	function index(){
				$listaempleadosOS=EmpleadosOSalidaModel::all();
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
		$empleadosOS= new EmpleadosOSalidaModel(null, $_POST['IdEmpleadosOrdenSalida'],$_POST['IdOrdenSalidaRenta'], $_POST['IdEmpleado']);

		EmpleadosOSalidaModel::save($empleadosOS);
		$this->show();
	}

	function show(){
		$listaempleadosOS=EmpleadosOSalidaModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['IdCliente'];
		$empleadosOS=EmpleadosOSalidaModel::searchById($id);
		require_once('Views/empleados/updateshow.php');
	}

	function update(){
		$empleadosOS = new EmpleadosOSalidaModel($_POST['IdEmpleadosOrdenSalida'],$_POST['IdOrdenSalidaRenta'], $_POST['IdEmpleado']);
		EmpleadosOSalidaModel::update($empleadosOS);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdEmpleadosOrdenSalida'];
		EmpleadosOSalidaModel::delete($IdEmpleadosOrdenSalida);
		$this->show();
	}

	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>