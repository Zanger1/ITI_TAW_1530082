<!-- modal agregar --------------------------------------------------------------------------------------------------------------------------------->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" id="modal-form-add" action="./?view=ExtrasSucursal&action=save" autocomplete="off">
				<div class="modal-header">
					<h5 class="modal-title"><span style="color: green;">Extras</span> > <span style="color: #007bff;">Agregar</span></h5>
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
<!--------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- modal ver -->
<div id="modal-view" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span style="color: green;">Extras</span> > <span style="color: #007bff;">Ver</span></h5>
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
<!--------------------------------------------------------------------------------------------------------------------------------------------------- -->

<!-- modal edit -->
<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <form method="post" id="modal-form-edit" action="?view=ExtrasSucursal&action=update" autocomplete="off">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">Extras</span> > <span style="color: #007bff;">Editar</span></h5>
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
<!----------------------------------------------------------------------------------- -->
<!-- modal eliminar -->

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <form method="post" id="modal-form-delete" action="?view=ExtrasSucursal&action=delete" autocomplete="off">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">Extras</span> > <span style="color: #007bff;">Eliminar</span></h5>
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
	  <!--</form> -->
    </div>
  </div>
</div>
<!----------------------------------------------------------------------------------------------------------------- -->
		<div class="card">
            <!-- /.card-header -->
			<div class="card-header">

  				<small class="float-left"><h3 class="card-title">Extras</h3></small>

				<!-- <small class="float-left">
					<h3 class="custom-font" style="font-family: 'Y2K Neophyte'; font-weight: normal; font-style: normal;">
						Extras
					</h3>-->
					<!-- <button type="button" name="save" id="" class="btn btn-primary btn-sm button-open-modal-add" data-toggle="modal" data-placement="top"  title="Agregar">+ Agregar</button> -->

				<!--</small> -->

            </div>

            <div class="card-body">



				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">						<!-- modal ver -->

					  <div class="box box-primary">

						<div class="box-body no-padding">

							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped">
									<thead>
									<tr>
											<th>Num.</th>
											<th>Extra</th>
											<th>Sucursal</th>
											<th>Monto sugerido</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>


									</tbody>
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
				<!-- /.content -->

			</div>
		</div>
