<?php 

class EmpleadosModel extends CRolesModel {

	private $IdEmpleado;
	private $NombreEmpleado;
	private $ApellidoPat;
	private $Apellidomat;
	private $Sexo;
	private $CorreoElectronico;
	private $Telefono;
	private $RFC;
	private $NSS;
	private $Fecha_ingreso;
	private $IdSucursal;
	private $IdCategoriaEmpleado;
	private $SalarioDiario;
	private $PorcentajeCompensacion;
	private $IdSituacionEmpleado;
	private $es_usuario;

	function __construct($IdEmpleado, $NombreEmpleado, $ApellidoPat, $Apellidomat, $Sexo, $CorreoElectronico, $Telefono,
	$RFC, $NSS, $Fecha_ingreso, $IdSucursal, $IdCategoriaEmpleado, $SalarioDiario, $PorcentajeCompensacion, $IdSituacionEmpleado,$es_usuario){
		$this->setIdEmpleado($IdEmpleado);
		$this->setNombreEmpleado($NombreEmpleado);
		$this->setApellidoPat($ApellidoPat);
		$this->setApellidomat($Apellidomat);
		$this->setSexo($Sexo);
		$this->setCorreElctronico($CorreoElectronico);
		$this->setTelefono($Telefono);
		$this->setRFC($RFC);
		$this->setNSS($NSS);
		$this->setFecha_ingreso($Fecha_ingreso);
		$this->setIdSucursal($IdSucursal);
		$this->setIdCategoriaEmpleado($IdCategoriaEmpleado);
		$this->setSalarioDiario($SalarioDiario);
		$this->setPorcentajeCompensacion($PorcentajeCompensacion);
		$this->setIdSituacionEmpleado($IdSituacionEmpleado);
		$this->setEs_usuario($es_usuario);
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}

	public function getNombreEmpleado(){
		return $this->NombreEmpleado;
	}

	public function setNombreEmpleado($NombreEmpleado){ 
		$this->NombreEmpleado = $NombreEmpleado;
	}

	public function getApellidoPat(){
		return $this->ApellidoPat;
	}

	public function setApellidoPat($ApellidoPat){
		$this->ApellidoPat = $ApellidoPat;
	}

	public function getApellidomat(){
		return $this->Apellidomat;
	}

	public function setApellidomat($Apellidomat){
		$this->Apellidomat = $Apellidomat;
	}

	public function getSexo(){
		return $this->Sexo;
	}

	public function setSexo($Sexo){
		$this->Sexo = $Sexo;
	}

	public function getCorreoElectronico(){
		return $this->CorreoElectronico;
	}

	public function setCorreElctronico($CorreoElectronico){
		$this->CorreoElectronico = $CorreoElectronico;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getRFC(){
		return $this->RFC;
	}

	public function setRFC($RFC){
		$this->RFC = $RFC;
	}

	public function getNSS(){
		return $this->NSS;
	}

	public function setNSS($NSS){
		$this->NSS = $NSS;
	}

	public function getFecha_ingreso(){
		return $this->Fecha_ingreso;
	}

	public function setFecha_ingreso($Fecha_ingreso){
		$this->Fecha_ingreso = $Fecha_ingreso;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}

	public function getIdCategoriaEmpleado(){
		return $this->IdCategoriaEmpleado;
	}

	public function setIdCategoriaEmpleado($IdCategoriaEmpleado){
		$this->IdCategoriaEmpleado = $IdCategoriaEmpleado;
	}

	public function getSalarioDiario(){
		return $this->SalarioDiario;
	}

	public function setSalarioDiario($SalarioDiario){
		$this->SalarioDiario= $SalarioDiario;
	}

	public function getPorcentajeCompensacion(){
		return $this->PorcentajeCompensacion;
	}

	public function setPorcentajeCompensacion($PorcentajeCompensacion){
		$this->PorcentajeCompensacion = $PorcentajeCompensacion;
	}

	public function getIdSituacionEmpleado(){
		return $this->IdSituacionEmpleado;
	}

	public function setIdSituacionEmpleado($IdSituacionEmpleado){
		$this->IdSituacionEmpleado = $IdSituacionEmpleado;
	}

	public function getEs_usuario(){
		return $this->es_usuario;
	}

	public function setEs_usuario($es_usuario){
		$this->es_usuario = $es_usuario;
	}

	/*public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		if (strcmp($estado, 'on')==0) {
			$this->estado=1;
		} elseif(strcmp($estado, '1')==0) {
			$this->estado='checked';
		}elseif (strcmp($estado, '0')==0) {
			$this->estado='of';
		}else {
			$this->estado=0;
		}
	}

*/

	public static function empleadosdesuc($idsuc){
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$ouput = array();
		$select=$db->prepare('SELECT * FROM empleados WHERE idSucursal = :idSucursal AND Eliminado = 0 order by IdEmpleado');
		$select->bindValue("idSucursal",$idsuc);
			/*
			$select='';
			if(isset($_SESSION["id_role"])){
				$id_role = $_SESSION["id_role"];
				if($id_role !== '1'){ //No es adm general
					$select=$db->prepare('CALL get_empleados("",'.$_SESSION["id_sucursal"].')');
				} else if($id_role == '1') {	//Administradores: General y de sucursal
					$select=$db->prepare('CALL get_empleados("","")');
				}
			} */
		$select->execute();
		foreach($select->fetchAll() as $empleados){
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);
		}
		return $listaEmpleados;
	}


