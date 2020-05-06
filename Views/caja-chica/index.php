<!-- modal agregar -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" id="modal-form-add" action="?view=CajaChica&action=save" autocomplete="off">
				<div class="modal-header">
					<h5 class="modal-title"><span style="color: green;">Caja chica</span> > <span style="color: #007bff;">Agregar </span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div id="ajax-content-add"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Continuar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal ver -->
<div id="modal-view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span style="color: green;">Caja chica</span> > <span style="color: #007bff;">Ver</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<div id="ajax-content-view"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
      </div>	  
    </div>
  </div>
</div>

<!-- modal edit -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <form method="post" id="modal-form-edit" action="?view=CajaChica&action=update" autocomplete="off">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">Caja chica</span> > <span style="color: #007bff;">Editar</span></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
				<div id="ajax-content-edit"></div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Continuar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		  </div>
	  </form>
    </div>
  </div>
</div>

<!-- modal eliminar -->
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <div id="modal-form-delete">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">Caja chica</span> > <span style="color: #007bff;">Eliminar</span></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<div id="ajax-content-delete"></div>
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary" id="button-delete">Continuar</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		  </div>
	  </div>
    </div>
  </div>
</div>


		<div class="card">
            <!-- /.card-header -->
            <div class="card-header">
			  <small class="float-right"><button class="btn btn-primary button-open-modal-add" data-toggle="modal" >+ Agregar</button></small>
			  <!-- class="custom-font" style="font-family: 'Y2K Neophyte'; font-weight: normal; font-style: normal;" -->
			  <small class="float-left"><h3 class="card-title">Caja chica</h3></small>
            </div>
            <div class="card-body">
		
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">					
					  <div class="box box-primary">
						<div class="box-body no-padding">
							<div class="table-responsive">

<style>
a.buttons-collection {
        margin-left: 1em;
		z-index: 11;
		position: relative;
    }
</style>
					  <small class="float-right" style="margin-left: 10px; margin-right:10px;" >
				  <div class="form-row pull-right">
					<div class="form-group col-md-4">
					  <label style="font-weight: normal; font-size: 16px">Sucursal:</label>
					  <select id="IdSucursal" name="IdSucursal" class="form-control" <?php echo UsuariosModel::permission_combobox(); ?>>
						<option value="">Todas</option><!-- selected -->
						<?php SucursalesModel::combobox_lista(); ?>
					  </select>
					</div>
					<div class="form-group col-md-3">
					  <label style="font-weight: normal; font-size: 16px">Fecha inicial:</label>
					  <!-- <input type="text" name="fecha_inicial" id="start_date" class="form-control input-type-datepicker" id="min" autocomplete="off"> -->
					  <input type="date" name="fecha_inicial" id="start_date" class="form-control" value="<?php echo date("Y-m-d");?>">

					</div>
					<div class="form-group col-md-3">
					  <label style="font-weight: normal; font-size: 16px;">Fecha final:</label>
					  <!--<input type="text" name="fecha_final" id="end_date" class="form-control input-type-datepicker" id="max" autocomplete="off"> -->
					  <input type="date" name="fecha_final" id="end_date" class="form-control" value="<?php echo date("Y-m-d");?>">

					</div>
				  </div>
				  </small> <br> 
							

								<table id="table-data" class="table table-bordered table-striped filtros-caja-chica">
									<thead>
										<tr>
											<th>Folio</th>
											<th>Tipo</th>
											<th>Detalles</th>
											<th>Monto</th>
											<th>Empleado</th>
											<!--<th>Fecha y Hora</th>-->
											<th>Fecha</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
<!--										<tr>
											<td><span class="badge badge-primary">Salida</span></td>
											<td><span data-toggle="tooltip" data-placement="top" title="Se poncho una llanta del camion">Se poncho una llanta...<span></td>
											<td>$300</a> </td>
											<td>Manuel Ruiz</a> </td>
											<!--<td>2019-01-01 12:00:00</td>-->
<!--											<td>05/29/2019</td>	<!-- Formato: Mes / Dia / Anio -->
<!--											<td>
												<!-- <span data-toggle="tooltip" data-placement="top" title="Ver"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-ver-movimiento"><i class="fa fa-eye"></i></button></span> -->
<!--												<span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target=".modal-editar-movimiento "><i class="fa fa-edit"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-eliminar-movimiento "><i class="fa fa-trash"></i></button></span>
											</td>
										</tr>-->
									</tbody>
								</table>
							</div>
							
							<div class="float-right" style="margin-top:-90px; margin-left:10px;"><b>Total: </b>$<span id="total-en-caja"></span></div>
						
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
