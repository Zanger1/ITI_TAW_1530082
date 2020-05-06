
<?php

	if(isset($_SESSION["NoSemana"])==false)
	{
		$NoSemana = $_GET["NoSemana"]; 
		//se crea esta varia ble de session por que se usa en el modal de prenominadetalles
		$_SESSION["NoSemana"] = $NoSemana;
	}
    //se comento por que tronaba 
	//$IdPrenominaExtra = $_GET["IdPrenominaExtra"]; 

	
   /*
	echo $NoSemana;
	echo "<br>";
	echo $IdPrenominaExtra;
	*/
?>

<!-- modal agregar --------------------------------------------------------------------------------------------------------------------------------->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" id="modal-form-save----" action="?view=PreNominaDetalles&action=save" autocomplete="off">
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
	  <form method="post" id="modal-form-edit----" action="?view=PrenominaDetalles&action=update" autocomplete="off">
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
            <div class="card-header">
				<small class="float-left">
					<h3 class="custom-font" style="font-family: 'Y2K Neophyte'; font-weight: normal; font-style: normal;">
				</small>

            </div>
			<?php
				$id = '';
				if(isset($_GET["IdPrenominaExtra"])){
					$id = $_GET["IdPrenominaExtra"];
				}
				$PreNomina=PreNominaModel::searchById($id);

			?>
			<form class="form-inline">
			<div class="form-group">
				<label for="noSem">No. Semana: &nbsp; </label>
				<label><?php echo $PreNomina->getNoSemana(); ?></label>
				&nbsp;&nbsp;&nbsp;

				<label for="fechaInicio">Fecha de Inicio:</label>
				<input type="text" id="fechaI" class="form-control mx-sm-3" value="<?php echo $PreNomina->getFechaInicio(); ?>" disabled>
				
				<label for="fechaTermino">Fecha de Termino:</label>
				<input type="text" id="fechaT" class="form-control mx-sm-3" value="<?php echo $PreNomina->getFechaTermino(); ?>" disabled >
			</div>
			</form>



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
											<th>Num Empleado</th>
                    						<th>Nombre completo</th>
											<th>Subtotal</th>
                      						<th>Situación</th>
                      						<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
<!--
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
