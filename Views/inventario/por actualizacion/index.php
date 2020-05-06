<!-- modal ubicaciones -->
<div id="modal-track" class="modal fade modal-mostrar-ubicacions" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span style="color: green;">Inventario</span> > <span style="color: #007bff;">Ubicaciones</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div id="ajax-content-track"></div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
      </div>
	  </div>
    </div>
  </div><!-- modal agregar --><div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">	<div class="modal-dialog modal-lg">		<div class="modal-content">			<form enctype="multipart/form-data" method="post" id="modal-form-add" action="?view=Inventario&action=save" autocomplete="off">				<div class="modal-header">					<h5 class="modal-title"><span style="color: green;">Inventario</span> > <span style="color: #007bff;">Agregar </span></h5>					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>				</div>				<div class="modal-body">					<div id="ajax-content-add"></div>				</div>				<div class="modal-footer">					<button type="submit" class="btn btn-primary">Continuar</button>					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>				</div>			</form>		</div>	</div></div><!-- modal ver --><div id="modal-view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg">    <div class="modal-content">      <div class="modal-header">        <h5 class="modal-title"><span style="color: green;">Inventario</span> > <span style="color: #007bff;">Ver</span></h5>        <button type="button" class="close" data-dismiss="modal" aria-label="Close">          <span aria-hidden="true">&times;</span>        </button>      </div>      <div class="modal-body">			<div id="ajax-content-view"></div>      </div>      <div class="modal-footer">        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>      </div>	      </div>  </div></div><!-- modal edit --><div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg">    <div class="modal-content">	  <form enctype="multipart/form-data" method="post" id="modal-form-edit" action="?view=Inventario&action=update" autocomplete="off">		  <div class="modal-header">			<h5 class="modal-title"><span style="color: green;">Inventario</span> > <span style="color: #007bff;">Editar</span></h5>			<button type="button" class="close" data-dismiss="modal" aria-label="Close">			  <span aria-hidden="true">&times;</span>			</button>		  </div>		  <div class="modal-body">				<div id="ajax-content-edit"></div>		  </div>		  <div class="modal-footer">			<button type="submit" class="btn btn-primary">Continuar</button>			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>		  </div>	  </form>    </div>  </div></div><!-- modal eliminar --><div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">  <div class="modal-dialog modal-lg">    <div class="modal-content">	  <div id="modal-form-delete">		  <div class="modal-header">			<h5 class="modal-title"><span style="color: green;">Inventario</span> > <span style="color: #007bff;">Eliminar</span></h5>			<button type="button" class="close" data-dismiss="modal" aria-label="Close">			  <span aria-hidden="true">&times;</span>			</button>		  </div>		  <div class="modal-body">			<div id="ajax-content-delete"></div>		  </div>		  <div class="modal-footer">			<button type="submit" class="btn btn-primary" id="button-delete">Continuar</button>			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>		  </div>	  </div>    </div>  </div></div>

<div class="card">
            <!-- /.card-header -->
            <div class="card-header">
			  <small class="float-right"><button class="btn btn-primary button-open-modal-add" data-toggle="modal" >+ Agregar</button></small>
			  <small class="float-left"> <h3 class="card-title">Inventario</h3></small>
            </div>
            <div class="card-body">
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">
					  <div class="box box-primary">
						<div class="box-body no-padding">
							<div class="table-responsive">
								<small class="float-right" style="margin-left: 10px; margin-right:10px;" >
								<div class="row" class="col-sm-6">
								  <div class="col-sm-12"> 
									<div class="form-group">
									  <label for="inputState" style="font-weight: normal; font-size: 16px">Sucursal:</label>
									  <select id="IdSucursal" name="IdSucursal" class="form-control" <?php echo UsuariosModel::permission_combobox(); ?>>
										<option value="">Todas</option><!-- selected -->
										<?php SucursalesModel::combobox_lista(); ?>
									  </select>
									</div>
								  </div>
								</div>								</small><br>
								<table id="table-data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nombre Unidad</th>
											<th>Sucursal</th>
											<th>Disponible</th>
											<th>En renta</th>
											<th>Total</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
<!--										<tr>
											<td>WC</td>
											<td>Sencillo</td>
											<td>12</td>
											<td><span data-toggle="tooltip" data-placement="top" title="Mostrar ubicacions"><a href="#" style="font-weight:bold;text-decoration:underline;" data-toggle="modal" data-target=".modal-mostrar-ubicacions" >13</a></span></td>
											<td>25</td>
											<td>
												<span data-toggle="tooltip" data-placement="top" title="Ver"><button type="button"  class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-ver-unidad "><i class="fa fa-eye"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target=".modal-editar-unidad "><i class="fa fa-edit"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-eliminar-unidad "><i class="fa fa-trash"></i></button></span>
											</td>
										</tr> -->
									</tbody>
									<!--<tfoot>
										<tr>
											<th>Total:</th>
											<th></th>
											<th>12</th>
											<th>13</th>
											<th>25</th>
											<th></th>
										</tr>
									</tfoot>-->
								</table>
							</div>
						</div>
						<!-- /.box-body -->
					  </div>
					  <!-- /. box -->
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</section>
			</div>
		</div>