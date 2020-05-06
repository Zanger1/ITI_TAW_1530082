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
		}*/				$id_sucursal = '';		if(isset($_SESSION["id_role"]) && $_SESSION["id_role"] !== '1'){	//NO ES EL ADMIN GENERAL			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION		} else {			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST		}
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
	function updateshow(){		if(isset($_GET["id"])){			$id=$_GET['id'];
			$empleado=EmpleadosModel::searchById($id);
			//require_once('Views/empleados/updateshow.php');
			require_once('Views/empleados/modal.php');					}else{
		}
	}
	function update(){
		//Ahora el id se entrega por $_GET y deja de mostrarse por $_POST escondido en el form		$id_sucursal = '';	if(isset($_SESSION["id_role"]) && isset($_SESSION["id_sucursal"])){		if($_SESSION["id_role"] == '1'){	//NO ES EL ADMIN GENERAL			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST		}		else if($_SESSION["id_role"]=='2' || $_SESSION["id_role"]=='3') {			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION
		}	}		$id = $_POST['IdEmpleado'];
		$empleados = new EmpleadosModel($id,$_POST['NombreEmpleado'],$_POST['ApellidoPat'],$_POST['Apellidomat'],$_POST['Sexo'], 
		$_POST['CorreoElectronico'],$_POST['Telefono'],$_POST['RFC'],$_POST['NSS'],$_POST['Fecha_ingreso'],$id_sucursal,$_POST['IdCategoriaEmpleado'],
		$_POST['SalarioDiario'],$_POST['PorcentajeCompensacion'],$_POST['IdSituacionEmpleado'],null);
		EmpleadosModel::update($empleados);		#echo $id_sucursal;
		//$this->show();		#var_dump($empleados);
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