<?php 
class ReporteServiciosController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaReportes=ReporteServiciosModel::all();
		require_once('Views/empleados/index.php');
	}

	function register(){
		require_once('Views/empleados/register.php');
	}

	function save(){
		$reportes= new ReporteServiciosModel(null, $_POST['IdReoprteServicio'],$_POST['IdSucursalServicio'],$_POST['Folio'],$_POST['Documento'],$_POST['Fecha_Creacion']);
		ReporteServiciosModel::save($reportes);
		$this->show();
	}

	function show(){
		$listaReportes=ReporteServiciosModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$empleado=ReporteServiciosModel::searchById($id);
		//require_once('Views/empleados/updateshow.php');
		require_once('Views/empleados/modal/ver.php');
	}

	function update(){
		$empleados = new ReporteServiciosModel($_POST['IdReoprteServicio'],$_POST['IdSucursalServicio'],$_POST['Folio'],$_POST['Documento'],$_POST['Fecha_Creacion']);
		ReporteServiciosModel::update($reportes);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdReoprteServicio'];
		ReporteServiciosModel::delete($IdReoprteServicio);
		$this->show();
	}

	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>