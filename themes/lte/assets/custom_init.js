//Deshabilitar tecla "enter" (Si no se usa el boton de busqueda retorna error por no rellenar los campos)
/* $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
	if(e.keyCode == 13) {
		e.preventDefault();
		alert("Por favor use los botones");
		return false;
	}
}); */

/*

//Enviar sin recargar pagina	//Solo modal
$(document).on('submit', '.modal-form', function(e) {
	 $.ajax({
		url: $(this).attr('action'),
		type: $(this).attr('method'),
		data: $(this).serialize(),
		success: function(html) {
			alert('Empleado registrado exitosamente');
		   $('#modal-add').modal('hide');
		   $( "#table-ajax" ).load(window.location.href + " #table-ajax" );
		}
	});
	e.preventDefault();
});

*/







//DatePicker
$('.input-type-datepicker').datepicker({
	todayBtn:'linked',
	format: "yyyy-mm-dd",
	autoclose: true
});

//Tool Tips
$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});
		
//Sweet Alert 2
$(function () {
// jQuery(document).ready(function(){
	jQuery(document).on('click', '.detelete-account', function(e){
		var uid = jQuery(this).data('uid');	//atributo data-id
		SwalDelete(uid); jhh
		e.preventDefault();
	});
	//});
function SwalDelete(uid){
swal({
	title: "&iquest;Seguro que deseas borrar?", 
	text: "&iquest;Estas seguro? Antes debes comprobar que eres el administrador:",
	input: "password",
	inputType: "password",
	showCancelButton: true,
	closeOnConfirm: false
}, function(typedPassword) {

	if (typedPassword === "") {
		swal.showInputError("Escribe tu contrase&ntilde;a para continuar!");
        return false;
	}

	$.ajax({
		url: "Controllers/functions/checkPassword.php",
        data: { password: typedPassword, uid: uid },
        type: "POST",
		dataType: "json"
	})
	.done(function(data) {
        swal("Deleted!", "Borrado!", "success");
	})
	.error(function(data) {
        swal.showInputError("Contrase&ntilde;a erroenea!");
	});
});
};
});

//Full Calendar
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week : 'Semana',
        day  : 'Dia'
      },
      //Random default events
      events    : [
        {
          title          : 'Click for Google',
          start          : new Date(y, m, 28),
          end            : new Date(y, m, 29),
          url            : 'http://google.com/',
          backgroundColor: '#3c8dbc', //Primary (light-blue)
          borderColor    : '#3c8dbc' //Primary (light-blue)
        }
      ],
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })
/*
    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
  


/* Modales - esto lo hice para el CAI, carga request AJAX dentro de un modal  */
    jQuery(function($){
         $('a.ShowList').click(function(ev){
             ev.preventDefault();
             var uid = $(this).data('id');
             var grupo = $(this).data('grupo');
             $.get('Controllers/functions/ajax/asistencia/list_activities.php?id=' + uid + '&grupo=' + grupo, function(html){
                 $('#ListActivities .modal-body').html(html);
                 $('#ListActivities').modal('show', {backdrop: 'static'});
             });
         });
    });

