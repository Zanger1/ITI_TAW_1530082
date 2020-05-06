<?php 

class ClientesController {

	function __construct(){
	}

	function index(){
		$listaClientes=ClientesModel::all();
		require_once('Views/clientes/index.php');
	}

	function register(){
		require_once('Views/clientes/register.php');
	}

	function all_json(){
		$listaClientes=ClientesModel::all_json();
		echo $listaClientes;
	}

	function save(){
		$clientes= new ClientesModel(null,$_POST['Nombre'],$_POST['Apellidos'],$_POST['RFC'],$_POST['Calle'],$_POST['Colonia'],
		$_POST['CodigoPostal'],$_POST['Num'],$_POST['IdCiudad'],$_POST['CorreoElectronico'],$_POST['Telefono']);
		ClientesModel::save($clientes);
		#$this->show();
	}

	function show(){
		$listaClientes=ClientesModel::all();
		require_once('Views/clientes/index.php');
	}

	function updateshow(){
		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$cliente=ClientesModel::searchById($id);
			//require_once('Views/empleados/updateshow.php');
			require_once('Views/clientes/modal.php');			
		}else{
		}
	}
	
	function load_info_for_invoice(){
		//Este metodo cargara la informacion del cliente a la vista previa en paso #4 al momento de hacer una cotizacion
		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$info=ClientesModel::load_info_for_invoice_html($id);
			echo $info;
		}
	}

	function update(){
		$clientes = new ClientesModel($_POST['IdCliente'],$_POST['Nombre'],$_POST['Apellidos'],$_POST['RFC'],$_POST['Calle'],$_POST['Colonia'],
		$_POST['CodigoPostal'],$_POST['Num'],$_POST['IdCiudad'],$_POST['CorreoElectronico'],$_POST['Telefono']);
		ClientesModel::update($clientes);
		#$this->show();
	}

	function delete(){
		$id=$_GET['id'];
		ClientesModel::delete($id);
		$this->show();
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
		require_once('Views/clientes/error.php');
	}

} ?>