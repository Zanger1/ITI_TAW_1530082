
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputPassword4">Cliente | <?php echo $invoice_array[1]."\n".$invoice_array[2]; ?></label>
	  <?php echo $invoice_array[0]; ?>
    </div>
  </div>
 

			<style>
				.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
					padding: 5px;
				}
			</style>

    <div class="row">
        <div class="col-sm-6">
			<table class="table table-condensed" style="pading:3px;">
				<thead class="thead-dark">
					<tr>
						<th>Direcci&oacute;n</th><th></th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<th>Entidad, municipio</th><td><?php echo string_encoder($invoice_array[4]).' '.string_encoder($invoice_array[5]); ?></td>
				</tr>
				<tr>
					<th>C&oacute;digo Postal</th><td><?php echo string_encoder($invoice_array[6]); ?></td>
				</tr>
				<tr>
					<th>Detalles</th><td><?php echo string_encoder($invoice_array[7]).' '.string_encoder($invoice_array[8]); ?></td>
				</tr>
				</tbody>
			</table>
		</div>
        <div class="col-sm-6">
			<table class="table table-condensed" style="pading:3px;">
				<thead class="thead-dark">
					<tr>
						<th>Recibe</th><th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Nombre</th><td><?php echo string_encoder($invoice_array[3]); ?></td>
					</tr>
					<tr>
						<th>Telefono</th><td><?php echo string_encoder($invoice_array[9]); ?></td>
					</tr>
					<tr>
						<th>Email</th><td><?php echo string_encoder($invoice_array[10]); ?></td>
					</tr>
					<tr>
						<th>Fecha y hora<br>de entrega</th><td><?php echo string_encoder($invoice_array[11]); ?> - <?php echo string_encoder($invoice_array[12]); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<input type="text" value="<?php echo $invoice_array[13]; ?>" name="clave_unica" hidden> <input type="text" value="<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>" name="for" hidden> 


<hr>

Entrega