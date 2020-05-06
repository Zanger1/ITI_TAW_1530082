<?php

class HistorialModel{
	private $idNominaSucursal;
	private $idSucursal;
	private $NoSemana;
	private $FechaInicio;
	private $FechaTermino;
	private $TotalSeptimoDia;
	private $TotalSueldoBase;
	private $TotalSueldo;
	private $TotalExtras;
	private $TotalInfonavit;
	private $TotalPrestamos;
	private $TotalSaldoAnterior;
	private $TotalAbono;
	private $TotalSueldoActual;
	private $TotalSueldoNeto;
	private $idEmpleadoCaptura;
	private $FechaCaptura;

	function __construct($idNominaSucursal, $idSucursal, $NoSemana, $FechaInicio, $FechaTermino, $TotalSeptimoDia, $TotalSueldoBase, $TotalSueldo,$TotalExtras, $TotalInfonavit, $TotalPrestamos, $TotalSaldoAnterior, $TotalAbono, $TotalSueldoActual, $TotalSueldoNeto,$idEmpleadoCaptura, $FechaCaptura){

		$this->setidNominaSucursal($idNominaSucursal);
		$this->setidSucursal($idSucursal);
		$this->setNoSemana($NoSemana);
		$this->setFechaInicio($FechaInicio);
		$this->setFechaTermino($FechaTermino);
		$this->setTotalSeptimoDia($TotalSeptimoDia);
		$this->setTotalSueldoBase($TotalSueldoBase);
		$this->setTotalSueldo($TotalSueldo);
		$this->setTotalExtras($TotalExtras);
		$this->setTotalInfonavit($TotalInfonavit);
		$this->setTotalPrestamos($TotalPrestamos);
		$this->setTotalSaldoAnterior($TotalSaldoAnterior);
		$this->setTotalAbono($TotalAbono);
		$this->setTotalSueldoActual($TotalSueldoActual);
		$this->setTotalSueldoNeto($TotalSueldoNeto);
		$this->setidEmpleadoCaptura($idEmpleadoCaptura);
		$this->setFechaCaptura($FechaCaptura);
	}

	public function getidNominaSucursal(){
		return $this->idNominaSucursal;
	}
	public function setidNominaSucursal($idNominaSucursal){
		$this->idNominaSucursal=$idNominaSucursal;
	}
	
	public function getidSucursal(){
		return $this->idSucursal;
	}
	public function setidSucursal($idSucursal){
		$this->idSucursal=$idSucursal;
	}

	public function getNoSemana(){
		return $this->NoSemana;
	}
	public function setNoSemana($NoSemana){
		$this->NoSemana=$NoSemana;
	}
	
	public function getFechaInicio(){
		return $this->FechaInicio;
	}
	public function setFechaInicio($FechaInicio){
		$this->FechaInicio=$FechaInicio;
	}
	
	public function getFechaTermino(){
		return $this->FechaTermino;
	}
	public function setFechaTermino($FechaTermino){
		$this->FechaTermino=$FechaTermino;
	}

	public function getTotalSeptimoDia(){
		return $this->TotalSeptimoDia;
	}
	public function setTotalSeptimoDia($TotalSeptimoDia){
		$this->TotalSeptimoDia=$TotalSeptimoDia;
	}

	public function getTotalSueldoBase(){
		return $this->TotalSueldoBase;	
	}
	public function setTotalSueldoBase($TotalSueldoBase){
		$this->TotalSueldoBase=$TotalSueldoBase;
	}

	public function getTotalSueldo(){
		return $this->TotalSueldo;		
	}
	public function setTotalSueldo($TotalSueldo){
		$this->TotalSueldo=$TotalSueldo;
	}

	public function getTotalExtras(){
		return $this->TotalExtras;
	}
	public function setTotalExtras($TotalExtras){
		$this->TotalExtras=$TotalExtras;
	}

	public function getTotalInfonavit(){
		return $this->TotalInfonavit;
	}
	public function setTotalInfonavit($TotalInfonavit){
		$this->TotalInfonavit=$TotalInfonavit;
	}

