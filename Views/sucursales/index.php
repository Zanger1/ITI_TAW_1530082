<!-- modal agregar -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" id="modal-form-add" action="?view=Sucursales&action=save" autocomplete="off">
				<div class="modal-header">
						<h5 class="modal-title"><span style="color: green;">Sucursales</span> > <span style="color: #007bff;">Agregar </span></h5>

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
        <h5 class="modal-title"><span style="color: green;">Sucursales</span> > <span style="color: #007bff;">Ver</span></h5>
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
	  <form method="post" id="modal-form-edit" action="?view=Sucursales&action=update" autocomplete="off">
		  <div class="modal-header">
			<h5 class="modal-title"><span style="color: green;">Sucursales</span> > <span style="color: #007bff;">Editar</span></h5>
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
			<h5 class="modal-title"><span style="color: green;">Sucursales</span> > <span style="color: #007bff;">Eliminar</span></h5>
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
			  <small class="float-left"><h3 class="card-title">Sucursales</h3></small>
            </div>
            <div class="card-body">
		
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">
					  <div class="box box-primary">
						<div class="box-body no-padding">

							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nombre de la sucursal</th>
											<th colspan="3">&nbsp;</th>	
											<th>Acciones</th>										
										</tr>
									</thead>
									<tbody>
<!--										<tr>
											<td>Manuel Ruiz</td>
											<td>044 834 000 00 00</td>
											<td>usuaro@host.com</a> </td>
											<td><span data-toggle="tooltip" data-placement="top" title="Av. Nuevas Tecnologías 5902, Parque Científico y Tecnológico de Tamaulipas, 87138 Cd Victoria, Tamps.">Av. Nuevas Tecnologías 5902...<span></td>
											<td>
												<span data-toggle="tooltip" data-placement="top" title="Ver"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".modal-ver-persona"><i class="fa fa-eye"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Editar"><button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target=".modal-editar-persona "><i class="fa fa-edit"></i></button></span>
												<span data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target=".modal-eliminar-persona "><i class="fa fa-trash"></i></button></span>
											</td>
										</tr>	-->
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
		

