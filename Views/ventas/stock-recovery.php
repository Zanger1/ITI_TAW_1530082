<?php 
if(isset($_GET["clave_unica"])){ 
	$clave_unica = $_GET["clave_unica"];
} else { $clave_unica=''; }


#este metodo busca si un existe un valor dentro de un array MULTIDIMENSIONAL, no jala pero se ve ue tiene futuro... pues PHP ta tiene una funcion llamada in_array pero no funciona con multidimencional
function in_multiarray($value, $array,$field){
    $top = sizeof($array) - 1;
    $bottom = 0;
    while($bottom <= $top)
    {
        if($array[$bottom][$field] == $value)
            return true;
        else 
            if(is_array($array[$bottom][$field]))
                if(in_multiarray($value, ($array[$bottom][$field])))
                    return true;

        $bottom++;
    }        
    return false;
}
?>
<!-- ***** by start -->
		<div class="card">
            <!-- /.card-header -->
            <div class="card-header">
			  <small class="float-left"><h3 class="card-title">Asignar choferes</h3></small>
            </div>
            <div class="card-body">
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">
					  <div class="box box-primary">
						<div class="box-body no-padding">
						<form action="" method="post">
							<select class="select2" multiple="multiple" name="string_items[]" id="string_items" data-placeholder="Selecciona un o mas articulos de la lista">
								<?php
									$ListaChoferes = EmpleadosModel::all_operativo();	//con este imprimo los choferes en el combobox - los que estan disponibles
									$ChoferesAsignados = VentasModel::choferes_asignados($clave_unica);
									foreach($ListaChoferes as $e){
										#Si en cualquier momento en el array de los choferes ya viene asignado anteriormente, se marcara como seleccionado
										#Este caso es diferente a otros ejemplos, pues aqui pueden ser varios elementos seleccionados, en comparacion del modulo de usuarios cuando se selecciona un solo empleado, por ejemplo.
										if(in_array($e->getIdEmpleado(), $ChoferesAsignados)){
											$selected_1='selected';
										} else {
											$selected_1='';
										}
									?>
									<option value="<?php echo $e->getIdEmpleado(); ?>" <?php echo $selected_1; ?>><?php echo EmpleadosModel::getOnlyName($e->getIdEmpleado()); ?></option>
								<?php } ?>
							</select>
							<input type="text" name="clave_unica" value="<?php echo $clave_unica; ?>" hidden>
							<input type="submit" name="actualizar_choferes" value="Actualizar">
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
<!--- ********** by final --->
		<div class="card">
            <!-- /.card-header -->
            <div class="card-header">
			  <small class="float-left"><h3 class="card-title">Devoluciones al inventario</h3></small>
            </div>
            <div class="card-body">
				<!-- Main content -->
				<section class="content">
				  <div class="row">
					<div class="col-md-12">					
					  <div class="box box-primary">
						<div class="box-body no-padding">
							<p>Cuando una orden finaliza los productos deben devolverse al inventario, ya sea a la sucursal de original u otra diferente.</p>

							<table class="table table-responsive">
								<thead>
									<tr>
										<th style="width:110px;"></th>
										<th style="width:390px;">Descripci&oacute;n</th>
										<th title="Cantidad solicitada">Cantidad<br>solicitada</th>
										<th>Devoluciones</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$subtotal = 0;
								if(isset($_GET["action"]) && isset($_GET["clave_unica"]) && $_GET["action"]=='stock_recovery' && $_GET["for"]){
								$ListaPorClave = VentasModel::getItemsByCart($_GET["clave_unica"], $_GET["for"]);
								foreach($ListaPorClave as $i){ ?>
									<tr>
										<form method="post" class="allforms" action="./?view=Ventas&action=update_cart&with_modal=opened&clave_unica=<?php echo $_GET["clave_unica"]; ?>&for=<?php echo $_GET["for"]; ?>">
											<td><img src="themes/lte/assets/dist/img/no-photo.jpg" width="100"></td>
											<td><?php echo $i[0].' - '.$i[1]; ?></td>
											<td width="90"><?php echo $i[2]; ?></td>
											<td>
												<div class="row">
													<div class="col col-md-3"><input type="number" class="form-control" min="1" max="<?php echo $i[2]; ?>" value="<?php echo $i[2]; ?>"></div>
													<div class="col col-md-5"><select id="IdSucursal" name="IdSucursal" class="form-control"><option value="">Todas</option><!-- selected --><?php SucursalesModel::combobox_lista(); ?></select></div>
													<div class="col col-md-4"><textarea placeholder="Nota" class="form-control"></textarea></div>
												</div>
											</td>
											<input type="text" name="id" value="<?php echo $i[5]; ?>" placeholder="ID" hidden>
										</form>
									</tr>
								<?php }} ?>
								</tbody>
							</table>

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