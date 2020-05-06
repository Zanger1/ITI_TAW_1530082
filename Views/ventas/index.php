<?php
$for='';	
$archivo='';
  if (isset ($_GET['for']) && isset ($_GET['is_archived']))
  {
	  $for = $_GET['for']; 
	  $archivo = $_GET['is_archived'];
	  
   
/*
     if (isset ($_SESSION["idclaveUnica"]))
     {
     	echo "idclaveUnica: ".$_SESSION["idclaveUnica"];	
     }
	  */
	  //echo $for.' - '. $archivo;
  }

if (isset ($_GET['id']))
{
	echo "idclaveUnica: ".$_GET['id'];
}




?>


<!-- modal ver -->
<div id="modal-view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	
	<div class="modal-dialog modal-lg">
		<!--- Modificado por paulina para modo de prueba la centralizacion del modal ver -->
		<!--div class="modal-dialog modal-dialog-cenered"-->
			<div class="modal-content">
			<div class="modal-header">
  				<?php 
  				if($archivo == 'false')
  				{?>
					<!--<h5 class="modal-title"><span style="color: green;">Cotizaciones</span> > <span style="color: #007bff;">Ver</span></h5>-->
					<h5 class="modal-title">
						<span style="color: green;">Cotizaci&oacute;n de <?php echo $for?></span> > 
						<span style="color: #007bff;">Ver</span>
					</h5>
				<?php 
				} 
				else if($archivo == 'true')
				{ ?>
					<h5 class="modal-title">
						<!--<span style="color: green;">Ordenes</span> > -->
						<span style="color: green;">Orden de <?php echo $for?></span> > 
						<span style="color: #007bff;">Ver</span>
					</h5>
				<?php 
				} ?>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="ajax-content-view"></div>				
				<?php if($archivo=='false')
				{ /* Solo para cotizaciones, las ordenes ya no se envian, por el momentoo */
		  
				} ?>
				
			</div>
			<div class="modal-footer">
			<?php if($archivo=='false'){ /* Solo para cotizaciones, las ordenes ya no se envian, por el momentoo */ ?>
				
				<div id="ajax-content-button-send-mail"></div>
			<?php } ?>
				<!-- <a href="#" id="link_document" target="_blank"><button type="button" class="btn btn-danger">Abrir en otra pesta&ntilde;a</button></a> -->
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
			</div>
			<!--/div-->
		</div>
  	</div>
	
</div>

<!-- modal eliminar -->
<div >
	<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
    <div class="modal-dialog modal-lg">  
		<div class="modal-content">			
				<div class="modal-header">
					<h5 class="modal-title">
						<!--<span style="color: green;">Cotizaciones</span> > -->
						<span style="color: green;">Cotizaci&oacute;n de <?php echo $for?></span> >
						<span style="color: #007bff;">Eliminar</span>
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- El mensaje de eliminacion -->
				<!--div class="modal-body">Al cancelar la cotizaci&oacute;n la cantidad total cotizada que aparece en este PDF ser&aacute; devuelta al inventario. Si decide conservar esta cotizaci&oacute;n cantidad seguir&aacute; estando apartada para la renta.
						<div id="ajax-content-delete"></div>
				</div-->
			
				<div class="modal-body">¿Est&aacute; seguro que se desea eliminar la cotizaci&oacute;n seleccionada? 
							<div id="ajax-content-delete"></div>
					</div>
				<div class="modal-footer">
		
				<button type="submit" class="btn btn-primary" id="button-delete">Continuar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
			
		</div>
		</div>
	
  </div>
  </div>
</div>
</div>


		<!-- modal status de orden (envios) --> <!-- COTIZACION   -->
<div id="modal-status-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<form method="post" id="modal-form-convert" action="./?view=Ventas&action=<?php if($archivo=='false'){ echo 'generate_order'; } else if($archivo=='true'){ echo 'update_order';  }  ?>">
				<div class="modal-header">
					<?php 
					if($archivo=='false')
					{ ?>
						<h5 class="modal-title">
							<!--<span style="color: green;">Cotizaciones</span> > -->
							<span style="color: green;">Cotizaci&oacute;n de <?php echo $for?></span> >
							<span style="color: #007bff;">
					<?php 
				    } 
				    else if($archivo=='true')
				    { ?>
						<h5 class="modal-title">
							<!--<span style="color: green;">Ordenes</span> > -->
							<span style="color: green;">Orden de <?php echo $for?></span> > 
							<span style="color: #007bff;">
						<?php
					 } 
					if($archivo=='true')
					{ 
							echo 'Editar orden';							
					}
					else if($archivo=='false')
					{ 
						echo 'Generar orden'; 
					} 
					?>
					</span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="ajax-content-status-order"></div>
				</div>
				<div class="modal-footer">				
					<button type="submit" class="btn btn-primary">Continuar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
				</div>
			</form>
			</div>
	</div>
</div>



