<?php 

class HistorialController {

/*
	Parece que ni siquiera existe el modelo de Historial, asi que este controlador es prospecto a quedar obsoleto
*/

	function index(){
		$listaHistorial=HistorialModel::all();
		require_once('Views/nomina/Historial/index.php');

	}

	function all_json(){
		$listaHistorial=HistorialModel::all_json();
		echo $listaHistorial;
	}

} ?>