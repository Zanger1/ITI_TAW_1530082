<?php 

class PrenominaDetallesController{

	function index(){
		//carpetas de las Views
		include_once("Views/nomina/PrenominaDetalle/index.php");
		$_SESSION["IDPrenominaExtra"] = $_GET["IdPrenominaExtra"];
		
	}
	
	function updateshow(){
		include_once("Views/nomina/PrenominaDetalle/modal.php");
	}
	
	function all_json(){
		//echo $_GET["IdPrenominaExtra"];
		//$_SESSION["IDPrenominaExtra"] = $_GET["IdPrenominaExtra"];

		$listaPrenomina=PrenominaDetallesModel::all_json();
		echo $listaPrenomina;
	}
	
	function save(){
		//no se usa save por que ya se insertaron en prenomina al crearla de la semana.
        

        /*
		$MontoRestante = $_POST['MontoPrestamo'];
		$liquido=1;
		$Status=0;
		$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,$liquido, $_POST['Comentarios'],$Status);
		PrestamosModel::save($empleadoPrestamo);
		*/
		/*
 		$Pren = new PrenominaModel($_POST['idPrenomina'], $_POST['idSucursal'], $_POST['NoSemana'], $_POST['FechaInicio'], $_POST['FechaTermino'],trim($_POST['ComentarioSucursal']),3,$_POST['idEmpleado'],$_POST['FechaCaptura']);
  		PrenominaModel::save($Pren);
  		$this->index();
  		*/
	}
	
	function update()
	{
		$extras = ExtrasSucursalModel::ExtrasNomb($_SESSION["id_sucursal"]);
 		foreach ($extras as $ex) 
 		{
  			$prendet = new PreNominaDetallesModel($_POST["IdPrenomidaDetalle".$ex->getIdExtra()],$_POST["idPrenominaExtra".$ex->getIdExtra()],$_POST["idEmpleado".$ex->getIdExtra()],$_POST["idExtraSucursal".$ex->getIdExtra()],$_POST["monto".$ex->getIdExtra()],$_POST["Cantidad".$ex->getIdExtra()],$_POST["Comentario".$ex->getIdExtra()],2," ",0);
  			PreNominaDetallesModel::update($prendet);
 		}
        $this->index();

        /*
		$Pren = new PrenominaModel($_POST['idPrenomina'], $_POST['idSucursal'], $_POST['NoSemana'], $_POST['FechaInicio'], $_POST['FechaTermino'],$_POST['ComentarioSucursal'], $_POST['Status'],$_POST['idEmpleado'],$_POST['FechaCaptura']);
 			PrenominaModel::update($Pren);
		$this->index();
		*/
		/*
		$MontoRestante = $_POST['MontoRestante'] - $_POST['AbonoSemana'];
		$liquido=1;
		$Status=0;
		if ($MontoRestante<=0) {
			$MontoRestante=0;
			$liquido=0;
		}
		$empleadoPrestamo = new PrestamosModel($_POST['IdEmpleadoPrestamo'],$_POST['NameEmpleado'],$_POST['MontoPrestamo'],$_POST['NoSemanas'],$_POST['AbonoSemana'], $MontoRestante,$_POST['FechaPrestamo'], $_POST['EmpleadoCaptura'],null,$liquido, $_POST['Comentarios'],$Status);
		PrestamosModel::update($empleadoPrestamo);
		*/

		/* ya estaba
		Puntos faltantes
		-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
		*/
	}
	
	function delete()
	{
		
		PrenominaDetalleModel::delete($_GET['id']);
		$this->index();
	}

} ?>