	public static function save($empleados){
		$db=DataBase::getConnect();
#		$insert=$db->prepare('INSERT INTO empleados  VALUES (null, :NombreEmpleado, :ApellidoPat, :Apellidomat, :RFC, :Fecha_ingreso, :CorreoElectronico, :IdSucursal, :IdCategoriaEmpleado, :SalarioDiario, :PorcentajeCompensacion, :IdSituacionEmpleado)');
		$insert=$db->prepare('CALL add_empleados( :NombreEmpleado, :ApellidoPat, :Apellidomat, :Sexo, :CorreoElectronico, :Telefono, :RFC, :NSS, :Fecha_ingreso, :IdSucursal, :IdCategoriaEmpleado, :SalarioDiario, :PorcentajeCompensacion, :IdSituacionEmpleado, :es_usuario)');
		#$insert->bindValue('IdEmpleado', $empleados->getIdEmpleado());
		$insert->bindValue('NombreEmpleado', $empleados->getNombreEmpleado());
		$insert->bindValue('ApellidoPat', $empleados->getApellidoPat());
		$insert->bindValue('Apellidomat', $empleados->getApellidomat());
		$insert->bindValue('Sexo', $empleados->getSexo());
		$insert->bindValue('CorreoElectronico', $empleados->getCorreoElectronico());
		$insert->bindValue('Telefono', $empleados->getTelefono());
		$insert->bindValue('RFC', $empleados->getRFC());
		$insert->bindValue('NSS', $empleados->getNSS());
		$insert->bindValue('Fecha_ingreso', $empleados->getFecha_ingreso());
		$insert->bindValue('IdSucursal', $empleados->getIdSucursal());
		$insert->bindValue('IdCategoriaEmpleado', $empleados->getIdCategoriaEmpleado());
		$insert->bindValue('SalarioDiario', $empleados->getSalarioDiario());
		$insert->bindValue('PorcentajeCompensacion', $empleados->getPorcentajeCompensacion());
		$insert->bindValue('IdSituacionEmpleado', $empleados->getIdSituacionEmpleado());
		$insert->bindValue('es_usuario', $empleados->getEs_usuario());
/*
		$insert=$db->prepare('INSERT INTO test_empleados  VALUES (null, :NombreEmpleado)');
		$insert->bindValue('NombreEmpleado', $empleados->getNombreEmpleado());	#*/
#		$insert->execute();


		//Primero vemos la disponibildad del RFC
		$current_value_1 = DataBase::check_current_value("empleados", "RFC", "IdEmpleado", $empleados->getIdEmpleado());	//el valor actual
		$check_avaliable_1 = DataBase::check_repeated_row("empleados", "RFC", $empleados->getRFC());	//que no exista

		//Despues vemos la disponibildad del CorreoElectronico
		$current_value_2 = DataBase::check_current_value("empleados", "CorreoElectronico", "IdEmpleado", $empleados->getIdEmpleado());
		$check_avaliable_2 = DataBase::check_repeated_row("empleados", "CorreoElectronico", $empleados->getCorreoElectronico());
		
				//Validar que no se repita: RFC
				if($check_avaliable_1==0){	//Disponible
					$permission_1 = 1;
				} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)
					$permission_1 = 0;
				}

				//Validar que no se repita: CorreoElectronico
				if($check_avaliable_2==0){	//Disponible
					$permission_2 = 1;
				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)
					$permission_2 = 0;
				}
				
				//Si todos los permisos estan bien, proceder el insert
				if($permission_1 == 1 && $permission_2 == 1){
					$insert->execute();
				} else if($permission_1 == 0 || $permission_2 == 0) {
					$response_array['status'] = 'error'; 
					header('Content-type: application/json');
					echo json_encode($response_array);
				}

	}
	
	//Remplazado por all_json	//	PERO SE SIGUE USANDO, POR EJ, en COMBO-BOXs
	public static function all(){
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$ouput = array();
//		$select=$db->prepare('SELECT * FROM empleados order by IdEmpleado');

$select='';
if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role !== '1'){ //No es adm general
		$select=$db->prepare('CALL get_empleados("",'.$_SESSION["id_sucursal"].')');
	} else if($id_role == '1') {	//Administradores: General y de sucursal
		$select=$db->prepare('CALL get_empleados("","")');
	}
}
		$select->execute();
		foreach($select->fetchAll() as $empleados){
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);
		}
		return $listaEmpleados;
	}

	public static function all_operativo(){		//Traer a los Empleados de tipo operativo (o Chofer)
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$ouput = array();
		//		$select=$db->prepare('SELECT * FROM empleados order by IdEmpleado');

		$select='';
		if(isset($_SESSION["id_role"]))
		{
			$id_role = $_SESSION["id_role"];
			if($id_role !== '1')
			{ //No es adm general
				$select=$db->prepare('SELECT * FROM empleados WHERE IdCategoriaEMpleado="4" AND eliminado=0 AND IdSucursal="'.$_SESSION["id_sucursal"].'"  ');
			} else if($id_role == '1') 
			{	//Administradores: General y de sucursal
				$select=$db->prepare('SELECT * FROM empleados WHERE IdCategoriaEMpleado="4" AND eliminado=0 ');
			}
		}
		$select->execute();
		foreach($select->fetchAll() as $empleados){
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);
		}
		return $listaEmpleados;
	}

