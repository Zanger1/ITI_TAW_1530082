<?php

class NominaModel{
	private $idDetalleNominaSucursal;
	private $idNominaSucursal;
	private $idEmpleado;
	private $idCategoriaEmpleado;
	private $NoDiasTrabajados;
	private $SeptimoDia;
	private $SueldoBase;
	private $Sueldo;
	private $TotalExtras;
	private $Infonavit;
	private $Prestamo;
	private $SaldoAnterior;
	private $Abono;
	private $SueldoActual;
	private $SueldoNeto;
	private $Comentarios;

	function __construct($idDetalleNominaSucursal, $idNominaSucursal, $idEmpleado, $idCategoriaEmpleado, $NoDiasTrabajados, $SeptimoDia,$SueldoBase, $Sueldo, $TotalExtras, $Infonavit, $Prestamo, $SaldoAnterior, $Abono, $SueldoActual, $SueldoNeto, $Comentarios){
		$this->setidDetalleNominaSucursal($idDetalleNominaSucursal);
		$this->setidNominaSucursal($idNominaSucursal);
		$this->setidEmpleado($idEmpleado);
		$this->setidCategoriaEmpleado($idCategoriaEmpleado);
		$this->setNoDiasTrabajados($NoDiasTrabajados);
		$this->setSeptimoDia($SeptimoDia);
		$this->setSueldoBase($SueldoBase);
		$this->setSueldo($Sueldo);
		$this->setTotalExtras($TotalExtras);
		$this->setInfonavit($Infonavit);
		$this->setPrestamo($Prestamo);
		$this->setSaldoAnterior($SaldoAnterior);
		$this->setAbono($Abono);
		$this->setSueldoActual($SueldoActual);
		$this->setSueldoNeto($SueldoNeto);
		$this->setComentarios($Comentarios);
	}

	public function getidDetalleNominaSucursal(){
		return $this->idDetalleNominaSucursal;
	}
	public function setidDetalleNominaSucursal($idDetalleNominaSucursal){
		$this->idDetalleNominaSucursal=$idDetalleNominaSucursal;
	}
    

	public function getidNominaSucursal(){
		return $this->idNominaSucursal;
	}
	public function setidNominaSucursal($idNominaSucursal){
		$this->idNominaSucursal=$idNominaSucursal;
	}


	public function getidEmpleado(){	
		return $this->idEmpleado;
	}
	public function setidEmpleado($idEmpleado){
		$this->idEmpleado=$idEmpleado;
	}


	public function getidCategoriaEmpleado(){
		return $this->idCategoriaEmpleado;		
	}
	public function setidCategoriaEmpleado($idCategoriaEmpleado){
		$this->idCategoriaEmpleado=$idCategoriaEmpleado;
	}


	public function getNoDiasTrabajados(){
		return $this->NoDiasTrabajados;
	}
	public function setNoDiasTrabajados($NoDiasTrabajados){
		$this->NoDiasTrabajados=$NoDiasTrabajados;
	}


	public function getSeptimoDia(){
		return $this->SeptimoDia;
	}
	public function setSeptimoDia($SeptimoDia){
		$this->SeptimoDia=$SeptimoDia;
	}


	public function getSueldoBase(){
		return $this->SueldoBase;	
	}
	public function setSueldoBase($SueldoBase){
		$this->SueldoBase=$SueldoBase;
	}


	public function getSueldo(){
		return $this->Sueldo;		
	}
	public function setSueldo($Sueldo){
		$this->Sueldo=$Sueldo;
	}



	public function getTotalExtras(){
		return $this->TotalExtras;
	}
	public function setTotalExtras($TotalExtras){
		$this->TotalExtras=$TotalExtras;
	}



	public function getInfonavit(){
		return $this->Infonavit;
	}
	public function setInfonavit($Infonavit){
		$this->Infonavit=$Infonavit;
	}



	public function getPrestamo(){
		return $this->Prestamo;		
	}
	public function setPrestamo($Prestamo){
		$this->Prestamo=$Prestamo;
	}


	public function getSaldoAnterior(){
		return $this->SaldoAnterior;
	}
	public function setSaldoAnterior($SaldoAnterior){
		$this->SaldoAnterior=$SaldoAnterior;
	}


	public function getAbono(){
		return $this->Abono;
	}
	public function setAbono($Abono){
		$this->Abono=$Abono;
	}


