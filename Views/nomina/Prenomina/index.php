<!-- modal agregar ------------------------------------------------------------------------------------->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" id="modal-form-save" action="?view=Prenomina&action=save" autocomplete="off">
				<div class="modal-header">
					<h5 class="modal-title"><span style="color: green;">PreNomina</span> > <span style="color: #007bff;">Agregar</span></h5>
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
        <h5 class="modal-title"><span style="color: green;">N&oacute;mina</span> > <span style="color: #007bff;">Ver</span></h5>
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
	  <form method="post" id="modal-form-edit----" action="?view=Prenomina&action=update" autocomplete="off">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">N&oacute;mina</span> > <span style="color: #007bff;">Editar</span></h5>
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
			<h5 class="modal-title"><span style="color: green;">Prenomina</span> > <span style="color: #007bff;">Eliminar</span></h5>
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
			<!--
            <div class="card-header">
				<small class="float-left">
					<h3 class="custom-font" style="font-family: 'Y2K Neophyte'; font-weight: normal; font-style: normal;">
						Pren&oacute;mina
					</h3>
					<button type="button" name="save" id="" class="btn btn-primary btn-sm button-open-modal-add" data-toggle="modal" data-placement="top"  title="Agregar">Agregar</button>
				</small>
            </div>
			-->

			<div class="card-header">
			  <small class="float-right"><button class="btn btn-primary button-open-modal-add" data-toggle="modal" >+ Agregar</button></small> 
			  <!-- data-target=".modal-agregar-empleados" -->
			  <small class="float-left"><h3 class="card-title">Pren&oacute;mina</h3></small>
            </div>
			
            <div class="card-body">
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">	<!-- modal ver -->
					  <div class="box box-primary">
						<div class="box-body no-padding">
							<div class="table-responsive">
								<small class="float-right" style="margin-left: 10px; margin-right:10px;" >
									<div class="row" class="col-sm-6">
									<div class="col-sm-12"> 
										<div class="form-group">
										<label for="IdSucursal" style="font-weight: normal; font-size: 16px">Sucursal:</label>
										<select id="IdSucursal" name="IdSucursal" class="form-control" <?php echo UsuariosModel::permission_combobox(); ?>>
											<option value="">Todas</option><!-- selected -->
											<?php SucursalesModel::combobox_lista(); ?>
										</select>
										</div>
									</div>
									</div>
									</small><br>

								<table id="table-data" class="table table-bordered table-striped">
								<thead>
									<tr>
											<th>ID Prenomina</th>
                      						<th>No Semana</th>
                      						<th>Fecha Inicio </th>
                      						<th>Fecha Termino</th>
                      						<th>Comentarios</th>
                      						<th>Situacion Prenomia</th>
                      						<th>Fecha Captura</th>
                      						<th>Acciones</th>
									</tr>
								</thead>
								</table>
							</div>
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
