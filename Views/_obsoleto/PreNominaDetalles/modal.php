<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}




	/*
		Como saber si el modal que se abre, es para agregar? el ID que manda es 0. Yo tomo el ID 0 porque en la BD no coincide con ningun registro
		Pero si ese ID es mayor que 0 signfica que la modal abierta es para ver, editar, o por eliminar. Entonces
	*/
	$modal_por_agregar = "false";
	if(isset($_GET["id"]) && $_GET["id"]=='0'){
		$modal_por_agregar = "true";
	}

	//Parametro de la URL "edit" para habilitar o deshabilitar los campos del formulario: "true,false"
	$disabled = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";
		} else if($editable=="false"){
			$disabled = "disabled";
		}
	}


?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="form-row">
	<table class="table table-bordered table-striped">
		<?php

	$extras = ExtrasSucursalModel::ExtrasNomb($_SESSION["id_sucursal"]);
	 foreach ($extras as $ex) {
		 ?>
		 <tr>
			 <td><?php echo $ex->nombreid($ex->getIdExtra()); ?>

			 </td>
			 <td>

				 <?php

				 	$PrenDet = PreNominaDetallesModel::premdet($ex->getIdExtra(),$_GET["id"]);

				  ?>

				 <td>
				 <label for="">Monto</label>
				 <input type="number" name=<?php echo "monto".$ex->getIdExtra(); ?> value="<?php echo $PrenDet->getmonto(); ?>">
			 		</td>

				 <td>
				 <label for="">Cantidad</label>
				 <input type="number" name="<?php echo "Cantidad".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getCantidad(); ?>">
				 </td>
				 <td>
				 <label for="">Comentario</label>
				 <input type="text" name=<?php echo "Comentario".$ex->getIdExtra(); ?> value="<?php echo  " ".$PrenDet->getComentarios(); ?>">
				 </td>
				 <!-- -------------------------------------------------->
				 <td style="display: none">
					 <input type="text" name="<?php echo "idEmpleado".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getidDetallePrenominaExtra();  ?>"> <!--Empleado-->
					 <input type="text" name="<?php echo "IdPrenomidaDetalle".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getidDetallePrenominaExtra(); ?>">
					 <input type="text" name="<?php echo "idPrenominaExtra".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getidPrenominaExtra(); ?>">
					 <input type="text" name="<?php echo "idExtraSucursal".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getidExtraSucursal();?>">

				 </td>

			 </td>
		 </tr>

	<?php
	 }
	?>
	</table>
</div>
