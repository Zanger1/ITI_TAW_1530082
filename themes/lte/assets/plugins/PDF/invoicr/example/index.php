<?php
/*
 * INVOICR : THE PHP INVOICE GENERATOR (HTML, DOCX, PDF)
 * Visit https://code-boxx.com/invoicr-php-invoice-generator for more
 * 
 * ! YOU CAN DELETE THE ENTIRE EXAMPLE FOLDER IF YOU DON'T NEED IT... !
 */
if(isset($_GET["uk"]))
{	//Unique Key / Clave Unica
	$clave_unica = $_GET["uk"];
	$_SESSION["idclaveUnica"] = $clave_unica;
}

if(isset($_GET["for"]))
{	//Rentas o servicios
	$for_operation = $_GET["for"];
}

include_once("../../../../../../../connection.php");
include_once("../../../../../../../Models/VentasModel.php");
$invoice_object = new VentasModel(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
$invoice_array = VentasModel::load_info_for_invoice_array($clave_unica, $for_operation);



/* [STEP 1 - CREATE NEW INVOICR OBJECT] */
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "invoicr.php";
$invoice = new Invoicr();


/* [STEP 2 - FEED ALL THE INFORMATION] */
// 2A - COMPANY INFORMATION
// OR YOU CAN PERMANENTLY CODE THIS INTO THE LIBRARY ITSELF$
$suc = $_SESSION["idsucursal"];///variable de session de idsucursal del combobox
$array_info_empresa = VentasModel::info_empresa_array($suc);///array de la funcion para la info de la sucursal

$invoice->set("company", [ /*
	(isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . "logo.png",
	__DIR__ . DIRECTORY_SEPARATOR . "logo.png", */
	//"http://localhost/sanitam/Sanitam/dev/themes/lte/assets/plugins/PDF/invoicr/example/logo.png",
	"logo.png",
	"",	
	"SUCURSAL: ".string_encoder($array_info_empresa[0]),///Nombre de la sucursal
	string_encoder($array_info_empresa[1]),///Direccion
	string_encoder($array_info_empresa[2]),///Ciudad
	string_encoder($array_info_empresa[3]),///Estado
	"Teléfono: ".string_encoder($array_info_empresa[4]),///Teléfono
	"Correo: ".string_encoder($array_info_empresa[5])///Correo electronico
	#"Code Boxx", 
	#"Street Address, City, State, Zip",
	#"Phone: xxx-xxx-xxx | Fax: xxx-xxx-xxx",
	#"https://code-boxx.com",
	#"doge@code-boxx.com"*/


]);



/*
$invoice-> ya es un objeto que viene con el framework para el renderizado de PDF, puedes declarar otras similares, ejemplo con guion bajo
*/

// 2B - INVOICE INFO
$invoice->set("invoice", [
	[VentasModel::getFolioByClaveUnicaForInvoice($clave_unica, $for_operation)]

]);

// 2C - BILL TO
$invoice->set("billto", [
	string_encoder($invoice_array[0]), //Nombre
	string_encoder($invoice_array[1]), //Telefono  
	string_encoder($invoice_array[2])  //CorreoElectronico 
]);

// 2D - SHIP TO
$invoice->set("shipto", [
	string_encoder($invoice_array[3]), //NombrePersonaEntrega
	string_encoder($invoice_array[4]).', '.string_encoder($invoice_array[5]), //nom_entidad y Nom_municipio
	string_encoder($invoice_array[6]).', '.string_encoder($invoice_array[7]).', '.string_encoder($invoice_array[8])
	//CodigoPostalEntrega, ColoniaEntrega, CalleEntrega
]);


$itemsCart = VentasModel::getItemsByCart($clave_unica, $for_operation);
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
foreach ($itemsCart as $i) 
{ 
		$invoice->add("items", $i); 
}



$invoice_subTotal = VentasModel::getSubTotalByOrderUniqueKey($clave_unica, $for_operation); //temporalmente es solo para rentas, habra que adaptar este template para servicios de igual manera.
$invoice_iva = $invoice_subTotal * 0.16; //Suponiendo que el IVA sea 16%
$invoice_grandTotal = $invoice_subTotal + $invoice_iva;

// 2F - TOTALS
$invoice->set("totals", [
	["SUB-TOTAL", "$".$invoice_subTotal],
	["IVA", "$".$invoice_iva],
	["TOTAL", "$".$invoice_grandTotal]
]);

// 2G - NOTES, IF ANY
$invoice->set("notes", [
#	"Cheques should be made payable to Code Boxx",
#	"Get a 10% off with the next purchase with discount code DOGE1234!"
'
<br>
<div style="text-align:justify;">
<span style="font-size:10px;">Para Pago depositar a: Sanitamex S.A de C.V. </span><span style="font-size:13px; color:red;">| CTA. 0641156247 | CLABE: 072810006411562472 |</span> <span style="font-size:10px;">BANCO BANORTE
El contratante deber pagar el costo total del equipo en caso de robo, incendio, fenómenos meteorológicos, inundaciones, daños fisicos y vandalismo. El contratante se hace
responsable por el daño que ocasione el sanitario o algunos accesorios a personas como: daños físicos, daños a la salud, daños ambientales ya sean por viento, lluvias, sol y
golpes.</span>
</div>
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
$invoice->template("apple");

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
	$new_file_name = $_GET["for"].'-'.$_GET["uk"].'.pdf';

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