
<!-- modal agregar -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post"  id="modal-form-add" action="?view=Nomina&action=save"autocomplete="off">
				<div class="modal-header">
					<h5 class="modal-title"><span style="color: green;">N&oacute;mina</span> > <span style="color: #007bff;">Agregar </span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div id="ajax-content-add"></div>
				</div>
				<div class="modal-footer">
					<button type="submit"  class="btn btn-primary ">Aceptar</button>
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
	  <form method="post" id="modal-form-edit" action="?view=Nomina&action=update" autocomplete="off">
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
			<h5 class="modal-title"><span style="color: green;">N&oacute;mina</span> > <span style="color: #007bff;">Eliminar</span></h5>
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
						Generar N&oacute;mina 
					</h3>
				</small>
				<small class="float-right">
						<button type="button" name="add" id="" class="btn btn-primary btn-sm button-open-modal-addA"  data-toggle="modal" data-placement="top" title="Agregar">+Agregar</button>				
				</small>					

            </div>
            <div>
				<?php 
					$db = DataBase::getConnect();
					$consulta = $db->prepare('SELECT  MAX(NoSemana) semana, MAX(FechaInicio) FechaI, MAX(FechaTermino) FechaT FROM nominasucursal');
					$consulta->execute();
					$semana = $consulta->fetch();
					$semanaNomina = "Semana del ".strftime("%A %e de %B del %Y",strtotime($semana['FechaI']))." al ".strftime("%A %e de %B del %Y",strtotime($semana['FechaT']));
					$NoSemana = $semana['semana'];

##consulta para obtener los subtotales
					$dbC = DataBase::getConnect();
					$conSub = $dbC->prepare('SELECT TotalSeptimoDia TotSDia, TotalSueldoBase TotSBase, TotalSueldo TotSue,TotalExtras TotExt,TotalInfonavit TotInfo,TotalPrestamos TotPres, TotalSaldoAnterior TotSAnt,TotalAbono TotAbo, TotalSueldoActual TotSAnte,TotalSueldoNeto TotSNeto FROM nominasucursal WHERE idNominaSucursal = (SELECT MAX(idNominaSucursal) FROM detallenominasucursal)');
					$conSub->execute();
					$totales = $conSub->fetch();
					

					$TotalSeptimoDia = $totales['TotSDia'];
					$TotalSueldoBase = $totales['TotSBase'];
					$TotalSueldo = $totales['TotSue'];
					$TotalExtras = $totales['TotExt'];
					$TotalInfonavit = $totales['TotInfo'];
					$TotalPrestamos = $totales['TotPres'];
					$TotalSaldoAnterior = $totales['TotSAnt'];
					$TotalAbono = $totales['TotAbo'];
					$TotalSueldoActual = $totales['TotSAnte'];
					$TotalSueldoNeto = $totales['TotSNeto'];


				?>
				<small class="form-group float-left col-md-7">
					<input type="text" class="form-control vf_no_spl_char" id="" placeholder="" value="<?php echo $semanaNomina; ?>" name="" readonly>
				</small>
				<small class="form-group float-right col-md-1">
					<input type="text" class="form-control vf_no_spl_char" id="" placeholder="" value="<?php echo $NoSemana; ?>" name="" readonly>
				</small>
				<small class="form-group float-right col-md-0">
					Semana:
				</small>
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
											<th>Numero</th>
											<th>Empleado</th>
											<th>Puesto</th>
											<th>D&iacute;as</th>
											<th>S&eacute;ptimo D&iacute;a</th>
											<th>Sueldo Base</th>
											<th>Sueldo</th>
											<th>Extras</th>
											<th>Infonavit</th>
											<th>Prestamo</th>
											<th>Saldo Anterior</th>
											<th>Abono</th>
											<th>Saldo Actual</th>
											<th>Sueldo Neto</th>
											<th>Comentarios</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div style="text-align: right;">	
					


<table id="table-data" class="table table-bordered table-striped">
									<thead>
									<tr>
											
											<th><b> Totales</b></th>
											<th>Total S&eacute;ptimo D&iacute;a</th>
											<th>Total Sueldo Base</th>
											<th>Total Sueldo</th>
											<th>Total Extras</th>
											<th>Total Infonavit</th>
											<th>Total Prestamos</th>
											<th>Total Saldo Anterior</th>
											<th>Total Abono</th>
											<th>Total Saldo Actual</th>
											<th>Total Saldo Neto</th>
										</tr>
										
									</thead>

<tbody>
										<td></td>
										<td>$<?php echo $TotalSeptimoDia; ?></td>
										<td>$<?php echo $TotalSueldoBase; ?></td>
										<td>$<?php echo $TotalSueldo; ?></td>
										<td>$<?php echo $TotalExtras; ?></td>
										<td>$<?php echo $TotalInfonavit; ?></td>
										<td>$<?php echo $TotalPrestamos; ?></td>
										<td>$<?php echo $TotalSaldoAnterior; ?></td>
										<td>$<?php echo $TotalAbono; ?></td>
										<td>$<?php echo $TotalSueldoActual; ?></td>
										<td>$<?php echo $TotalSueldoNeto; ?></td>
									</tbody>

	</table>
								<!--FIN TABLA SUBTOTALES-->
		
						<button type="button" name="add" id=""  class="btn btn-success btn-sm" disabled=true" data-toggle="modal" data-placement="top" title="Agregar">Aceptar</button>		
						


						<button type="button" name="add" id=""  class="btn btn-success btn-sm" onclick="this.disabled=true" data-toggle="modal" data-placement="top" title="Agregar">Enviar</button>		
						
					</div>
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
