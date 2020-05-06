<div class="spoiler spoiler-full-width">
  <div class="spoiler-header">Click the button to open the spoiler.</div>
  <button class="spoiler-toggle">Toggle</button>
  <div class="spoiler-content">
    <h2>Spoiled Title</h2>
    <p>This text should be invisible until the spoiler box is opened.</p>
  </div>
</div>


<form method="post" action="">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Chofer</label>
      <select class="form-control select2" id="string_items" multiple="multiple" name="string_items[]">
		<?php
			$ListaEmpleados = EmpleadosModel::all_operativo();
			foreach($ListaEmpleados as $e){
			?>
			<option value="<?php echo $e->getIdEmpleado(); ?>"><?php echo EmpleadosModel::getOnlyName($e->getIdEmpleado()); ?></option>
		<?php } ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Fecha</label>
      <input type="date" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Cliente</label> <span data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $invoice_array[1]."\n".$invoice_array[2]; ?>">[?]</span>
      <input type="text" class="form-control" id="inputPassword4" value="<?php echo $invoice_array[0]; ?>" disabled>
    </div>

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
  
	  <div class="form-group">
		<label for="inputAddress2">Direcci&oacute;n de entrega</label>
		<textarea class="form-control" id="inputAddress2" placeholder="Direcci&oacute;n" disabled><?php echo

	string_encoder($invoice_array[4]).', '.string_encoder($invoice_array[5]).', '.
	string_encoder($invoice_array[6]).', '.string_encoder($invoice_array[7]).', '.string_encoder($invoice_array[8]);

		?></textarea>
	  </div>
	  
    <div class="row">
        <div class="col-sm-6">
	
                    <!--<div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <h4>Review Order</h4>
                        </div>
                        <div class="panel-body">
                                <div class="col-md-12">
                                    <strong>Subtotal (# item)</strong>
                                    <div class="pull-right"><span>$</span><span>200.00</span></div>
                                </div>
                                <div class="col-md-12">
                                    <strong>Tax</strong>
                                    <div class="pull-right"><span>$</span><span>200.00</span></div>
                                </div>
                                <div class="col-md-12">
                                    <small>Shipping</small>
                                    <div class="pull-right"><span>-</span></div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <strong>Order Total</strong>
                                    <div class="pull-right"><span>$</span><span>150.00</span></div>
                                    <hr>
                                </div>                        
                                <button type="button" class="btn btn-primary btn-lg btn-block">Checkout</button>
                        </div>
                    </div> -->

            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Persona(s) que entrega</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombre: </strong></span> Joaquin Buenaobra</li>
				
                <li class="list-group-item text-muted" contenteditable="false">Persona(s) que entrega</li>
				<li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombre: </strong></span> Joaquin Buenaobra</li>
            </ul>
		</div>
        <div class="col-sm-6">
            <!--left col-->
            <ul class="list-group">
                <li class="list-group-item text-muted" contenteditable="false">Persona quien recibe</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Nombre: </strong></span> <?php echo string_encoder($invoice_array[3]); ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Telefono: </strong></span>  <?php echo string_encoder($invoice_array[9]); ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong class="">Email: </strong></span> <?php echo string_encoder($invoice_array[10]); ?></li>
            </ul>
		</div>
	</div>
</form>