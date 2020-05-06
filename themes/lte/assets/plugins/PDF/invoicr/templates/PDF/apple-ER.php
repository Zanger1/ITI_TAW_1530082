<?php
/*
 * APPLE PDF INVOICE THEME
 * Visit https://code-boxx.com/invoicr-php-invoice-generator for more
 */
$action = $_GET["info"];
//$action = $_GET["action"];
echo '<script>document.write("<h1>"'.$action.'"</h1>");</script>';

// HTML HEADER & STYLES
$this->data .= "<!DOCTYPE html><html><head><style>".
"html,body{font-family:DejaVuSans}#invoice{max-width:800px;margin:0 auto}#billship,#company,#items{width:100%;border-collapse:collapse}#company td,#billship td,#items td,#items th{padding:5px}#company,#billship{margin-bottom:30px}#company img{max-width:180px;height:auto}#bigi{font-size:28px;color:#ad132f}#billship{background:#49e629; /* #b92d2d */color:#fff}#billship td{width:33%}#items th{text-align:left;border-top:2px solid #f6a5a5;border-bottom:2px solid #f6a5a5}#items td{border-bottom:1px solid #f6a5a5}.idesc{color:#ca3f3f}.ttl{font-weight:700}.right{text-align:right}#notes{margin-top:30px;font-size:.95em}#company{margin-top:500px;margin-bottom:-20px;}".
"</style></head><body><div id='invoice'>";

// COMPANY LOGO + INFORMATION
///Logotipo de la empresa
$this->data .= "<table id='company'><tr><td><img src='".$this->company[0]."'/></td><td class='right'>"; 
for ($i=2;$i<count($this->company);$i++) {
	$this->data .= "<div>".$this->company[$i]."</div>";
}
$this->data .= "</td></tr></table>";


/////
///INFORMACION DE LA PERSONA A ENTREGAR
if($action == "envio"){
	$this->data .= "<div id='bigi'>Hoja de entrega</div>";
		/////INFORMACION DEL CLIENTE			
	$this->data .= "</p>";
	$this->data .= "<div id='items'><strong>Datos del cliente:</strong> ";
	foreach ($this->billto as $c) { 
		$this->data .= $c.". <br> ";

	}
	$this->data .= "<p> <strong>Datos del contacto que recibe</strong> <br>";
	foreach ($this->shipto as $e) { 
		$this->data .= $e.". <br> ";

	}
} else if($action == "recoleccion"){
	$this->data .= "<div id='bigi'>Hoja de recolección</div>";
		/////INFORMACION DEL CLIENTE			
	$this->data .= "</p>";
	$this->data .= "<div id='items'><strong>Datos del cliente:</strong> ";
	foreach ($this->billto as $c) { 
		$this->data .= $c.". <br> ";

	}
	$this->data .= "<p> <strong>Datos del contacto</strong> <br>";	

	foreach ($this->shipto as $e) { 
		$this->data .= $e.". <br> ";

	}
}

//////FOLIO	
foreach ($this->totals as $t) {
	$this->data .= "<font style='text-transform: uppercase;'>".$t;
}
////[RENTAS/SERVICIOS]
foreach ($this->items as $f) {
	$this->data .= "<br><font style='text-transform: capitalize;'>Tipo: ".$f;
}

if($action == "envio"){
	///FIRMA
	foreach($this->firma as $fir){
		$this->data .="<br />
					<div style='text-align: center;'>
						<p>".$fir."</p>
						<p>______________________________</p>
						<p>Nombre y Firma</p>
						<p>Contacto que recibe</p>
					</div>";
			
	}
} else if($action == "recoleccion"){
	///FIRMA
	foreach($this->firma as $fir){
		$this->data .="<br />
					<div style='text-align: center;'>
						<p>".$fir."</p>
						<p>______________________________</p>
						<p>Nombre y Firma</p>
						<p>Contacto</p>
					</div>";
			
	}
}

foreach($this->firmaChofer as $firc){
	$this->data .="<br /><br />
				<div style='text-align: center;'>
					<p>".$firc."</p>
					<p>______________________________</p>
					<p>Nombre y Firma</p>
					<p>Chofer</p>
				</div>";
		
}


$this->data .= "</div>";

//////////PIE DE PAGINA DEL DOCUMENTO QUE CONTIENE DATOS IMPORTANTES DE LA EMPRESA
// NOTES
if (count($this->notes)>0) {
	$this->data .= "<div id='notes'>";
	foreach ($this->notes as $n) {
		$this->data .= $n."<br>";
	}
	$this->data .= "</div>";
}

/////CIERRE DEL HTML
// CLOSE
$this->data .= "</div></body></html>";
$mpdf->WriteHTML($this->data);
?>