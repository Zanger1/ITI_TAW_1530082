<?php
	$Status=1;
	RutasModel::delete($_GET['id'], $_SESSION["id_employe"], $Status);
?>