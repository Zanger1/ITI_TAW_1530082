<?php 
/*
if(isset($_GET["clave_unica"]) && $_GET["for"]){ 
	$clave_unica = $_GET["clave_unica"];
} 
else 
{ 
    $clave_unica=''; 
}
*/
$clave_unica = $invoice_array[13];
//echo " clave unica" . $clave_unica;

  $for='';	
  $archivo='';
  if (isset($_GET['for']) && isset($_GET['is_archived'])){
    $for = $_GET['for']; 
    $archivo = $_GET['is_archived'];
	  //echo $for.' - '. $archivo;
  }
?>

<!---* ****** Vista de editar orden --->

  <div class="spoiler spoiler-full-width">
    <div class="spoiler-header">Presiona el boton para ver el PDF.</div>
    <button class="spoiler-toggle">Vista previa</button>
    <div class="spoiler-content">
      <div id="ajax-content-view-pdf-on-spoiler"></div>
    </div>
  </div>
  <br>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputState">Ubicaci&oacute;n</label>

      <select id="inputState1" class="form-control" name="id_situacion_ubicacion" onchange="OnSelectionChange(this)"
        <?php // <?php //if($invoice_array[15]==3) { style="visibility:hidden;" <?php  } //if($invoice_array[15]==3 || $invoice_array[15]==5){ echo 'disabled'; }?> >
        <option value="">Seleccionar</option>
		    <?php
          $selected_ubicacion = $invoice_array[15];
          $ubicaciones = VentasModel::__situacion($_GET["for"], 'ubicacion');
          foreach($ubicaciones as $u){
            $selected_u = '';
            if($u[0]==$selected_ubicacion){ 
              $selected_u = 'selected'; 
            } else { 
              $selected_u = ''; 
            }
            echo '<option value="'.$u[0].'" '.$selected_u.'>'.$u[1].'</option>';
                      
          } ?>
      </select>
    </div>
    
    <div class="form-group col-md-3">
      <label for="inputPassword4">Situaci&oacute;n de pago</label>
      <select id="inputState2" class="form-control" name="id_situacion_monetaria" onchange="OnSelectionChange(this)">
        <option value="" >Seleccionar</option>
          <?php
            $selected_pagos = $invoice_array[16];
            $pagos = VentasModel::__situacion($_GET["for"], 'monetaria');
            foreach($pagos as $p){
              $selected_p = '';
              if($p[0]==$selected_pagos){ 
                $selected_p = 'selected'; 
              } else { 
                $selected_p = ''; 
              }
              echo '<option value="'.$p[0].'" '.$selected_p.'>'.$p[1].'</option>'."\n";
              
            } 
          ?>
      </select>
    </div>
    

	<script>
/*document.getElementById('inputState').onchange = function(){
  document.getElementById('requiere_folio').disabled = !this.checked;
}*/
/*
function cambio(){
  var e = document.getElementById("inputState1");
  var strUser = e.options[e.selectedIndex].value;
  var OnSelectionChange = OnSelectionChange(strUser);
}
*/

