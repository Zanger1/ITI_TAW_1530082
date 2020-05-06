<?php

	$Status=0;
	$rutas = new RutasModel(null,$_POST['NombreRuta'],$_POST['Empresas'],$_POST['Comentarios'],$_SESSION['id_sucursal'],$_POST['EmpleadoCaptura'],null,null,null,$Status);
	RutasModel::save($rutas);
	
?>