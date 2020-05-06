<?php
/*
 * INVOICR : THE PHP INVOICE GENERATOR (HTML, DOCX, PDF)
 * Visit https://code-boxx.com/invoicr-php-invoice-generator for more
 * 
 * ! YOU CAN DELETE THE ENTIRE EXAMPLE FOLDER IF YOU DON'T NEED IT... !
 */

/* [STEP 1 - CREATE NEW INVOICR OBJECT] */
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "invoicr.php";

//echo "<script> alert (dirname(__DIR__) . DIRECTORY_SEPARATOR . 'invoicr.php')</script>";
$invoice = new Invoicr();
///////
if(isset($_GET["uk"]))
{	//Unique Key / Clave Unica
	$clave_unica = $_GET["uk"];
}

if(isset($_GET["for"]))

{	//Rentas o servicios
	$for_operation = $_GET["for"];
}
if(isset($_GET["info"])){
	$action = $_GET["info"];
}


/////
include_once("../../../../../../../connection.php");
include_once("../../../../../../../Models/VentasModel.php");
include_once("../../../../../../../Models/UsuariosModel.php");
include_once("../../../../../../../Models/CRolesModel.php");
include_once("../../../../../../../Models/EmpleadosModel.php");

$invoice_object = new VentasModel(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);

$invoice_array = VentasModel::load_info_for_invoice_array($clave_unica, $for_operation);
/////
$ListaChoferes = EmpleadosModel::all_operativo();

if($action=="envio"){
	$chofer= VentasModel::choferes_asignados($clave_unica);
} else if($action=="recoleccion"){
	$chofer= VentasModel::choferes_asig_recuperan($clave_unica);
}
	//con este imprimo los choferes en el combobox - los que estan disponibles
                   // $ChoferesAsignados = VentasModel::choferes_asignados($clave_unica);
foreach($ListaChoferes as $e){
    #Si en cualquier momento en el array de los choferes ya viene asignado anteriormente, se marcara como seleccionado
    #Este caso es diferente a otros ejemplos, pues aqui pueden ser varios elementos seleccionados, en comparacion del modulo de usuarios cuando se selecciona un solo empleado, por ejemplo.
    in_array($e->getIdEmpleado(), $chofer);  
}
$array =  EmpleadosModel::getOnlyName($e->getIdEmpleado());     

////funcion de info empresa
//$array_info_empresa = VentasModel::info_empresa_array("1");
$id= $_SESSION["idsucursal"];////variable de sesion en una variable por el combobox
$array_info_empresa = VentasModel::info_empresa_array($id);////array de la funcion para la info de la sucursal



/* [STEP 2 - FEED ALL THE INFORMATION] */
// 2A - COMPANY INFORMATION
// OR YOU CAN PERMANENTLY CODE THIS INTO THE LIBRARY ITSELF
$invoice->set("company", [ /*
	(isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "logo.png",
	__DIR__ . DIRECTORY_SEPARATOR . "logo.png", */
	#"http://localhost/sanitam/Sanitam/dev/themes/lte/assets/plugins/PDF/invoicr/example/logo.png",
	"logo.png",
	"",
	//$_SESSION["id_sucursal"],
	"SUCURSAL: ".string_encoder($array_info_empresa[0]),
	string_encoder($array_info_empresa[1]),
	string_encoder($array_info_empresa[2]),
	string_encoder($array_info_empresa[3]),
	string_encoder($array_info_empresa[4]),
	string_encoder($array_info_empresa[5]),
	
]);



/*
$invoice-> ya es un objeto que viene con el framework para el renderizado de PDF, puedes declarar otras similares, ejemplo con guion bajo
*/
///folio
// 2B - INVOICE INFO
$invoice->set("invoice", [
	[VentasModel::getFolioByClaveUnicaForInvoice($clave_unica, $for_operation)]

]);

// 2C - BILL TO
//////Datos del cliente (solo sera de la empresa)
$invoice->set("billto", [
	string_encoder($invoice_array[0]), //Nombre
	"Tel. ".string_encoder($invoice_array[1]), //Telefono  
	"E-mail: ".string_encoder($invoice_array[2])  //CorreoElectronico 
]);

// 2D - SHIP TO
///CONTACTO
$invoice->set("shipto", [
	string_encoder($invoice_array[3]), //NombrePersonaEntrega
	string_encoder($invoice_array[4]).', '.string_encoder($invoice_array[5]), //nom_entidad y Nom_municipio
	string_encoder($invoice_array[6]).', '.string_encoder($invoice_array[7]).', '.string_encoder($invoice_array[8])
	//CodigoPostalEntrega, ColoniaEntrega, CalleEntrega
]);

$invoice->set("items", [
	string_encoder($for_operation)
	
]);
//$itemsCart = VentasModel::getItemsByCart($clave_unica, $for_operation);



/*foreach($itemsCart as $itc){
	$itc[]
}*/