function OnSelectionChange (select) {
  /*this.state = {
      email: '',
      password: ''
    };*/
    
          var selectedOption = select.options[select.selectedIndex];
          //alert("Index: " + selectedOption.index + " is " + selectedOption.text);
          // alert ("The selected option is " + selectedOption.value);
          
          /*if(selectedOption.text == "Recuperado" && selectedOption.text == "Cobrada (sin factura)" ){
            document.getElementById("finalizado").disabled = false;
          } else{
            document.getElementById("finalizado").disabled = true;
          }*/
          return selectedOption;
}



	//habilitar y deshabilitar input con checkbox
	document.getElementById('requiere_folio').onchange = function() {
		document.getElementById('Folio_factura').disabled = !this.checked;
    
	};   
	</script>    
    <div class="form-group col-md-3">
      <label>Requiere factura <input id="requiere_folio" type="checkbox" name="RequiereFactura" disabled                                                                                                                                                                                                                                             >       
      </label>
      <input id="Folio_factura" type="text" class="form-control" name="Folio_factura" value="<?php echo $invoice_array[14];?>" disabled >
    </div>
  

	<div class="form-group col-md-3">
      <label for="inputState">Finalizaci&oacute;n <input type="checkbox" name="finalizado" id="finalizado" onchange="cambio();" disabled
      <?php 
      /* 
      sentecnia:
      -Para finalizar debe estar en recuperado y cobrado(sin factura) [3,2] o recuperado y cobrado(con factura) [3,3] 
      - para finalizar en servicios en realizado y cobrado(sin factura)[5,2] o realizado y cobrado(con factura) [5,3]
      */ 
      #Modificado por paulina
      /*  if(($invoice_array[15]==3 && $invoice_array[16]==2) || ($invoice_array[15]==3 && $invoice_array[16]==3) || ($invoice_array[15]==5 && $invoice_array[16]==2) || ($invoice_array[15]==5 && $invoice_array[16]==3) ){ ////Sentencia para habilitar el checkbox por medio de la ubicacion 'Recuperado'
          if($invoice_array[18]=="1"){ echo 'checked';  }  ////sentencia para el checked del combobox
        } else{
          echo 'disabled'; ///Desabilitar el comobobox sin la ubicacion 'Recuperado'
        }*/
      ?>>      
      </label><br>
      <!-- <button type="button" class="btn btn-info" id="button-send-mail">Finalizar</button>-->
	  <!--<center><img src="./themes/lte/assets/dist/img/user_online.png"></center>-->
    </div>
   
	<!--- cuerpo de entregas --->
	   <!---- 
    INICIO DEL CUERPO DE DEVOLUCION AL INVENTARIO
    #Modificado por paulina
    -->

   <!----- PENDIENTE ----- 
    <?php 
      ///if($_GET["for"]=="rentas"){
    ?>
    <div>
      <div class="card-header">
        <small class="float-left"><h3 class="card-title">Devoluciones al inventario</h3></small>
      </div>
      <div class="card-body">
      <-- Main content --->
        <!--section class="content">
          <div class="row">
            <div class="col-md-12">					
              <div class="box box-primary" id="recuperado">
                <!--p>Cuando una orden finaliza los productos deben devolverse al inventario, ya sea a la sucursal de original u otra diferente.</p-->

                <!--table class="table table-responsive">
                  <thead>
                    <tr>
                      <th style="width:80px;"></th>
                      <th style="width:200px;">Descripci&oacute;n</th>
                      <th title="Cantidad solicitada">Cantidad<br>en renta</th>
                      <th>Recuperaci&oacute;n</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    #Modificado por paulina                    
                      $subtotal = 0;
                      //if(isset($_GET["action"]) && isset($_GET["clave_unica"]) && $_GET["for"])
                      //{
                        //$ListaPorClave = VentasModel::getItemsByCart($_GET["clave_unica"], $_GET["for"]);                      
                        $ListaPorClave = VentasModel::getItemsByCart($clave_unica, $_GET["for"]);
                        //$ListaPorClave  = VentasModel::update_cart_recuperado($invoice_array[19],$numero, $comentario, $clave_unica,'rentas');
                        foreach($ListaPorClave as $i)
                        { 
                          
                          /////// PARAMETROS: idInventarioUnidadRenta,idSucursal,cantidadRecuperada,ComentarioRecu,ClaveUnica,[servicio/rentas]
                          //$datos = VentasModel::update_cart_recuperado($i[4],$invoice_array[19],$_POST["numRec"],$_POST["Comentario"],$clave_unica,"servicios");
                          //foreach($datos as $d){
                               
                        
                        ?>
                    <tr>
            <!-- Ventas&action=index&for=rentas&is_archived=true 
            action="./?view=Ventas&action=update_cart&with_modal=opened&clave_unica=<?php// echo $_GET["clave_unica"]; ?>&for=<?php //echo $_GET["for"]; ?>"
            -->     
                      <!--form method="post" class="allforms" action="./?view=Ventas&action=update_cart&with_modal=opened&clave_unica=<?php// echo $_GET["clave_unica"];?>&for=<?php echo $_GET["for"];?>"-->
                      <form method="post" class="allforms" action="?view=Ventas&action=index&for=rentas&is_archived=true" name="form_rec" id="form_rec">
                      <!--form  method="post" action="./?view=Ventas&action=<?php //if($archivo=='true'){ echo 'update_order'; echo 'update_cart_recuperado';}  ?>" id="modal-form-convert"-->
                        <!--td width="25"><img src="themes/lte/assets/dist/img/no-photo.jpg" width="50" ></td>
                        
                        <td><?php echo $i[0].' - '.$i[1].'<br>**ID: '.$i[6].'<br>**unidadRenta: '.$i[5].'<br>**idSucursalOrigen: '.$invoice_array[19]; ?></td>
                        <td width="10"><?php echo $i[2]; ?></td>
                          
                        <td>
                          <div class="row" >
                            <div class="col col-md-3">
                              <!--input type="number"  class="form-control" name="qty" min="1" max="<?php echo $i[2]; ?>" value="<?php echo $i[2];//$numero= $i[2]; echo $numero ?>"  onkeydown="return false"-->
                              <!--input type="number" class="form-control" name="cantRec" id="cantRec" min="1" max="<?php echo $i[2]; ?>" value="" onkeydown="return false"
                                  
                              <?php 
                              #Modificado por paulina
                                if($invoice_array[15]=="3") { ////Sentencia para habilitar el input de numeros por medio de la ubicacion  
                                  /*if(isset($_GET['numRec'])){
                                    $numero = $_GET['numRec'];
                                    echo $numero;
                                    
                                  }*/
                                } else{
                                  /*echo 'disabled';*/ ///Desabilitar el input de numeros sin la ubicacion 'Recuperado'
                                }
                              ?> >
                              <?php 
  ////// #CREADO POR PAULINA:
  ////// SENTENCIA PARA ASIGNAR LOS DATOS PARA LA RECUPERACION EN LA BASE DE DATOS _COTIZACIONES_CART_RENTAS
                          ?>
                            </div>
                            <div class="col col-md-5" >
                              <input type="text" id="IdSucursal" name="IdSucursal" class="form-control" 
                              value="<?php 
                              #Modificado por paulina
                                $sucursales =  SucursalesModel::sucursal();
                                 ?>"
                             >
                              <input type="text" id="recuperar_cantidad_SucOrigen" name="recuperar_cantidad_SucOrigen" class="form-control" 
                              value="<?php 
                              #Modificado por paulina                                                            
                                echo $invoice_array[19];                                
                              ?>"
                              hidden>
                            </div>
                            <div class="col col-md-4">
                              <textarea placeholder="Nota" class="form-control" name="Comentario" id="Comentario" value=""
                              <?php 
                              #Modificado por paulina
                                if($invoice_array[15]=="3") { ////Sentencia para habilitar la nota por medio de la ubicacion 
                                 /* if(isset($_GET["Comentario"])){
                                    $comentario = $_POST["Comentario"];
                                  }  */      
                                } else{
                                  echo 'disabled'; ///Desabilitar la nota sin la ubicacion 'Entregado'
                                }
                              ?> >
                              </textarea>
                            </div>
                          </div>
                        </td>
                        <input type="text" name="id" value="<?php echo $i[6]; ?>" placeholder="ID" hidden>
                        <!--input type="text" name="id" value="<?php #Modificado por paulina
                          //if($_GET["for"]){   
                            /////// PARAMETROS: *idInventarioUnidadRenta* idSucursal,cantidadRecuperada,ComentarioRecu,ClaveUnica,[servicio/rentas]
                            //$datos = VentasModel::update_cart_recuperado($i[8],$invoice_array[19], $numero, $comentario, $clave_unica,'rentas');
                           // $datos = VentasModel::update_cart_recuperado($i[8],$invoice_array[19], $numero, $comentario, $clave_unica,'rentas'); 
                                                  
                          //} ?>" placeholder="ID" hidden-->
                       
                      <!--/form>
                    </tr>
                    <?php 
                   // }
                  } 
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>            
        </section>                  
      </div>                    

      <!-- FINAL DEL CUERPO DE DEVOLUCION AL INVENTARIO -->
    <!--?php }?-->
    </div>             
  </div>

<input type="text" value="<?php echo $invoice_array[13]; ?>" name="clave_unica" hidden>
<input type="text" value="<?php #Modificado por paulina
if($_GET["for"]){ 
  echo $_GET["for"];           
} ?>" name="for" hidden>



