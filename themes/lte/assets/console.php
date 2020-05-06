<?php 
//mini consola
$results = '';
if(isset($_POST["query"]) || isset($_POST["query_type"]) ){
	include("../../../connection.php");
	$q = $_POST["query"];
	$qt = $_POST["query_type"];
	#$db=DataBase::getConnect();	//No se ocupa por ahora
	$return = DataBase::console_read($q);
	if($qt == 2){
		$arr = $return;
		foreach($arr as $r){
			$r."\n";
		}
	}
}
?>
<div style="width: 90%; margin: 0 auto;">
	<form action="#" method="post">
	<textarea name="query" style="width: 100%; height: 150px; margin: 0 auto; margin-bottom:10px;"></textarea>
	<select name="query_type"><option value="1">Create, Update, Delete</option><option value="2">Read</option><select>
	<input type="submit">
	</form>
	<fieldset><legend>Results: </legend>
		<?php echo $results; ?>a
	</fieldset>
</div>

