<?php 
class OrdenServiciosController
{
	
	function __construct()
	{
		
	}

	function index(){
		$listaServicios=OrdenServiciosModel::all();
		require_once('Views/empleados/index.php');
	}

	function register(){
		require_once('Views/empleados/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$servicios= new OrdenServiciosModel(null, $_POST['IdOrdenServicio'],$_POST['FolioCotizacion'],$_POST['FolioServicio'],$_POST['IdEmpleado'],
			$_POST['FechaCaptura'], $_POST['HoraCaptura'], $_POST['IdCliente'], $_POST['FechaComienzoServicio'], $_POST['FechaTerminoServicio'],
			$_POST['SStatus'], $_POST['CalleEntrega'],$_POST['CodigoPostalEntrega'],$_POST['IdCiudad'],$_POST['NombrePersonaEntrega'],
			$_POST['TelefonoPersonEntrega'],$_POST['CorreoPersonaEntrega'],$_POST['RequiereFactura'] ,$_POST['Factura'],$_POST['IdStatus']);

		OrdenServiciosModel::save($servicios);
		$this->show();
	}

	function show(){
		$listaServicios=OrdenServiciosModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['id'];
		$servicio=OrdenServiciosModel::searchById($id);
		//require_once('Views/servicios/updateshow.php');
		require_once('Views/empleados /modal/ver.php');
	}

	function update(){
		$servicios = new OrdenServiciosModel( $_POST['IdOrdenServicio'],$_POST['FolioCotizacion'],$_POST['FolioServicio'],$_POST['IdEmpleado'],
			$_POST['FechaCaptura'], $_POST['HoraCaptura'], $_POST['IdCliente'], $_POST['FechaComienzoServicio'], $_POST['FechaTerminoServicio'],
			$_POST['SStatus'], $_POST['CalleEntrega'],$_POST['CodigoPostalEntrega'],$_POST['IdCiudad'],$_POST['NombrePersonaEntrega'],
			$_POST['TelefonoPersonEntrega'],$_POST['CorreoPersonaEntrega'],$_POST['RequiereFactura'] ,$_POST['Factura'],$_POST['IdStatus']);
		OrdenServiciosModel::update($servicios);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdOrdenServicio'];
		OrdenServiciosModel::delete($IdOrdenServicio);
		$this->show();
	}

	/*function search(){
		if (!empty($_POST['id'])) {
			$id=$_POST['id'];
			$servicios=OrdenServiciosModel::searchById($id);
			$listaServicios[]=$servicios;
			//var_dump($id);
			//die();
			require_once('Views/Alumno/show.php');
		} else {
			$listaServicios=OrdenServiciosModel::all();

			require_once('Views/servicios/show.php');
		}
		
		
	}*/

	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>