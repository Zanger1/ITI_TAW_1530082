<?php 

$for='';
if(isset ($_GET['for'])){
  $for = $_GET['for'];
  #echo $for;
}

if ($for=="rentas")
{
  $for="Rentas";
}
else if ($for=="servicios")
{
  $for="Servicios";
}



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

  
  <!------ by start ---> 
  <!-- Creado por Paulina para generar orden de envio .--->
<div class="card">
    

<div class="card-header">
    <small class="float-left">
      <h3 class="card-title"><?php echo $for; ?> > <span style="color: #007bff;"> Generar recolecci&oacute;n</span></h3>
    </small>
   
</div>


   <!-- INICIO DE LA PARTE DE LA TABLA DE LOS DATOS DEL CLIENTE -->
    <div class="form-row">
        <div class="form-group col-md-4">
          <div class="card-header">
            <small class="float-left"><h3 class="card-title">Cliente </h3></small>
          </div>

          <label for="inputPassword4"><?php echo $invoice_array[0] ?></label>
          <span data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $invoice_array[1]."\n".$invoice_array[2]; ?>">[?]</span>
          
        </div>
    </div>
    <script>
          $(document).ready(function(){
            $("#ocultamuestra").click(function(){
              $("#divoculto").each(function() {
                displaying = $(this).css("display");
                if(displaying == "block") {
                  $(this).fadeOut('slow',function() {
                    $(this).css("display","none");
                  });
                } else {
                  $(this).fadeIn('slow',function() {
                    $(this).css("display","block");
                  });
                }
              });
            });
          });
        </script>	

<div>				   					
          <div class="spoiler spoiler-full-width">
            <div class="spoiler-header">Presiona el boton para ver el PDF. &nbsp; </div>
            <button class="archivo" >Vista previa</button> 
            <br>
            <div id="ajax-content-archivo" style="display:none;">
              <div>
                <div class="spoiler-content">
                  <div id="ajax-content-view-pdf-on-spoiler"></div>
              </div>
            </div>
          </div>
      </div>
      <br>
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
    </div>
    <!-- FINAL DE LA PARTE DE LA TABLA DE LOS DATOS DEL CLIENTE -->      

  <!-- ***** by start -->

    <!-- /.card-header -->

    <!-- INICIO DE LA PARTE DE ASIGNADO DE CHOFERES -->
  <div class="card-header">
      <small class="float-left"><h3 class="card-title">Asignar chofer(es)</h3></small>
  </div>
    <!-- INICIO DEL CUERPO DE LA PARTE DE ASIGANDO DE CHOFERES -->        
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
                    $ChoferesAsignados = VentasModel::choferes_asig_recuperan($clave_unica);
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
                <!--input type="text" name="clave_unica" value="<?php //echo $clave_unica; ?>" hidden>
                <input type="submit" name="actualizar_choferes" value="Actualizar"-->
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
    <!-- FINAL DEL CUERPO DE LA PARTE DE ASIGNADO DE CHOFERES -->                
 
    
  <!--- ********** by final --->

    <div class="modal-footer">
      <!--- actualizar_choferes(model o controller) para la entrega -->
      <!--- Documentado por paulina para asegurar el modo de pruebas
        *****************************************
       --->
      <!--button name="actualizar_choferes" class="btn btn-primary"><a href="./?view=Ventas&action=stock_recovery" id="actualizar_choferes" >Entrega</a></button-->
      <!--input type="submit" name="actualizar_choferes" class="btn btn-primary">Entrega</button
      *******************************************
      -->
      <!--- Creacion de botones funcionales para la generar envios -->
      <input type="text" name="clave_unica" value="<?php echo $clave_unica; ?>" hidden>
			
      <!--
        <input type="submit" name="actualizar_choferes" value="Generar recuperaci&oacute;n" class="btn btn-primary">
      -->
      <input type="submit" name="actualizar_choferes" value="Continuar" id="button-envio" class="btn btn-primary">
      <!--button-- type="button" class="btn btn-secondary" data-dismiss="modal" onClick="history.back();">Regresar</!--button-->
    </div>
<!-- *********
      FALTA LA IMPRESION DE LOS ARCHIVOS (PDF) DESPUES DE GENERAR LA ORDEN CON LOS CHOFERES ASIGNADOS
      ********
 --->

 <!--- Modal a mostrar el archivo de envio -->
    <!-- modal a mostrar -->
    <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">            
            <small class="float-left">
              <h3 class="card-title"><?php echo $for; ?> > <span style="color: #007bff;"> Generar recuperaci&oacute;n</span></h3>
            </small> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
					  </button>           
          </div>
          <div class="modal-body" id="modal-body">
            <div id="ajax-content"></div>
          </div>
          <div class="modal-footer">
          <input type="submit" name="actualizar_choferes" value="Aceptar"   id="button-envio" class="btn btn-primary" >
                    
            <?php 	
                    ////editado por paulina en modo de prueba
              if(isset($_POST["actualizar_choferes"]) && $_POST["clave_unica"]){
                if(isset($_POST["string_items"])){
                  VentasModel::update_choferes_recuperan($_POST["string_items"], $_POST["clave_unica"]);
                  header("Location: index.php?view=Ventas&action=index&for=rentas&is_archived=true"); 

                } else if(empty($_POST["string_items"]) || $_POST["string_items"]==''){
                  VentasModel::update_choferes_recuperan(null, $_POST["clave_unica"]);
                  header("Location: index.php?view=Ventas&action=index&for=rentas&is_archived=true"); 
                }
              }
                ///Modificado por paulina 
                /// en modo de prueba sobre su funcionalidad 
                if(isset($_POST["actualizar_stock"]) && $_POST["clave_unica"]){
                  update_stock_invenry_on_recovery();
                }      
            ?>
            
          </div>
        </div>
      </div>
    </div>
  <!-- Fin del modal a mostrar el archivo de envio -->



  
</div>
<input type="text" value="<?php echo $invoice_array[13]; ?>" name="clave_unica" hidden> 
<!-- Creado por Paulina en resultado de generar envio a orden "[rentas/servicios]" -->
<input type="text" value="<?php if(isset($_GET["clave_unica"]) && $_GET["action"]=='print_recuperacion' && $_GET["for"]){ $ListaPorClave = VentasModel::getItemsByCart($_GET["clave_unica"], $_GET["for"]); } ?>" name="for" hidden> 

