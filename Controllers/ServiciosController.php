<?php 

class ServiciosController {

	function __construct(){
	}

	function index(){
		/*
		jlopezl
		$listaClientes=ClientesModel::all();
		require_once('Views/clientes/index.php');
		*/
        $listaServicios= ServiciosModel::all();
		require_once('Views/Servicios/index.php');

	}

	function register(){
		//jlopezl
		//require_once('Views/clientes/register.php');
        require_once('Views/Servicios/register.php');

	}

	function all_json(){
		/*
		jlopezl
		$listaClientes=ClientesModel::all_json();
		echo $listaClientes;
        */

         $listaServicios= ServiciosModel::all_json();
		echo  $listaServicios;

	}

	function save(){
		
		/*
		jlopezl
		$clientes= new ClientesModel(null,$_POST['Nombre'],$_POST['RFC'],$_POST['Calle'],$_POST['Colonia'],
		$_POST['CodigoPostal'],$_POST['Num'],$_POST['IdCiudad'],$_POST['CorreoElectronico'],$_POST['Telefono']);
		ClientesModel::save($clientes);
		#$this->show();

		*/

		$Servicios= new ServiciosModel(null,$_POST['NombreServicio']);
		ServiciosModel::save($Servicios);

	}

	function show(){
		/*
		jlopezl
		$listaClientes=ClientesModel::all();
		require_once('Views/clientes/index.php');
		*/

		$Servicios=ServiciosModel::all();
		require_once('Views/Servicios/index.php');



	}

	function updateshow(){
		/*
		jlopezl

		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$cliente=ClientesModel::searchById($id);
			//require_once('Views/empleados/updateshow.php');
			require_once('Views/clientes/modal.php');			
		}else{
		}
		*/


		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$Servicio=ServiciosModel::searchById($id);
			//require_once('Views/empleados/updateshow.php');
			require_once('Views/Servicios/modal.php');			
		}else{
		}

	}
	




	function load_info_for_invoice(){
		//Este metodo cargara la informacion del cliente a la vista previa en paso #4 al momento de hacer una cotizacion
		/*
		jlopezl
		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$info=ClientesModel::load_info_for_invoice_html($id);
			echo $info;
		}
		*/

		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$info=ServiciosModel::load_info_for_invoice_html($id);
			echo $info;
		}

	}




	function update(){
		/*
		jlopezl
		$clientes = new ClientesModel($_POST['IdCliente'],$_POST['Nombre'],$_POST['RFC'],$_POST['Calle'],$_POST['Colonia'],
		$_POST['CodigoPostal'],$_POST['Num'],$_POST['IdCiudad'],$_POST['CorreoElectronico'],$_POST['Telefono']);
		ClientesModel::update($clientes);
		#$this->show();
	   */

		$servicio = new ServiciosModel($_POST['IdServicio'],$_POST['NombreServicio']);
		ServiciosModel::update($servicio);
	}




	function delete(){
		/*
		jlopezl
		$id=$_GET['id'];
		ClientesModel::delete($id);
		$this->show();

		*/

		$IdServicio=$_GET['id'];
		ServiciosModel::delete($IdServicio);
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

		//require_once('Views/clientes/error.php');
		require_once('Views/Servicios/error.php');
	}

} ?>