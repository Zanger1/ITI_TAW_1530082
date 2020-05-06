//lo unico que diferencia a este de "outside_modal", es que este sirve para validar dentro de los modales de BootStrap, la diferencia son solo algunas lineas

$('body').on('shown.bs.modal', '.modal', function() {	//Con esta linea puedo inicializar cualquier plugin dentro de los modales

		//Aprovecho para inicializar este plugin dentro de los modales para validar que los precios sean positivos 
		$(".numeric").numeric({ decimal : ".",  negative : false, scale: 3 });	//Requiere incluir el Script
		
		//Este otro es diferente, pero omite Caracteres "raros" en campos de texto
		$(function(){

			$('.vf_no_spl_char').keyup(function()
			{
				var yourInput = $(this).val();
				re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				var isSplChar = re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char = yourInput.replace(/[`~!@$%^&*()_|+\=¿?;:'",<>\{\}\[\]\\\/]/gi, '');
					$(this).val(no_spl_char);
				}
			});
			
			$('.vf_only_phone_num').keyup(function()
			{
				var yourInput = $(this).val();
				re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				var isSplChar = re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char = yourInput.replace(/[`~!@$%^&|\=¿?;:'",.<>\{\}\[\]\\\/]/gi, '');
					$(this).val(no_spl_char);
				}
			});
			
			$('.vf_username').keyup(function()
			{
				var yourInput = $(this).val();
				re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
				var isSplChar = re.test(yourInput);
				if(isSplChar)
				{
					var no_spl_char = yourInput.replace(/[`~!@#$%^&|\()*+=¿?;:'",.<>\{\}\[\]\\\/]/gi, '');
					$(this).val(no_spl_char);
				}
			});

		});

});