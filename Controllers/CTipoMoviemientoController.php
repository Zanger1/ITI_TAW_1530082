<?php 
class 	CTipoMoviemientoController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaMovimiento=CTipoMoviemientoController::all();
		require_once('Views/caja-chica/index.php');
	}

	function register(){
		require_once('Views/caja-chica/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$movimiento= new CTipoMoviemientoController(null, $_POST['IdTipoMovimiento'],$_POST['DesTipoMovimiento']);

		CTipoMoviemientoController::save($movimiento);
		$this->show();
	}

	function show(){
		$listaMovimiento=CTipoMoviemientoController::all();

		require_once('Views/caja-chica/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$rol=CTipoMoviemientoController::searchById($id);
		//require_once('Views/caja-chica/updateshow.php');
		require_once('Views/caja-chica/modal/ver.php');
	}

	function update(){
		$movimiento = new CTipoMoviemientoController($_POST['IdTipoMovimiento'],$_POST['DesTipoMovimiento']);
		CTipoMoviemientoController::update($movimiento);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdTipoMovimiento'];
		CTipoMoviemientoController::delete($IdTipoMovimiento);
		$this->show();
	}


	function error(){
		require_once('Views/caja-chica/error.php');
	}

}

?>