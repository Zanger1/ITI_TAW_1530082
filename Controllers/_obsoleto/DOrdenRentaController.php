<?php 
class DOrdenRentaController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaOrdenRenta=DOrdenRentaModel::all();
		require_once('Views/detalle_orden_rentas/index.php');
	}

	function register(){
		require_once('Views/detalle_orden_rentas/register.php');
	}

	function save(){
		$OrdenRenta= new DOrdenRentaModel(null, $_POST['IdDetalleOrdenRentas'],$_POST['IdOrdenRenta'],$_POST['FolioCotizacion'],
			$_POST['FolioRenta'], $_POST['IdInventarioUnidadesRenta'], $_POST['Incluye'], $_POST['Precio'], $_POST['Cantidad']);

		DOrdenRentaModel::save($OrdenRenta);
		$this->show();
	}

	function show(){
		$listaOrdenRenta=DOrdenRentaModel::all();

		require_once('Views/detalle_orden_rentas/index.php');
	}

	function updateshow(){
		$id=$_GET['IdDetalleOrdenRentas'];
		$OrdenRenta=DOrdenRentaModel::searchById($id);
		require_once('Views/detalle_orden_rentas/updateshow.php');
	}

	function test_modal(){
		$id=$_GET['id'];
		$OrdenRenta=DOrdenRentaModel::searchById($id);
		require_once('Views/detalle_orden_rentas/modal/ver.php');
	}

	function update(){
		$OrdenRenta = new DOrdenRentaModel($_POST['IdDetalleOrdenRentas'],$_POST['IdOrdenRenta'],$_POST['FolioCotizacion'],
			$_POST['FolioRenta'], $_POST['IdInventarioUnidadesRenta'], $_POST['Incluye'], $_POST['Precio'], $_POST['Cantidad']);
		DOrdenRentaModel::update($OrdenRenta);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdDetalleOrdenRentas'];
		DOrdenRentaModel::delete($IdDetalleOrdenRentas);
		$this->show();
	}
	function error(){
		require_once('Views/detalle_orden_rentas/error.php');
	}

}

?>