	public function getTotalPrestamos(){
		return $this->TotalPrestamos;		
	}
	public function setTotalPrestamos($TotalPrestamos){
		$this->TotalPrestamos=$TotalPrestamos;
	}

	public function getTotalSaldoAnterior(){
		return $this->TotalSaldoAnterior;
	}
	public function setTotalSaldoAnterior($TotalSaldoAnterior){
		$this->TotalSaldoAnterior=$TotalSaldoAnterior;
	}

	public function getTotalAbono(){
		return $this->TotalAbono;
	}
	public function setTotalAbono($TotalAbono){
		$this->TotalAbono=$TotalAbono;
	}

    public function getTotalSueldoActual(){
		return $this->TotalSueldoActual;
	}
	public function setTotalSueldoActual($TotalSueldoActual){
		$this->TotalSueldoActual=$TotalSueldoActual;
	}

	public function getTotalSueldoNeto(){
		return $this->TotalSueldoNeto;
	}
	public function setTotalSueldoNeto($TotalSueldoNeto){
		$this->TotalSueldoNeto=$TotalSueldoNeto;
	}

	public function getidEmpleadoCaptura(){
		return $this->idEmpleadoCaptura;
	}
	public function setidEmpleadoCaptura($idEmpleadoCaptura){
		$this->idEmpleadoCaptura=$idEmpleadoCaptura;
	}

	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}
	public function setFechaCaptura($FechaCaptura){
		$this->FechaCaptura=$FechaCaptura;
	}

################

	public static function all(){
		$db=DataBase::getConnect();
		$listahistorial=[];
		#$select=$db->query('CALL get_clientes("")');
		$select=$db->query('SELECT * FROM nominasucursal');
		foreach($select->fetchAll() as $historial){$listahistorial[]=new HistorialModel($historial['idNominaSucursal'],$historial['idSucursal'],$historial['NoSemana'],$historial['FechaInicio'],$historial['FechaTermino'],$historial['TotalSeptimoDia'], $historial['TotalSueldoBase'],$historial['TotalSueldo'],$historial['TotalExtras'],$historial['TotalInfonavit'],$historial['TotalPrestamos'], $historial['TotalSaldoAnterior'],$historial['TotalAbono'], $historial['TotalSueldoActual'], $historial['TotalSueldoNeto'], $historial['idEmpleadoCaptura'],$historial['FechaCaptura']);
		}
		return $listahistorial;
	}

public static function get_total_all_records(){
		$db=DataBase::getConnect();
		//$select=$db->prepare('CALL get_clientes("")');
		$select=$db->prepare('SELECT * FROM nominasucursal WHERE idSucursal=:IdSucursal');
		$select->bindValue('IdSucursal',$_SESSION['id_sucursal']);
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
}