public static function allEmpleadosSinInfonavit($id, $idSucursal){
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$ouput = array();

		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
		$select->bindValue('id', $id);
		$select->execute();
		foreach($select->fetchAll() as $empleados){
			//$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado']);

			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);
		}

		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado not in (SELECT IdEmpleado FROM empleadoinfonavit WHERE Liquido=0 AND Status=0) AND IdSucursal=:IdSucursal');
		$select->bindValue('IdSucursal', $idSucursal);
		$select->execute();
		foreach($select->fetchAll() as $empleados){
			//$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado']);
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);

		}
		return $listaEmpleados;
	}

	public static function allEmpleadosSinPrestamos($id, $idSucursal){
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$ouput = array();

		$select = $db->prepare('SELECT * FROM empleados WHERE IdEmpleado = :id');
		$select -> bindValue('id', $id);
		$select -> execute();
		foreach ($select->fetchAll() as $empleados) {
			//$listaEmpleados[] = new EmpleadosModel($empleados['IdEmpleado']);
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);
		}
		
		$select = $db->prepare('SELECT * FROM empleados WHERE IdEmpleado not in (SELECT IdEmpleado FROM empleadoprestamo WHERE Liquido=0 AND Status=0) AND IdSucursal=:IdSucursal');
		$select->bindValue('IdSucursal', $idSucursal);
		$select -> execute();
		foreach ($select->fetchAll() as $empleados) {
			//$listaEmpleados[] = new EmpleadosModel($empleados['IdEmpleado']);
			$listaEmpleados[]=new EmpleadosModel($empleados['IdEmpleado'],$empleados['NombreEmpleado'],$empleados['ApellidoPat'],$empleados['Apellidomat'],$empleados['Sexo'], $empleados['CorreoElectronico'],$empleados['Telefono'],
			$empleados['RFC'], $empleados['NSS'], $empleados['Fecha_ingreso'], $empleados['IdSucursal'], $empleados['IdCategoriaEmpleado'],
			$empleados['SalarioDiario'], $empleados['PorcentajeCompensacion'],$empleados['IdSituacionEmpleado'],$empleados['es_usuario']);

			
		}
		return $listaEmpleados;
	}

	public static function get_total_all_records($query_for_counter){
		/*
			$filtro_sucursal = '';
			if(isset($_GET["IdSucursal"])){
				$filtro_sucursal = $_GET["IdSucursal"];
			} else {
				$filtro_sucursal = ""; //$_SESSION["id_sucursal"];
			} */
		
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_empleados("'.$filtro_busqueda.'","'.$filtro_sucursal.'")');	//2 params vacios por Default
		$select=$db->prepare($query_for_counter);	//2 params vacios por Default
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}

	public static function all_json(){
		if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ){
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST["search"]["value"];
		} else {
			$search_filter = '';
			$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido
		}

		$db=DataBase::getConnect();
		$output = array();
