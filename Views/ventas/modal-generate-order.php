<div class="spoiler spoiler-full-width">
  <div class="spoiler-header">Presiona el boton para ver el PDF.</div>
  <button class="spoiler-toggle">Vista previa</button>
  <div class="spoiler-content">
	<div id="ajax-content-view-pdf-on-spoiler"></div>
  </div>
</div>
<br>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputPassword4">Cliente:</label>
	  <?php echo $invoice_array[0]; ?>
	  <span data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $invoice_array[1]."\n".$invoice_array[2]; ?>">[?]</span>
      <!-- <input type="text" class="form-control" id="inputPassword4" value="<?php echo $invoice_array[0]; ?>" disabled> -->
    </div> <!--
    <div class="form-group col-md-4">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Fecha</label>
      <input type="date" class="form-control" id="inputPassword4" placeholder="Password">
    </div> -->

	<!--
    <div class="form-group col-md-3">
      <label for="inputState">Situaci&oacute;n</label>
      <select id="inputState" class="form-control">
        <option>Seleccionar</option>
        <option>Por entregar</option>
        <option>Entregado</option>
        <option selected>Por recoger</option>
        <option>Concluido</option>
        <option>Vencido</option>
      </select>
    </div>
	-->
  </div>
 

			<style>
				.table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td{
					padding: 5px;
				}
			</style>

    <div class="row">
        <div class="col-sm-12">
            <!--left col--> <!--
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false"><b style="color:black;">Direcci&oacute;n</b></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">Estado, municipio: </strong></span> <?php echo string_encoder($invoice_array[4]).' '.string_encoder($invoice_array[5]); ?></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">C&oacute;digo Postal: </strong></span>  <?php echo string_encoder($invoice_array[6]); ?></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">Detalles: </strong></span> <?php echo string_encoder($invoice_array[7]).' '.string_encoder($invoice_array[8]); ?></li>
            </ul> -->





			<table class="table table-condensed" style="pading:3px;">
				<thead class="thead-dark">
					<tr>
						<th colspan="4">Contacto:</th><th></th>
					</tr>
				</thead>
				<tbody>
				<tr>					
					   <th>Nombre</th><td><?php echo string_encoder($invoice_array[3]); ?></td>
					   <th>Entidad, municipio</th>
					<td><?php echo string_encoder($invoice_array[4]).' '.string_encoder($invoice_array[5]); ?></td>
					   

				</tr>
				<tr>
					<th>Telefono</th><td><?php echo string_encoder($invoice_array[9]); ?></td>
					<th>C&oacute;digo Postal</th><td><?php echo string_encoder($invoice_array[6]); ?></td>

					
				</tr>
				<tr>

					<th>Email</th><td><?php echo string_encoder($invoice_array[10]); ?></td>

				<th>Detalles</th><td><?php echo string_encoder($invoice_array[7]).' '.string_encoder($invoice_array[8]); ?></td>

						
				</tr>

				<tr>    <th colspan="2"></th>
						<th >Fecha y hora<br>de entrega</th>
						<td><?php echo  date('d/m/Y',strtotime(string_encoder($invoice_array[11])));   /*string_encoder($invoice_array[11]); */?> - <?php echo   date('H:i:s', strtotime(string_encoder($invoice_array[12])));/*string_encoder($invoice_array[12]);*/ ?></td>
					</tr>
				</tbody>
			</table>
		</div>
        <!--
        <div class="col-sm-6">
        --> 
            <!--left col--> <!--
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false"><b style="color:black;">Recibe</b></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">Nombre: </strong></span> <?php echo string_encoder($invoice_array[3]); ?></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">Telefono: </strong></span>  <?php echo string_encoder($invoice_array[9]); ?></li>
                <li class="list-group-item text-left"><span class="pull-left"><strong class="">Email: </strong></span> <?php echo string_encoder($invoice_array[10]); ?></li>
				<li class="list-group-item text-left"><span class="pull-left"><strong class="">Fecha de entrega: </strong></span> <input class="form-control" type="text" value="" style=""></li>
				<li class="list-group-item text-left"><span class="pull-left"><strong class="">Fecha de entrega: </strong></span> <input class="form-control" type="text" value="" width="30%"></li>
				<li class="list-group-item text-left"><span class="pull-left"><strong class="">Hora de entrega: </strong></span> <input class="form-control" type="text" value=""></li>
            </ul> -->
<!--
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
						<th>Fecha y hora<br>de entrega</th><td><?php echo  date('d/m/Y',strtotime(string_encoder($invoice_array[11])));   /*string_encoder($invoice_array[11]); */?> - <?php echo   date('H:i:s', strtotime(string_encoder($invoice_array[12])));/*string_encoder($invoice_array[12]);*/ ?></td>
					</tr>
				</tbody>
			</table>
		</div>-->
	</div>
<input type="text" value="<?php echo $invoice_array[13]; ?>" name="clave_unica" hidden> 
<input type="text" value="<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>" name="for" hidden> 