public static function all_json(){

		//Acortar texto
		function shorter($text, $chars_limit){
			if (strlen($text) > $chars_limit){
				$new_text = substr($text, 0, $chars_limit);
				$new_text = trim($new_text);
				return '<span data-toggle="tooltip" data-placement="top" title="'.$text.'">'.$new_text . "...".'</span>';
			} else {
				return $text;
			}
        }
		
		$db=DataBase::getConnect();
		$output = array();

			$query = '';
		$search_filter='';
		if (isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ) {
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST['search']['value'];
		}else{
			$search_filter = '';
			$row = '';
			$rowperpage = '';
		}


		$query .= 'select* from nominasucursal where NoSemana=NoSemana AND IdSucursal=:IdSucursal'; //Dudas de este query

		if (isset($search_filter) || isset($row) || isset($rowperpage)) {
			$query .= ' AND NoSemana LIKE "%'.$search_filter.'%" ORDER BY NoSemana DESC';

			$query_for_counter = $query;

			if ((isset($row) || isset($rowperpage)) && ($row>0 || $rowperpage>0)) {
				$query .= ' limit '.$row.','.$rowperpage.' ';
			}
		}else{
			$query .= ' ORDER BY NoSemana DESC';
		}
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		#$query = "select * from nominasucursal";


		$statement = $db->prepare($query);
		$statement->bindValue('IdSucursal',$_SESSION['id_sucursal']);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			$direccion = 'a';
			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["NoSemana"];
			//$sub_array[] = $row["idEmpleado"];
			$sub_array[] =$row['FechaInicio'];
			$sub_array[] =$row['FechaTermino'];//CRolesModel::getOnlyName($row["IdRol"]);
			
			if(is_null($row["TotalSeptimoDia"])){
				$sub_array[] = $row["TotalSeptimoDia"];
			}else{
				$sub_array[] ='$'.$row["TotalSeptimoDia"];
			}

			if(is_null($row["TotalSueldoBase"])){
				$sub_array[] = $row["TotalSueldoBase"];
			}else{
				$sub_array[] ='$'.$row["TotalSueldoBase"];
			}

			if(is_null($row["TotalSueldo"])){
				$sub_array[] = $row["TotalSueldo"];
			}else{
				$sub_array[] ='$'.$row["TotalSueldo"];
			}

			if(is_null($row["TotalExtras"])){
				$sub_array[] = $row["TotalExtras"];
			}else{
				$sub_array[] ='$'.$row["TotalExtras"];
			}

			if(is_null($row["TotalInfonavit"])){
				$sub_array[] = $row["TotalInfonavit"];
			}else{
				$sub_array[] ='$'.$row["TotalInfonavit"];
			}

			if(is_null($row["TotalPrestamos"])){
				$sub_array[] = $row["TotalPrestamos"];
			}else{
				$sub_array[] ='$'.$row["TotalPrestamos"];
			}

			if(is_null($row["TotalSaldoAnterior"])){
				$sub_array[] = $row["TotalSaldoAnterior"];
			}else{
				$sub_array[] ='$'.$row["TotalSaldoAnterior"];
			}
			if(is_null($row["TotalAbono"])){
				$sub_array[] = $row["TotalAbono"];
			}else{
				$sub_array[] ='$'.$row["TotalAbono"];
			}

			if(is_null($row["TotalSueldoActual"])){
				$sub_array[] = $row["TotalSueldoActual"];
			}else{
				$sub_array[] ='$'.$row["TotalSueldoActual"];
			}

			if(is_null($row["TotalSueldoNeto"])){
				$sub_array[] = $row["TotalSueldoNeto"];
			}else{
				$sub_array[] ='$'.$row["TotalSueldoNeto"];
			}
	

			$data[] = $sub_array;
		}
		
		$draw = '';
		if(isset($_POST["draw"])){
			$draw = $_POST["draw"];
		}
		
		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  $filtered_rows,
			"recordsFiltered" => self::get_total_all_records(),
			"data"    => $data
		);

		function utf8ize($d) {	//Me ayuda con los tildes/acentos
			if (is_array($d)) {
				foreach ($d as $k => $v) {
					$d[$k] = utf8ize($v);
				}
			} else if (is_string ($d)) {
				return utf8_encode($d);
			}
			return $d;
		}

		echo json_encode(utf8ize($output));
	}

public static function searchById($id,$idSucursal){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM nominasucursal WHERE idNominaSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$historialDb=$select->fetch();
		$historial = new HistorialModel ($historialDb['idNominaSucursal'],$historialDb['idSucursal'],$historialDb['NoSemana'],$historialDb['FechaInicio'],$historialDb['FechaTermino'],$historialDb['TotalSeptimoDia'], 
			$historialDb['TotalSueldoBase'],$historialDb['TotalSueldo'],$historialDb['TotalExtras'], $historialDb['TotalInfonavit'],$historialDb['TotalPrestamos'], $historialDb['TotalSaldoAnterior'], $historialDb['TotalAbono'] , $historialDb['TotalSueldoActual'] , $historialDb['TotalSueldoNeto'] , $historialDb['idEmpleadoCaptura'], $historialDb['FechaCaptura']);
		//var_dump($alumno);
		//die();
		return $historial;
	}

}
?>