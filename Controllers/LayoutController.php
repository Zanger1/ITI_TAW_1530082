<?php
class LayoutController {

	function estados(){
		$listaEstados=EstadosModel::all();
		include_once("Views/Layouts/estado-ciudad/estado.php");
	}

	function ciudades(){
		if(isset($_GET["id"])){
			$id=$_GET['id'];
			$listaCiudades=CiudadesModel::searchByIdEstado($id);
			include_once("Views/Layouts/estado-ciudad/ciudad.php");
		} else {
		}
	}

	//Errores, etc
}
?>