/*		$query = '';
		//$query = "SELECT * FROM empleados ";
		$query .= "SELECT * FROM empleados ";
		if(isset($_POST["search"]["value"])){
			$query .= 'WHERE NombreEmpleado LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= 'OR ApellidoPat LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= 'OR Apellidomat LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$query .= 'ORDER BY IdEmpleado DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		*/
#		$query = 'select * from empleados';
#		$query = 'CALL get_empleados()';
#		$query = 'CALL get_empleados("a",1)';
#		$filtro_busqueda=$_POST["search"]["value"];	
//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		
		$filtro_sucursal = "";		
		if(isset($_GET["IdSucursal"])) 
		{ 
			                      			
			$filtro_sucursal = $_GET["IdSucursal"]; 
		} 
		else 
		{ 
			$filtro_sucursal = $_SESSION["id_sucursal"]; /*"";*/ 
		} 
		//$_SESSION["id_sucursal"];
#		$query = 'CALL get_empleados(:busqueda,:sucursal)';	
//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal

		$query = "SELECT * FROM empleados ";
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			/*
			$query .= 'WHERE NombreEmpleado LIKE "%'.$search_filter.'%" ';
			$query .= 'OR ApellidoPat LIKE "%'.$search_filter.'%" ';
			$query .= 'OR Apellidomat LIKE "%'.$search_filter.'%" ';
            if($filtro_sucursal>0){
            	$query .= 'AND IdSucursal = '.$filtro_sucursal.' ';
			}
            */
            //jlopezl
            //20200109
			//Filtro de sucursal
			if($filtro_sucursal>0){
				$query .= 'WHERE (((NombreEmpleado LIKE "%'.$search_filter.'%") ';
				$query .= 'OR (ApellidoPat LIKE "%'.$search_filter.'%") ';
				$query .= 'OR (Apellidomat LIKE "%'.$search_filter.'%")) ';
				$query .= 'AND (IdSucursal = '.$filtro_sucursal.')) ';
			}
			else //si no selecciona sucursal no se toma en cuenta 
			      //y disminuye el uso de parentesis
			{
				$query .= 'WHERE ((NombreEmpleado LIKE "%'.$search_filter.'%") ';
				$query .= 'OR (ApellidoPat LIKE "%'.$search_filter.'%") ';
				$query .= 'OR (Apellidomat LIKE "%'.$search_filter.'%")) ';	
			}

			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior

			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}
####

		$statement = $db->prepare($query);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
#		$statement->bindValue(':sucursal', $filtro_sucursal);	//Al param :busqueda se le asigna el $filtro_sucursal.
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();	//Se cierra el cursor para limpiar la sentencia y pueda ser ejecutada
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["NombreEmpleado"].' '.$row["ApellidoPat"]. ' '. $row["Apellidomat"];
			$sub_array[] = CCategoriaEmpleadoModel::getOnlyName($row["IdCategoriaEmpleado"]);
			$sub_array[] = SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = SituacionEmpleadoModel::getOnlyName($row["IdSituacionEmpleado"]);
