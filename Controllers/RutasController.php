<?php 

class RutasController {

	function index(){
		include_once("Views/nomina/Rutas/index.php");
	}

	function all_json(){
		$listaRutas=RutasModel::all_json();
		echo $listaRutas;
	}

	function updateshow(){
		include_once("Views/nomina/Rutas/modal.php");
	}
		
	function save(){
		/*
		$Status=1;
		$rutas = new RutasModel(null,$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],$_POST['EmpleadoCaptura'],null,null,null,$Status);
		RutasModel::save($rutas);
		*/

		$Status=0;
		$rutas = new RutasModel(null,$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],$_SESSION['id_sucursal'],$_POST['EmpleadoCaptura'],null,null,null,$Status);
		RutasModel::save($rutas);
	}
	
	function update(){

/*
		$Status=1;

		$rutas = new RutasModel($_POST['IdRuta'],$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],$_POST['EmpleadoCaptura'],null,null,null,$Status);
		RutasModel::update($rutas);

*/
			$rutas = new RutasModel($_POST['IdRuta'],$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],null,null,null,null,null,null);
			RutasModel::update($rutas);
	}
	
	function delete(){

		//RutasModel::delete($_GET['id']);
		$Status=1;
	   RutasModel::delete($_GET['id'], $_SESSION["id_employe"], $Status);


	}

} ?>