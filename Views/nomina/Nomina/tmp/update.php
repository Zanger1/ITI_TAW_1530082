<?php
	/*$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],$_POST['idNominaSucursal'],$_POST['idEmpleado'],$_POST['idCategoriaEmpleado'],$_POST['NoDiasTrabajados'],$_POST['SeptimoDia'],$_POST['SueldoBase'],$_POST['Sueldo'],$_POST['TotalExtras'],$_POST['Infonavit'],$_POST['Prestamo'],$_POST['SaldoAnterior'],$_POST['Abono'],$_POST['SueldoActual'],$_POST['SueldoNeto'],$_POST['Comentarios']);*/
	$comentarios="a";
	if ($_POST['rol']==1) {
		$comentarios = $_POST['Comentarios'];
	}else{
		$comentarios = $_POST['ComentariosSucursal'];
	}

	$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],null,null,null,$_POST['NoDiasTrabajados'],null,null,null,null,null,null,null,$_POST['Abono'],null,null,$comentarios);
	NominaModel::update($Nomina);
?>