//Smart Wizard
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});


        $(document).ready(function(){

            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
               }else if(stepPosition === 'final'){
                   $("#next-btn").addClass('disabled');
               }else{
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
               }
            });


      var for_op = $("#for_operation").val();
            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finalizar').addClass('btn btn-info').attr('id', 'allsubmit').on('click', function(){
				swal("Cotizaci&oacute;n guardada", "Se guard&oacute; una nueva cotizaci&oacute;n con exito.", "success").then((result) => {
       window.location.href="index.php?view=Ventas&action=index&for=" + for_op + "&is_archived=false"; 
       //window.location.href="index.php?view=Ventas&action=index&for=rentas&is_archived=false"; 
        //jlopezl
        //falta colocar el codigo para redirigir a rentas u ordens segun sea el caso

         //window.location.reload();           
         //Recargamos la pagina para prevenir que el usuario presione el boton de finalizar mas de 1 vez (Asi evitamos registros duplicados)         
				});
				//La informacion se manda en automatico en cada Form, revisar lineas #487
			});
      
      var btnCancel = $('<button></button>').text('Cancelar').addClass('btn btn-danger').on('click', function(){
				$('#smartwizard').smartWizard("reset");
				swal("Cotizaci&oacute;n cancelada", "Intentalo nuevamente.", "error").then((result) => {
				window.location.href="index.php?view=Ventas&action=index&for=" + for_op + "&is_archived=false"; 

          //window.location.reload(); //Recargamos la pagina
        
        //jlopezl
        //falta colocar el codigo para redirigir a rentas u ordens segun sea el cas
        //window.location.href="index.php?view=Ventas&action=index&for=rentas&is_archived=false"; 

				});
			});

            // Smart Wizard
            $('#smartwizard').smartWizard({
                    selected: 0,
                    theme: 'default',
                    transitionEffect:'fade',
                    showStepURLhash: true,
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarButtonPosition: 'end',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    }
            });


            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });

            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });

            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });

            $("#theme_selector").on("change", function() {
                // Change theme
                $('#smartwizard').smartWizard("theme", $(this).val());
                return true;
            });

            // Set selected theme on page refresh
            $("#theme_selector").change();
        });


//Shop Cart
$(document).ready(function() {
 
/* Set rates + misc */
var taxRate = 0.16;
var shippingRate = 0; 
var fadeTime = 300;
 
 
/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});
 
$('.product-removal button').click( function() {
  removeItem(this);
});
 
 
/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
   
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
   
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
   
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    //$('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}
 
 
/* Update quantity */
function updateQuantity(quantityInput){
	/* Calculate line price */
	var productRow = $(quantityInput).parent().parent().parent(); //el tercer .parent() se lo he agregado porque se quedo encerrado en un <form>... remover el tercer en caso de eliminar el form del .append(tpl)
  //var productRow2 = $(quantityInput).parent().parent();
  //var price = parseFloat(productRow.children('.product-price').text());
  var price = $(quantityInput).val();
  var quantity = $(quantityInput).val();
	var linePrice = price * quantity;
	
	/* Update line price display and recalc cart totals */
	productRow.children('.product-line-price').each(function () {
		$(this).fadeOut(fadeTime, function() {
			$(this).text(linePrice.toFixed(2));
			recalculateCart();
			$(this).fadeIn(fadeTime);
		});
	});  
}
 
/* Remove item from cart */
function removeItem(removeButton){
	/* Remove row from DOM and recalc cart total */
	var productRow = $(removeButton).parent().parent();

	//Con lo siguiente se borra toda la fila de la tabla
	productRow.slideUp(fadeTime, function() {
		productRow.remove();
		recalculateCart();
	});
}

$(".remove-product").on("click", function(){
	//Con esto hacemos una lista de los IDs que seran borrados del carrito al guardar los cambios
	var deleted_id = $(this).attr('data-deleted_item');
	var clave_unica = unique_key = $("#unique_key_order").val();
	var for_operation = $("#for_operation").val();

	//Se genera un form individual con el ID a borrar del carrito
	var del_item_tpl = '<form method="post" class="allforms" action="?view=Ventas&action=delete_items_on_update_cart&with_modal=opened&for='+for_operation+'&clave_unica='+ unique_key +'">' + '<input type="text" id="deleted_item" value="'+ deleted_id +'" name="deleted_item" placeholder="delete item" hidden></form>';
	$("#deleted_items").append(del_item_tpl);
	return false;
});

