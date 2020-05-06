<?php
	//PrestamosModel::delete($_GET['id']);
	PrestamosModel::delete($_GET['id'], $_SESSION['id_employe']);
?>