<!--- INICIO DEL MODAL AGREGAR EN COTIZACIONES-->
<div class="card">
            <!-- /.card-header -->
            <!-- &IdSuc=<script>$('#IdSucursal option:selected').val();</script>-->
   
   
		<div class="card-header">
			  <?php if($archivo=='false'){ ?>
			  	<small class="float-right">
			  		<a href="./?view=Ventas&action=new_quotation&for=<?php echo $for;?>"> 
			  		<button class="btn btn-primary">+ Agregar</button>
			  	</a>
				</small>
				<?php } ?>
			  	<small class="float-left">
			  		<h3 class="card-title">
			  		<?php 
			  			if($archivo=='true')
			  			{ 
			  				//Imprime
			  				//Ordenes de rentas u Ordenes de  servicios
			  				echo 'Ordenes de '.$for.' '; 
			  			} 
			  			else if($archivo=='false')
			  			{
			  				//Imprime
			  				//Cotizaciones de rentas u Cotizaciones de  servicios
			  			 	echo 'Cotizaciones de '.$for; 
			  			} ?>			  					
			  		</h3>
				</small>
	</div>

<!-- CIERRE DEL MODAL AGREGAR EN COTIZACIONES-->

	<div class="card-body">
<!-- Main content -->
		<section class="content">
			<div class="row">
			<div class="col-md-12">
			<div class="box box-primary">
			<div class="box-body no-padding">
			<div class="table-responsive">

<!-- INICIO DEL MODAL de las herraminetas de busqueda -->
				<small class="float-right" style="margin-top: 45px; margin-left: 10px; margin-right:10px;" >
					<div class="form-row pull-right">
						<div class="form-group <?php if ($archivo == 'true'){ echo 'col-md-4'; } else { echo 'col-md-12'; }?>">
							<label style="font-weight: normal; font-size: 16px">Sucursal:</label>
							<select id="IdSucursal" name="IdSucursal" class="form-control" <?php echo UsuariosModel::permission_combobox(); ?>>
								<option value="">Todas</option><!-- selected -->
								<?php SucursalesModel::combobox_lista(); ?>
							</select>
						</div>
						<?php if ($archivo == 'true'){ ?>
						<div class="form-group col-md-3">
							<label style="font-weight: normal; font-size: 16px">Ubicaci&oacute;n:</label>
							<select id="id_situacion_ubicacion" name="id_situacion_ubicacion" class="form-control">
								<option value="">Seleccionar</option>
								<?php
								$selected_ubicacion = $invoice_array[15];
								$ubicaciones = VentasModel::__situacion($_GET["for"], 'ubicacion');
								foreach($ubicaciones as $u){
									echo '<option value="'.$u[0].'" >'.$u[1].'</option>';
								} ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label style="font-weight: normal; font-size: 16px;">Pagos:</label>
							<select id="id_situacion_monetaria" name="id_situacion_monetaria" class="form-control">
								<option value="">Seleccionar</option>
								<?php
								$selected_pagos = $invoice_array[16];
								$pagos = VentasModel::__situacion($_GET["for"], 'monetaria');
								foreach($pagos as $p){
									echo '<option value="'.$p[0].'" >'.$p[1].'</option>'."\n";
								} ?>
							</select>
						</div>
						<?php } ?>
					</div>
				</small><br><br><br>
			<!-- CIERRE DEL MODAL DE BUSQUEDA  -->

				<!-- /.content -->
					<table id="table-data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Folio</th>
											<th>Nombre del cliente</th>
											<th>Total</th>
											<th>Fecha inicial</th>
											<th>Fecha final</th>
 											<?php 
 											if($archivo=='true')
 											{?>
												<th>Situaci&oacute;n</th>
											<?php 
										    } 
											else 
											{ ?>
												<th>&nbsp</th>
										    <?php 
										   } ?>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody <?php //if($invoice_array[18] == 1){ } //para cambiar el color de la columna de tabla para verificar que ordenes ya se finalizaron?>>
										<!--<tr>
											<td>V001</td>
											<td>Manuel Ruiz</td>
											<td>$3,500</td>
											<td>2019-01-01 12:00:00</td>
											<td>2019-02-01 12:00:00</td>
											<td>Por recoger</td>
											<td>
												<span data-toggle="tooltip" data-placement="top" title="Ver"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-vista-previa-cotizacion"><i class="fa fa-eye"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Editar"><a href="?view=Usuarios&action=updateshow&id=1" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a></span>
												<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a href="?view=Usuarios&action=delete&id=1" class="btn btn-danger btn-sm" onClick="return confirm('Seguro que deseas eliminar?')"><i class="fa fa-trash"></i></a></span>
												<span data-toggle="tooltip" data-placement="top" title="Situaci&oacute;n"><a href="?view=cotizaciones&action=estado-orden" class="btn btn-warning btn-sm"><i class="fa fa-cog"></i></a></span>
											</td>
										</tr> -->
									</tbody>
								</table>
			</div>



 




				<div class="float-left"><b>Total: </b>$<span id="sumatorias-subtotal"></span></div>
			
			</div>
						<!-- /.box-body -->
			</div>
					  <!-- /. box -->
			</div>
					<!-- /.col -->
			</div>
				  <!-- /.row -->
		</section>
				<!-- /.content -->
	</div>
</div>
