<?php

$Pren = new PreNominaExtraModel($_POST['idPrenomina'], $_POST['idSucursal'], $_POST['NoSemana'], $_POST['FechaInicio'], $_POST['FechaTermino'],$_POST['Comentario'],2,$_POST['idEmpleado'],$_POST['FechaCaptura']);
 PreNominaExtraModel::delete($Pren);


 ?>