    public function getSueldoActual(){
		return $this->SueldoActual;
	}
	public function setSueldoActual($SueldoActual){
		$this->SueldoActual=$SueldoActual;
	}


	public function getSueldoNeto(){
		return $this->SueldoNeto;
	}
	public function setSueldoNeto($SueldoNeto){
		$this->SueldoNeto=$SueldoNeto;
	}



	public function getComentarios(){
		return $this->Comentarios;
	}
	public function setComentarios($Comentarios){
		$this->Comentarios=$Comentarios;
	}

 	public function getNombreEmpleado($idEmpleado){
 		$db=DataBase::getConnect();
 		$empleado=$db->prepare('SELECT CONCAT(NombreEmpleado, " ", ApellidoPat, " ", Apellidomat) NombreCompleto FROM empleados WHERE IdEmpleado=:idEmp');
 		$empleado->bindValue('idEmp',$idEmpleado);
 		$empleado->execute();
 		$result = $empleado->fetch();
 		return $result ['NombreCompleto'];

 	}

 	public function getPuesto($idCategoriaEmpleado){
 		$db=DataBase::getConnect();
 		$empleado=$db->prepare('SELECT DesCategoriaEmpleado FROM c_categoria_empleado WHERE idCategoriaEmpleado=:idCategoria');	//Nombre
 		$empleado->bindValue('idCategoria',$idCategoriaEmpleado);
 		$empleado->execute();
 		$result = $empleado->fetch();
 		return $result ['DesCategoriaEmpleado'];

 	}

//VALIDAR FECHAL, VALIDAR DÍAS(0 A 6), 
	public static function save($Nomina){
		$db=DataBase::getConnect();

			$insert=$db->prepare('INSERT INTO detallenominasucursal VALUES (idDetalleNominaSucursal,:idNominaSucursal,:idEmpleado,:idCategoriaEmpleado,:NoDiasTrabajados,:SeptimoDia,:SueldoBase,:Sueldo,:TotalExtras,:Infonavit,:Prestamo,:SaldoAnterior,:Abono,:SueldoActual,:SueldoNeto,:Comentarios)');

     	$insert->bindValue('idDetalleNominaSucursal', $Nomina ->getidDetalleNominaSucursal());
     	$insert->bindValue('idNominaSucursal', $Nomina ->getidNominaSucursal());
     	$insert->bindValue('idEmpleado', $Nomina ->getidEmpleado());
     	$insert->bindValue('idCategoriaEmpleado', $Nomina ->getidCategoriaEmpleado());
     	$insert->bindValue('NoDiasTrabajados', $Nomina ->getNoDiasTrabajados());
     	$insert->bindValue('SeptimoDia', $Nomina ->getSeptimoDia());
     	$insert->bindValue('SueldoBase', $Nomina ->getSueldoBase());
     	$insert->bindValue('Sueldo', $Nomina ->getSueldo());
     	$insert->bindValue('TotalExtras', $Nomina ->getTotalExtras());
     	$insert->bindValue('Infonavit', $Nomina ->getInfonavit());
     	$insert->bindValue('Prestamo', $Nomina ->getPrestamo());
     	$insert->bindValue('SaldoAnterior', $Nomina ->getSaldoAnterior());
     	$insert->bindValue('Abono', $Nomina ->getAbono());
     	$insert->bindValue('SueldoActual', $Nomina ->getSueldoActual());
     	$insert->bindValue('SueldoNeto', $Nomina ->getSueldoNeto());
     	$insert->bindValue('Comentarios', $Nomina ->getComentarios());

     	$insert->execute();

	}
   
public static function get_total_all_records(){
		$db=DataBase::getConnect();
		//$select=$db->prepare('CALL get_clientes("")');
		$select=$db->prepare('SELECT * FROM detallenominasucursal');
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
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		$query = "select * from detallenominasucursal";
		$statement = $db->prepare($query);
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
			$sub_array[] = $row["idDetalleNominaSucursal"];
			//$sub_array[] = $row["idEmpleado"];
			$sub_array[] = self::getNombreEmpleado($row['idEmpleado']);
			$sub_array[] = self::getPuesto($row['idCategoriaEmpleado']);;//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = $row["NoDiasTrabajados"];
			$sub_array[] = $row["SeptimoDia"];
			$sub_array[] = $row["SueldoBase"];
			$sub_array[] = $row["Sueldo"];
			$sub_array[] = $row["TotalExtras"];
			$sub_array[] = $row["Infonavit"];
			$sub_array[] = $row["Prestamo"];
			$sub_array[] = $row["SaldoAnterior"];
			$sub_array[] = $row["Abono"];
			$sub_array[] = $row["SueldoActual"];
			$sub_array[] = $row["SueldoNeto"];
			$sub_array[] = $row["Comentarios"];
			
			//$sub_array[] = shorter($row['Calle'], 10);//SucursalesModel::getOnlyName($row["IdSucursal"]);
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
								$sub_array[] = '<button type="button" name="view" id="'.$row["idDetalleNominaSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idDetalleNominaSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
						} else {	//Administradores: General y de sucursal
								$sub_array[] = '<button type="button" name="view" id="'.$row["idDetalleNominaSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idDetalleNominaSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["idDetalleNominaSucursal"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
						}
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

public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM detallenominasucursal WHERE idDetalleNominaSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$NominaDb=$select->fetch();
		$Nomina = new NominaModel ($NominaDb['idDetalleNominaSucursal'],$NominaDb['idNominaSucursal'],$NominaDb['idEmpleado'],$NominaDb['idCategoriaEmpleado'],$NominaDb['NoDiasTrabajados'],$NominaDb['SeptimoDia'], 
			$NominaDb['SueldoBase'],$NominaDb['Sueldo'],$NominaDb['TotalExtras'], $NominaDb['Infonavit'],$NominaDb['Prestamo'], $NominaDb['SaldoAnterior'], $NominaDb['Abono'] , $NominaDb['SueldoActual'] , $NominaDb['SueldoNeto'],$NominaDb['Comentarios']);
		//var_dump($alumno);
		//die();
		return $Nomina;
	}



	public static function update($Nomina){
		$db=DataBase::getConnect();

			$update=$db->prepare('UPDATE detallenominasucursal SET /*idNominaSucursal = :idNominaSucursal,idEmpleado = :idEmpleado,idCategoriaEmpleado = :idCategoriaEmpleado,*/NoDiasTrabajados = :NoDiasTrabajados,/*SeptimoDia=:SeptimoDia,SueldoBase = :SueldoBase,Sueldo = :Sueldo,TotalExtras = :TotalExtras,Infonavit =:Infonavit,Prestamo = :Prestamo,SaldoAnterior = :SaldoAnterior,*/Abono = :Abono/*,SueldoActual = :SueldoActual,SueldoNeto = :SueldoNeto*/, Comentarios = :Comentarios WHERE idDetalleNominaSucursal = :idDetalleNominaSucursal');

     	$update->bindValue('idDetalleNominaSucursal', $Nomina ->getidDetalleNominaSucursal());
     	/*$update->bindValue('idNominaSucursal', $Nomina ->getidNominaSucursal());
     	$update->bindValue('idEmpleado', $Nomina ->getidEmpleado());
     	$update->bindValue('idCategoriaEmpleado', $Nomina ->getidCategoriaEmpleado());*/
     	$update->bindValue('NoDiasTrabajados', $Nomina ->getNoDiasTrabajados());
     	/*$update->bindValue('SeptimoDia', $Nomina ->getSeptimoDia());
     	$update->bindValue('SueldoBase', $Nomina ->getSueldoBase());
     	$update->bindValue('Sueldo', $Nomina ->getSueldo());
     	$update->bindValue('TotalExtras', $Nomina ->getTotalExtras());
     	$update->bindValue('Infonavit', $Nomina ->getInfonavit());
     	$update->bindValue('Prestamo', $Nomina ->getPrestamo());
     	$update->bindValue('SaldoAnterior', $Nomina ->getSaldoAnterior());*/
     	$update->bindValue('Abono', $Nomina ->getAbono());
     	/*$update->bindValue('SueldoActual', $Nomina ->getSueldoActual());
     	$update->bindValue('SueldoNeto', $Nomina ->getSueldoNeto());*/
     	$update->bindValue('Comentarios', $Nomina ->getComentarios());
     	
     	$update->execute();

	

	}

	public static function delete($id){
		$db=DataBase::getConnect();
		//$delete=$db->prepare('CALL delete_clientes(:id)');
		$delete=$db->prepare('DELETE FROM detallenominasucursal WHERE idDetalleNominaSucursal=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}


	}


?>