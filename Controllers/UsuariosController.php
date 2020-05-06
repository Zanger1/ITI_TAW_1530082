<?php 

/**
* 
*/

class UsuariosController {
	function __construct(){
	}

	function index(){
		require_once('Views/usuarios/index.php');
	}

	function all_json(){
		$output = UsuariosModel::all_json();
		echo $output;
	}

	function register(){
		require_once('Views/Usuarios/register.php');
	}
	
	function check_username(){
		if(isset($_GET["usuario"])){
			$usuario=$_GET['usuario'];
			$check=UsuariosModel::check_username($usuario);
			echo $check;
		}
	}

	function save(){
		$id_sucursal = '';
		if(isset($_SESSION["id_role"]) && $_SESSION["id_role"] !== '1'){	//NO ES EL ADMIN GENERAL
			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION
		} else {
			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST
		}
		$admin= new UsuariosModel(null,$_POST['IdEmpleado'],$_POST['usuario'], md5($_POST['contrasena']), $_POST["IdRol"], $id_sucursal, $_POST["estatus"]);
		UsuariosModel::save($admin);
		//$this->show();
	}

	function show(){
		$listaAdmins=UsuariosModel::all();
		require_once('Views/usuarios/index.php');
	}

	function showSelect(){
		$listaAdmins=UsuariosModel::allSelect();
		#require_once('Views/usuarios/showSelect.php');
	}

	function updateshow(){
		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$usuario=UsuariosModel::searchById($id);
			require_once('Views/usuarios/modal.php');
		} else {
		}
	}

	function update(){
		$id_sucursal = '';
		if(isset($_SESSION["id_role"]) && $_SESSION["id_role"] !== '1'){	//NO ES EL ADMIN GENERAL
			$id_sucursal = $_SESSION["id_sucursal"];	//EL form se les deshabilita y no envia el POST, entonces recurrir a su SESSION
		} else {
			$id_sucursal = $_POST["IdSucursal"];	//El admin general si puede decidir que Id de Sucursal mandar en un Request tipo $_POST
		}

		$admin = new UsuariosModel($_POST['IdUsuario'],$_POST['IdEmpleado'],$_POST['usuario'], md5($_POST['contrasena']), $_POST["IdRol"], $id_sucursal, $_POST["estatus"]);
		UsuariosModel::update($admin);
		#$this->show();	//Usar solo si los modales no se usan
	}

	function delete(){
		$id=$_GET['id'];
		UsuariosModel::delete($id);
		#$this->show();	//Usar solo si los modales no se usan
	}

	function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$admin=UsuariosModel::searchById($id);
			$listaAdmins[]=$admin;
			//var_dump($id);
			//die();
			require_once('Views/Usuarios/show.php');
		} else {
			$listaAdmins=UsuariosModel::all();
			require_once('Views/Usuarios/show.php');
		}
	}

	function showOnlyName($id){
			$admin=UsuariosModel::showName($id);
			$listaAdmins[]=$admin;
	}

	function error(){
		require_once('Views/Usuarios/error.php');
	}

	function sign_in(){
		if(isset($_POST["enter"])){
			if(empty($_POST['username']) || empty($_POST['password'])){
				//El objeto no esta mandando nada al constructor, asi que, anulamos los params para que no marque error
				$session = new UsuariosModel(NULL,NULL,NULL,NULL,NULL,NULL,NULL);
				echo '<script>alert("Ingrese sus datos");</script>';
			} else { //if(isset($_POST['username']) && isset($_POST['password'])) {
				#echo '<script>alert("lo intento");</script>';
				$session = new UsuariosModel(NULL,NULL,$_POST['username'],$_POST['password'],NULL,NULL,NULL);
				#echo "<script>alert('".$_POST['username']."');</script>";
			}
			UsuariosModel::sign_in($session);
			#$this->login();
	#s\		require_once('Views/Session/sign_in.php');
		}
	}

	function sign_out(){
		// Initialize the session
		#session_start();
		// Unset all of the session variables
		$_SESSION = array();
		// Destroy the session.
		session_destroy();
		header("Location: index.php");
	}
}

?>