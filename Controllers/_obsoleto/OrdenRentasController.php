<?php 
class OrdenRentasController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaRentas=OrdenRentasModel::all();
		require_once('Views/rentas/index.php');
	}

	function register(){
		require_once('Views/rentas/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$rentas= new OrdenRentasModel(null, $_POST['IdOredenRenta'],$_POST['FolioCotizacion'],$_POST['IdEmpleado'],$_POST['IdSucursal'],
			$_POST['IdStatus'], $_POST['FechaCaptura'], $_POST['HoraCaptura'], $_POST['IdCliente'], $_POST['SStatus'],
			$_POST['FechaInicio'], $_POST['FechaTermino'],$_POST['FolioRenta'],$_POST['CalleEntrega'],$_POST['ColoniEntrega'],$_POST['CodigoPostalEntrega'],
			$_POST['IdCiudad'],$_POST['NombrePersonaEntrega'],$_POST['TelefonoPersonaEntrga'],$_POST['CorreoPersonaEntrega'],$_POST['RequiereFactura'],
			$_POST['Facturado'],$_POST['Recuperado']);

		OrdenRentasModel::save($rentas);
		$this->show();
	}

	function show(){
		$listaRentas=OrdenRentasModel::all();

		require_once('Views/rentas/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$renta=OrdenRentasModel::searchById($id);
		//require_once('Views/rentas/updateshow.php');
		require_once('Views/rentas/modal/ver.php');
	}

	function update(){
		$rentas = new OrdenRentasModel($_POST['IdOredenRenta'],$_POST['FolioCotizacion'],$_POST['IdEmpleado'],$_POST['IdSucursal'],
			$_POST['IdStatus'], $_POST['FechaCaptura'], $_POST['HoraCaptura'], $_POST['IdCliente'], $_POST['SStatus'],
			$_POST['FechaInicio'], $_POST['FechaTermino'],$_POST['FolioRenta'],$_POST['CalleEntrega'],$_POST['ColoniEntrega'],$_POST['CodigoPostalEntrega'],
			$_POST['IdCiudad'],$_POST['NombrePersonaEntrega'],$_POST['TelefonoPersonaEntrga'],$_POST['CorreoPersonaEntrega'],$_POST['RequiereFactura'],
			$_POST['Facturado'],$_POST['Recuperado']);
		OrdenRentasModel::update($rentas);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdOredenRenta'];
		OrdenRentasModel::delete($IdOredenRenta);
		$this->show();
	}

	/*function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$rentas=OrdenRentasModel::searchById($id);
			$listaRentas[]=$rentas;
			//var_dump($id);
			//die();
			require_once('Views/Alumno/show.php');
		} else {
			$listaRentas=OrdenRentasModel::all();

			require_once('Views/rentas/show.php');
		}
		
		
	}*/

	function error(){
		require_once('Views/rentas/error.php');
	}

}

?>