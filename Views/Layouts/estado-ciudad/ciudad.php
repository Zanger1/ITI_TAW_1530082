<select id="new-select-ciudad" class="form-control select2" name="IdCiudad" required>
	<?php
	global $selected_2;
	
	if(isset($_GET["id"]) && $_GET["id"]>0){
		echo '<option value="">Seleccionar</option>';
		foreach($listaCiudades as $c){
			echo '<option value="'.$c->getId_ciudad().'"'.' '.$selected_2.'>'.string_encoder($c->getCiudad()).'</option>';
		}		
	} else if($_GET["id"]=="0") {
		//No hay ciudades que elegir si por default hay estados
		echo '<option value="">Selecciona un estado primero</option>';
	}
	
	?>
</select>