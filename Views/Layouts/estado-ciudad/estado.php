<!-- esta vista no se ha utilizado (17/07/2019) -->
<select>
<?php
foreach($listaEstados as $e){
	echo '<option value="'.$e->getIdEstado().'">'.$e->getEstado().'</option>';
}
?>
</select>