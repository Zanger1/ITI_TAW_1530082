<?php 
class MDetalleORentaController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaMDetalleO=MDetalleORentaModel::all();
		require_once('Views/MDetalleO/index.php');
	}

	function register(){
		require_once('Views/MDetalleO/register.php');
	}

	function save(){
		
		$MDetalleO= new MDetalleORentaModel(null,$_POST['IdMaterialesDetalleOrdenRentas'],$_POST['IdDetalleOrdenRentas'],$_POST['IdMaterialesRentas'],$_POST['Cantidad'],$_POST['Precio']);
		MDetalleORentaModel::save($MDetalleO);
		$this->show();
	}

	function show(){
		$listaMDetalleO=MDetalleORentaModel::all();

		require_once('Views/MDetalleO/index.php');
	}

	function updateshow(){
		$id=$_GET['IdMaterialesDetalleOrdenRentas'];
		$MDetalleO=MDetalleORentaModel::searchById($id);
		require_once('Views/MDetalleO/updateshow.php');
	}

	function update(){
		$MDetalleO = new MDetalleORentaModel($_POST['IdMaterialesDetalleOrdenRentas'],$_POST['IdDetalleOrdenRentas'],$_POST['IdMaterialesRentas'],$_POST['Cantidad'],$_POST['Precio']);
		MDetalleORentaModel::update($MDetalleO);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdMaterialesDetalleOrdenRentas'];
		MDetalleORentaModel::delete($IdMaterialesDetalleOrdenRentas);
		$this->show();
	}

	function error(){
		require_once('Views/MDetalleO/error.php');
	}

}

?>