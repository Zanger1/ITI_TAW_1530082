<?php
class EmpleadosController {
	function __construct(){
	}
	function index(){
		$listaEmpleados=EmpleadosModel::all();
		require_once('Views/empleados/index.php');
	}
	function all_json(){
		$output = EmpleadosModel::all_json();
		echo $output;
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
		/* $_POST['idEmpleado'], */
		$empleados = new EmpleadosModel(null, $_POST['NombreEmpleado'], //null, null, null, null, null, null, null, null, null, null );
		$_POST['ApellidoPat'], $_POST['Apellidomat'], $_POST['Sexo'], $_POST['CorreoElectronico'], $_POST['Telefono'], 
		$_POST['RFC'], $_POST['NSS'], $_POST['Fecha_ingreso'], $id_sucursal, $_POST['IdCategoriaEmpleado'],
		$_POST['SalarioDiario'], $_POST['PorcentajeCompensacion'], $_POST['IdSituacionEmpleado'], 0);	//Ese ultimo 0 es debido a que por Def, no es usuario
		EmpleadosModel::save($empleados);
		#$this->show();	//Descomentar en caso de dejar de usar AJAX y/o modales
	}
	function show(){
		$listaEmpleados=EmpleadosModel::all();
		require_once('Views/empleados/index.php');
	}
	function updateshow(){
			$empleado=EmpleadosModel::searchById($id);
			//require_once('Views/empleados/updateshow.php');
			require_once('Views/empleados/modal.php');			
		}
	}
	function update(){
		//Ahora el id se entrega por $_GET y deja de mostrarse por $_POST escondido en el form
		}
		$empleados = new EmpleadosModel($id,$_POST['NombreEmpleado'],$_POST['ApellidoPat'],$_POST['Apellidomat'],$_POST['Sexo'], 
		$_POST['CorreoElectronico'],$_POST['Telefono'],$_POST['RFC'],$_POST['NSS'],$_POST['Fecha_ingreso'],$id_sucursal,$_POST['IdCategoriaEmpleado'],
		$_POST['SalarioDiario'],$_POST['PorcentajeCompensacion'],$_POST['IdSituacionEmpleado'],null);
		EmpleadosModel::update($empleados);
		//$this->show();
	}
	function delete(){
		$id=$_GET['id'];
		EmpleadosModel::delete($id);
		//$this->show();
	}
	/*function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$empleados=EmpleadosModel::searchById($id);
			$listaEmpleados[]=$empleados;
			//var_dump($id);
			//die();
			require_once('Views/Alumno/show.php');
		} else {
			$listaEmpleados=EmpleadosModel::all();
			require_once('Views/empleados/show.php');
		}
	}*/
	function error(){
		require_once('Views/empleados/error.php');
	}
} ?>