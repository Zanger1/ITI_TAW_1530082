<?php
$id = '';
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
}

	/*
		Como saber si el modal que se abre, es para agregar? el ID que manda es 0. Yo tomo el ID 0 porque en la BD no coincide con ningun registro
		Pero si ese ID es mayor que 0 signfica que la modal abierta es para ver, editar, o por eliminar. Entonces
	*/
	$modal_por_agregar = "false";
	if(isset($_GET["id"]) && $_GET["id"]=='0')
	{
		$modal_por_agregar = "true";
	}

	//Parametro de la URL "edit" para habilitar o deshabilitar los campos del formulario: "true,false"
	$disabled = "";
	if(isset($_GET["edit"]))
	{
		$editable = $_GET["edit"];
		if($editable=="true")
		{
			$disabled = "";
		} 
		else if($editable=="false")
		{
			$disabled = "disabled";
		}
	}
?>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->


<div class="form-row">


	<div class="row">
          <div class="col-sm-6">
        <table class="table table-condensed" style="pading:3px;">
          <thead class="thead-dark">
            <tr>
              <th>No Semana:&nbsp;<?php echo $_SESSION["NoSemana"];?> </th><th></th>
            </tr>
          </thead>
		<tbody>
			<tr>
            	<th>No. Empleado:</th>
            	<td><?php echo $_GET["id"];?></td>
          	</tr>
          	<tr>
            	<th>Nombre completo:</th>
            	<td><?php 
					echo $NombreCompleto = Empleadosmodel::getOnlyName($_GET["id"]);
					$empleado= Empleadosmodel::searchById($_GET["id"]);
                    echo $empleado->getNombreEmpleado() ."&nbsp;" .$empleado->getApellidoPat(). "&nbsp;" .$empleado->getApellidomat();

            	?></td>
          	</tr>
            <tr>
            	<th>Tipo de empleado:</th>
            	<td>
            		<?php echo $ategoriaEmpleado = CCategoriaEmpleadoModel::getOnlyName($empleado-> getIdCategoriaEmpleado()); ?>            		
            	</td>
          </tr>
		  <tr>
            <th>Salario:</th>
            <td>
            	$<?php echo $empleado->getSalarioDiario();?>            		
            </td>
          </tr>           
          </tbody>
        </table>

	<table class="table table-bordered table-striped">
		<?php
    //Se obtienen todos los extras de la sucursal 
	$extras = ExtrasSucursalModel::ExtrasNomb($_SESSION["id_sucursal"]);
	 foreach ($extras as $ex) 
	 { ?>
		 <tr>
			 <td><?php echo  $ex->getNomExtra()/*$ex->getIdExtra()*/ /*echo $ex->nombreid($ex->getIdExtra())*/; ?>
			 </td>
			 
			 <td>
				 <?php
				 	/*echo "no semana ";
                    echo $_SESSION["NoSemana"];
                    echo "<br>";
					echo "id_sucursal ";
                    echo $_SESSION["id_sucursal"];
                    echo "<br>";
                    
                   	echo "id_extra ";
				    echo  $ex->getIdExtra();
				     echo "<br>";
					echo "idExtraSucursal ";
					echo  $ex->getidExtraSucursal();

				    echo "<br>";
				    echo "id_empleado ";
				    echo  $_GET["id"];
                    */    
                    $PrenDet = PreNominaDetallesModel::premdet($ex->getidExtraSucursal(),$_GET["id"]);                                         
				 	//$PrenDet = PreNominaDetallesModel::premdet($ex->getIdExtra(),$_GET["id"]);
				 	//$PrenDet = PreNominaDetallesModel::premdet(2,1);
				  ?>
				<td>
					<label for="">Monto</label>
					<input type="number" class="form-control" name="<?php echo "monto".$ex->getIdExtra(); ?>" value=<?php echo $PrenDet->getmonto(); ?> min="0">
			 	</td>

				<td>
					<label for="">Cantidad</label>
					<input type="number" class="form-control" name="<?php echo "Cantidad".$ex->getIdExtra(); ?>" value="<?php echo $PrenDet->getCantidad(); ?>" min="0">
				</td>
				<td>
					<label for="">Comentario</label>
					<input type="text" class="form-control" name="<?php echo "Comentario".$ex->getIdExtra(); ?>" value="<?php echo  " ".$PrenDet->getComentarios(); ?>">
				</td>
				 <td>
				 <label for="">Comentario Matriz</label>
				 <input type="text" class="form-control" name="<?php echo "Comentario".$ex->getIdExtra(); ?>" value="<?php echo  " ".$PrenDet->getComentarioMatriz(); ?>"
				    <?php 
					 	if($_SESSION["id_role"] == 1 || $_SESSION["id_role"] == 5){
							 echo 'enabled';
						} else {
							echo 'disabled';
						}
					?> >
				 </td>
				<td>
				 	<label for="">Situación</label>
				 	<select id="inputState1" class="form-control" name="c_situacion_nominas" 
					 <?php 
					 	if($_SESSION["id_role"] == 1 || $_SESSION["id_role"] == 5){
							echo 'enabled';
						} else {
							echo 'disabled';
						}
					 ?> >
						<option value="">Seleccionar</option>
						<?php
							
							$ListaSituacion = c_situacion_nominasModel::all();
							$selected_3 = '';
							foreach($ListaSituacion as $s){
								//if($empleado->getIdSituacionEmpleado() == $s->getIdSituacionEmpleado()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
						?>
							<option value="<?php echo $s->getidSituacion_nomina(); ?>"<?php echo $selected_3; ?>><?php echo $s->getDesSituacionNomina(); ?></option>
					    <?php } ?>	
					</select>
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
