<?php

	$rutas = new RutasModel($_POST['IdRuta'],$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],null,null,null,null,null,null);
	RutasModel::update($rutas);
	/*
	Puntos faltantes
	-La variable MontoRestante se actualizará cada que la nomina sea aceptada //aún hay que checar bien cuando
	*/
?>