/*
	function rand_code(){	//Aun no se esta utilizando
		var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var lon  =  25;
		var code = "";
		for (x=0; x < lon; x++){
			rand = Math.floor(Math.random()*chars.length);
			code += chars.substr(rand, 1);
		}
		return code;
	}
*/

	//Mostrar la informacion del cliente seleccionado
	var IdCliente = $('option:selected', this).attr('id');
	$('#ajax-content-clientInformation').load('index.php?view=Clientes&action=load_info_for_invoice&with_modal=opened&id='+IdCliente);

	//Copiar el IdCliente al formulario Datos de entrega
	$(document).on('change', '#IdCliente',function(){
		var copyIdCliente = '';
		var IdCliente = $("#IdCliente").val();
		copyIdCliente = $("#copyIdCliente").val(IdCliente);
		$('#ajax-content-clientInformation').load('index.php?view=Clientes&action=load_info_for_invoice&with_modal=opened&id='+IdCliente);
	});
	
	
	//Modal extra, agregar productos al shopcart usando un modal con select2
	$("#add-items-to-shopcart").click(function(e){	//Al presionar el boton de agregar
		var for_operation = $("#for_operation").val(); 
		var unique_key = $("#unique_key_order").val();
		var item_id = '';
		var item_desc = '';
		var item_price = '';
		var item_max_stock = '';
		var item_tpl = '';		//Esto es lo que el usuario ver
		var items_list = $('#string_items option:selected').map(function() {
			//$('#string_items option:selected').find(':selected').data('price');
      item_id = $(this).val(), item_desc = $(this).text(), item_price = 0.00, item_max_stock = $(this).data('max-stock'), 
      item_tpl = '<div class="product"><div class="product-image"><img src="themes/lte/assets/dist/img/no-photo.jpg"></div><div class="product-details"><div class="product-title">'+item_desc+'</div><!-- <p class="product-description">sampleText</p>--></div>  <!--<div class="product-price" hidden>'+item_price+'</div>--><div class="product-quantity"><form method="post" class="allforms" action="?view=Ventas&action=save_cart&with_modal=opened&for='+for_operation+'"><input type="text" name="id" value="'+item_id+'" placeholder="ID" hidden><input type="text" class="product-price" name="price" placeholder="precio" id="product-price" value="0.00" ><input type="number" class="new-product-quantity" value="1" name="qty" min="1" max="'+item_max_stock+'" onkeydown="return false"> <input name="clave_unica" value="'+unique_key+'" placeholder="clave unica de orden" hidden><input type="submit" name="send_item_btn" hidden></form></div><div class="product-removal"><button type="button" class="remove-product">Remover</button></div><div class="product-line-price">'+item_price+'</div>		</div>';
			return item_id, item_desc, item_price, item_max_stock, item_tpl;
		});
		for (item_tpl of items_list){	//Lo que el user ver
			//alert(item_id +' - '+item_desc+' - '+item_price);
			$("#total-items-on-cart").append(item_tpl); //A la lista del carrito se le agregan los productos indicados
			$('#total-items-on-cart').on('click',' button',function(){	//Lo que se agregue via ajax solo se puede remover con este bloque, las funciones de arriba son para efectos de demostracion con items estaticos
				$(this).closest('.product').remove();
				recalculateCart();
			});
			$('.product-quantity input').change( function() {
        alert($(this));
				//if($(this).val > item_max_stock){ alert("No hay items suficiente en el inventario"); } else {
					updateQuantity(this); 
				//}	//con min & max attrs esto ya quedo validado
			});
		    recalculateCart();
      //renderCartTable();
		}
		
		//Limpiar select2
		$("#string_items").select2("val", "");

		//Cerrar modal
		$('.modal').modal('hide');

	});


	
	//Boton de prueba para enviar todos los items al carrito
	$(document).on('click', '#allsubmit',function(){
		var continue_submit = 0;
		$('.form-control').each(function(){
			//Comprobar que ningun campo quede vacio antes de enviar
			if($(this).val() == "" ){
				continue_submit = 0;
			} else {
				continue_submit = 1;
			}
		});
		
		if(continue_submit == 1){
			//Enviar todos los forms agregados como item en el carrito
			$('.allforms').each(function(){	//.allforms
				valuesToSend = $(this).serialize();
				$.ajax($(this).attr('action'),
					{
						method: $(this).attr('method'),
						data: valuesToSend
					}
				)
			});
		} else if(continue_submit == 0){
			//No hacer nada
			swal("No permitido", "Por favor rellene todos los campos del formulario en cada paso", "error")
			//alert('Por favor rellene todos los formularios');
			return false;	//El mensaje se muestra una sola vez en pantalla
		}
			
	});

});