////modificado por paulina
///referencia de la condicion en UsuariosModel
					/* Deshabilitacion de acciones Por rango de roles - Inicio */
					$hiddenByRol = '';	//No los esconde, solo los deshabilita
					if(isset($_SESSION["id_employe"])){
						if($_SESSION["id_employe"]!=$row["IdEmpleado"]){	//Auxiliar de adm de sucursal
							$hiddenByRol = 'disabled';
						}
						/*if($_SESSION["id_role"]!=2 && $row["IdRol"]==1){	//adm sucursal
							$hiddenByRol = 'disabled';
						}*/
						if($_SESSION["id_employe"]==$row["IdEmpleado"]){	//adm gral
							$hiddenByRol = '';
						}
					} /* Deshabilitacion de acciones Por rango de roles - Fin [Podras encontrar un bloque de codigo igual en el modelo del mismo modulo, metodo: all_json] */



$disabled = ''; if($_SESSION["id_employe"] == $row["IdEmpleado"]){ $disabled='disabled'; } else { $disabled = '';}

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleado"].'" '.$hiddenByRol.' class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleado"].'" '.$hiddenByRol.'  class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleado"].'"   class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleado"].'"  class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdEmpleado"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar" '.$disabled.'><i class="fa fa-trash"></i></button>';
							//<span type="button" class="button-open-modal-view" data-id-persona="'.$row["IdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Ver"><button type="button" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></button></span><span class="button-open-modal-edit" data-id-persona="'.$row["getIdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Editar"><button type="button"  class="btn btn-info btn-sm" data-toggle="modal"><i class="fa fa-edit"></i></button></span><span class="button-open-modal-delete" data-id-persona="'.$row["getIdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button"  class="btn btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash"></i></button></span>';
	}
}
			$data[] = $sub_array;
		}

		if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }

		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  self::get_total_all_records($query_for_counter), //$filtered_rows,	#Cualquiera de las 2 no marca error
			"recordsFiltered" => self::get_total_all_records($query_for_counter), //self::get_total_all_records(),
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
#		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
		$select=$db->prepare('CALL get_empleado_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$empleadosDb=$select->fetch();
		$empleado = new EmpleadosModel ($empleadosDb['IdEmpleado'],$empleadosDb['NombreEmpleado'], $empleadosDb['ApellidoPat'], $empleadosDb['Apellidomat'], $empleadosDb['Sexo'],$empleadosDb['CorreoElectronico'],$empleadosDb['Telefono'],
		$empleadosDb['RFC'], $empleadosDb['NSS'],$empleadosDb['Fecha_ingreso'],$empleadosDb['IdSucursal'],$empleadosDb['IdCategoriaEmpleado'],
		$empleadosDb['SalarioDiario'],$empleadosDb['PorcentajeCompensacion'],$empleadosDb['IdSituacionEmpleado'],$empleadosDb['es_usuario']);
		return $empleado;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
		$select=$db->prepare('CALL get_empleado_id(:id)');	//PARA PRUEBAS DE QUE ESTE FUNCIONA, INTENTAR ABRIR UN MODAL PARA AGREGAR USUARIOS
		$select->bindValue('id',$id);
		$select->execute();
		$empleado=$select->fetch();
//		$empleado = new EmpleadosModel ($empleadosDb['IdEmpleado'],$empleadosDb['NombreEmpleado'], $empleadosDb['ApellidoPat'], $empleadosDb['Apellidomat'],
//		$empleadosDb['RFC'],$empleadosDb['NSS'],$empleadosDb['Fecha_ingreso'],$empleadosDb['CorreoElectronico'],$empleadosDb['IdSucursal'],$empleadosDb['IdCategoriaEmpleado'],
//		$empleadosDb['SalarioDiario'],$empleadosDb['PorcentajeCompensacion'],$empleadosDb['IdSituacionEmpleado']);
		return $empleado['NombreEmpleado'].' '.$empleado['ApellidoPat'].' '.$empleado['Apellidomat'];
	}

	public static function update($empleados){
		
		$es_usuario = '';
		$check_es_usuario = self::check_es_usuario($empleados->getIdEmpleado());
		if($check_es_usuario == 1 ) {
			//Si ya era user, seguira siendolo
			$es_usuario = 1;
		} else if($check_es_usuario == 0) {
			$es_usuario = 0;
		}
		
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE empleados SET NombreEmpleado=:NombreEmpleado, ApellidoPat=:ApellidoPat, Apellidomat=:Apellidomat, RFC=:RFC, Fecha_ingreso=:Fecha_ingreso, CorreoElectronico=:CorreoElectronico, IdSucursal=:IdSucursal, IdCategoriaEmpleado=:IdCategoriaEmpleado, SalarioDiario=:SalarioDiario, PorcentajeCompensacion=:PorcentajeCompensacion, IdSituacionEmpleado=:IdSituacionEmpleado WHERE IdEmpleado=:IdEmpleado');
		$update=$db->prepare('CALL edit_empleados(:IdEmpleado, :NombreEmpleado, :ApellidoPat, :Apellidomat, :Sexo, :CorreoElectronico, :Telefono, :RFC, :NSS, :Fecha_ingreso, :IdSucursal, :IdCategoriaEmpleado, :SalarioDiario, :PorcentajeCompensacion, :IdSituacionEmpleado, :es_usuario)');
		$update->bindValue('NombreEmpleado', $empleados->getNombreEmpleado());
		$update->bindValue('ApellidoPat',$empleados->getApellidoPat());
		$update->bindValue('Apellidomat',$empleados->getApellidomat());
		$update->bindValue('Sexo',$empleados->getSexo());
		$update->bindValue('CorreoElectronico',$empleados->getCorreoElectronico());
		$update->bindValue('Telefono',$empleados->getTelefono());
		$update->bindValue('RFC',$empleados->getRFC());
		$update->bindValue('NSS',$empleados->getNSS());
		$update->bindValue('Fecha_ingreso',$empleados->getFecha_ingreso());
		$update->bindValue('IdSucursal',$empleados->getIdSucursal());
		$update->bindValue('IdCategoriaEmpleado',$empleados->getIdCategoriaEmpleado());
		$update->bindValue('SalarioDiario',$empleados->getSalarioDiario());
		$update->bindValue('PorcentajeCompensacion',$empleados->getPorcentajeCompensacion());
		$update->bindValue('IdSituacionEmpleado',$empleados->getIdSituacionEmpleado());
		$update->bindValue('es_usuario',$empleados->getEs_usuario());
		$update->bindValue('IdEmpleado',$empleados->getIdEmpleado());
		#$update->execute();
		//Primero vemos la disponibildad del RFC
		$current_value_1 = DataBase::check_current_value("empleados", "RFC", "IdEmpleado", $empleados->getIdEmpleado());	//el valor actual
		$check_avaliable_1 = DataBase::check_repeated_row("empleados", "RFC", $empleados->getRFC());	//que no exista

		//Despues vemos la disponibildad del CorreoElectronico
		$current_value_2 = DataBase::check_current_value("empleados", "CorreoElectronico", "IdEmpleado", $empleados->getIdEmpleado());
		$check_avaliable_2 = DataBase::check_repeated_row("empleados", "CorreoElectronico", $empleados->getCorreoElectronico());
		
				//Validar que no se repita: RFC
				if($check_avaliable_1==0){	//Disponible
					$update->execute();
				} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)
					if($current_value_1 == $empleados->getRFC()){ //Es el mismo valor que el que ya tenia anteriormente
						$update->execute();
					} else {
						$response_array['status'] = 'error'; 
						header('Content-type: application/json');
						echo json_encode($response_array);
					}
				}

				//Validar que no se repita: CorreoElectronico
				if($check_avaliable_2==0){	//Disponible
					$update->execute();
				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)
					if($current_value_2 == $empleados->getCorreoElectronico()){ //Es el mismo valor que el que ya tenia anteriormente
						$update->execute();
					} else {
						$response_array['status'] = 'error'; 
						header('Content-type: application/json');
						echo json_encode($response_array);
					}
				}
	}

	public static function delete($id){
		$db=DataBase::getConnect();
#		$delete=$db->prepare('DELETE FROM empleados WHERE IdEmpleado=:id');
		$delete=$db->prepare('CALL delete_empleado(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
	
	public static function check_es_usuario($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_empleado_id(:id)');	//comprobar si un empleado es tambien un usuario
		$select->bindValue('id',$id);
		$select->execute();
		$empleado=$select->fetch();
		return $empleado['es_usuario'];
	}
	
	public static function switch_user($id_empleado, $es_usuario){	# @params: IdEmpleado, es_usuario(0/1)
		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE empleados SET es_usuario=:es_usuario WHERE IdEmpleado=:IdEmpleado');
		$update->bindValue('es_usuario',$es_usuario);
		$update->bindValue('IdEmpleado',$id_empleado);
		$update->execute();
	}

}

?>