// 2E - ITEMS
// YOU CAN JUST DUMP THE ENTIRE ARRAY IN USING SET, BUT HERE IS HOW TO ADD ONE AT A TIME... 
/*$items = [
	["Rubber Hose",	"5m long rubber hose",				3,	"$5.50", "$16.50"],
	["Rubber Duck",	"Good bathtub companion",			8,	"$4.20", "$33.60"],
	["Rubber Band",	"",									10,	"$0.10", "$1.00"],
	["Rubber Stamp","",									3,	"$12.30", "$36.90"],
	["Rubber Shoe", "For slipping, not for running",	1,	"$20.00", "$20.00"]
];*/
#foreach ($items as $i) { $invoice->add("items", $i); }
/*
foreach ($itemsCart as $i) 
{ 
		$invoice->add("items", $i); 
}
*/

/*
$invoice_subTotal = VentasModel::getSubTotalByOrderUniqueKey($clave_unica, $for_operation); //temporalmente es solo para rentas, habra que adaptar este template para servicios de igual manera.
$invoice_iva = $invoice_subTotal * 0.16; //Suponiendo que el IVA sea 16%
$invoice_grandTotal = $invoice_subTotal + $invoice_iva;

// 2F - TOTALS
*/
$invoice->set("totals", [
	"<br>",
	string_encoder(VentasModel::getFolioByClaveUnicaForInvoice($clave_unica, $for_operation))

]);

/*
$invoice->set("totals", [
	["SUB-TOTAL", "$".$invoice_subTotal],
	["IVA", "$".$invoice_iva],
	["TOTAL", "$".$invoice_grandTotal]
]);*/

///2F - PERSONA ENTREGA 
//[SERVICIO/RENTA]
//FOLIO


//FIRMA DEL ENTREGADO
$invoice->set("firma",[
	string_encoder($invoice_array[3])
]);

////FIRMA DEL CHOFER
$invoice->set("firmaChofer",[
	string_encoder( EmpleadosModel::getOnlyName($e->getIdEmpleado()) )
]);


// 2G - NOTES, IF ANY
$invoice->set("notes", [
#	"Cheques should be made payable to Code Boxx",
#	"Get a 10% off with the next purchase with discount code DOGE1234!"
'
<br> <br> 
<p> Se Anexa: <br/>
	Orden de '.$for_operation.'
</p>

<br>
<table>
	<tr style="width:100%;">
		<td style="width:20%; font-size:50px;">
			Sanitamex S.A de C.V.
			Calle Francisco Vazquez Gomez #419
			Fracc. Colinas del Valle C.P:87018.
			Cd. Victoria, Tam.
			RFC:SAN100119H78
			www.sanitam.com.mx TEL:(834)1351784
			email:ventas@sanitam.com.mx
		</td>
		<td style="width:20%; font-size:50px;">
			Sucursal Valles
			Calle Frontera y Bocanegra #1207     
			Col. Altavista.
			Cd. Valles, SLP.
			Tel:(481)3819292
			email:ventas2@sanitam.com.mx
		</td>
		<td style="width:20%; font-size:50px;">
			Sucursal Tampico
			Clavel #121 Col. Americo
			Villarreal.
			Tampico, Tam.
			Tel:(833)362-69-37
			ventas3@sanitam.com.mx
		</td>
		<td style="width:20%; font-size:50px;">
			Sucursal Matehuala        
			Guerrero #402 
			Col. Republica.
			Matehuala, SLP.
			Tel:(488)125-42-90
			ventas4@sanitam.com.mx
		</td>
	</tr>
</table>


'
]);


/* [STEP 3 - OUTPUT] */
// 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
$invoice->template("apple-ER");

/*****************************************************************************/
// 3B - OUTPUT IN HTML
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
# $invoice->outputHTML();
// $invoice->outputHTML(1);
// $invoice->outputHTML(2, "invoice.html");
// $invoice->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");
/*****************************************************************************/
// 3C - PDF OUTPUT
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
# $invoice->outputPDF();
# $invoice->outputPDF(1);
# $invoice->outputPDF(2, "invoice.pdf");
# $invoice->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");

if(isset($_GET["save"]) && $_GET["save"]=='true') 
{
	//Only Save on local server
	$date_folder = date("Y").'/'.date("m");
	$save_folder = "../../../../../../../storage/docs/".$date_folder."/";

	if (!is_dir($save_folder)) 
	{	//Create our directory if it does not exist
		mkdir($save_folder, 0777, true);
		#echo "Directory created";
	}
	$new_file_name = $_GET["action"].'-'.$_GET["for"].'-'.$_GET["uk"].'.pdf';

	$invoice->outputPDF(3, $save_folder. $new_file_name);
} 
else 
{
	$invoice->outputPDF();	//Only view file in browser
}

/*****************************************************************************/
// 3D - DOCX OUTPUT
// DEFAULT FORCE DOWNLOAD| 1 FORCE DOWNLOAD | 2 SAVE ON SERVER
// $invoice->outputDOCX();
// $invoice->outputDOCX(1, "invoice.docx");
// $invoice->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");
/*****************************************************************************/
?>