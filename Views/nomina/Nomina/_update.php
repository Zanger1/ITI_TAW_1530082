<?php
	$Nomina = new NominaModel($_POST['idDetalleNominaSucursal'],$_POST['idNominaSucursal'],$_POST['idEmpleado'],$_POST['idCategoriaEmpleado'],$_POST['NoDiasTrabajados'],$_POST['Septimo_Dia'],$_POST['SueldoBase'],$_POST['Sueldo'],$_POST['TotalExtras'],$_POST['Infonavit'],$_POST['Prestamo'],$_POST['SaldoAnterior'],$_POST['Abono'],$_POST['SueldoActual'],$_POST['SueldoNeto'],$_POST['ComentariosSucursal'],$_POST['ComentariosMatriz']);
	NominaModel::update($Nomina);
?>