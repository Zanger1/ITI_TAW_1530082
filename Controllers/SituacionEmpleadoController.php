<?php 
class SituacionEmpleadosController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaSitEmpleados=SituacionEmpleadosModel::all();
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
	$Sitempleados= new SituacionEmpleadosModel(null, $_POST['IdSituacionEmpleado'],$_POST['DescSitEmpleado']);

		SituacionEmpleadosModel::save($Sitempleados);
		$this->show();
	}

	function show(){
		$listaSitEmpleados=SituacionEmpleadosModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$Sitempleado=SituacionEmpleadosModel::searchById($id);
		//require_once('Views/Sitempleados/updateshow.php');
		require_once('Views/empleados/modal/ver.php');
	}

	function update(){
		$Sitempleados = new SituacionEmpleadosModel($_POST['IdSituacionEmpleado'],$_POST['DescSitEmpleado']);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdSituacionEmpleado'];
		SituacionEmpleadosModel::delete($IdSituacionEmpleado);
		$this->show();
	}


	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>