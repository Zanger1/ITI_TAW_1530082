<?php
class ClientesModel {
	private $IdCliente;
	private $Nombre;
	private $RFC;
	private $Calle;
	private $Colonia;
	private $CodigoPostal;
	private $Num;
	private $IdCiudad;
	private $CorreoElectronico;
	private $Telefono;
	function __construct($IdCliente, $Nombre, $RFC, $Calle,$Colonia,$CodigoPostal,$Num, $IdCiudad,$CorreoElectronico, $Telefono){
		$this->setIdCliente($IdCliente);
		$this->setNombre($Nombre);
		$this->setRFC($RFC);
		$this->setCalle($Calle);
		$this->setColonia($Colonia);
		$this->setCodigoPostal($CodigoPostal);
		$this->setNum($Num);
		$this->setIdCiudad($IdCiudad);
		$this->setCorreElctronico($CorreoElectronico);
		$this->setTelefono($Telefono);
	}
	public function getIdCliente(){
		return $this->IdCliente;
	}
	public function setIdCliente($IdCliente){
		$this->IdCliente = $IdCliente;
	}
	public function getNombre(){
		return $this->Nombre;
	}
	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}
	public function getRFC(){
		return $this->RFC;
	}
	public function setRFC($RFC){
		$this->RFC = $RFC;
	}
	public function getCalle(){
		return $this->Calle;
	}
	public function setCalle($Calle){
		$this->Calle = $Calle;
	}
	public function getColonia(){
		return $this->Colonia;
	}	
	public function setColonia($Colonia){
		$this->Colonia = $Colonia;
	}
	public function getCodigoPostal(){
		return $this->CodigoPostal;
	}
	public function setCodigoPostal($CodigoPostal){
		$this->CodigoPostal = $CodigoPostal;
	}
	public function getNum(){
		return $this->Num;
	}
	public function setNum($Num){
		$this->Num = $Num;
	}
	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad= $IdCiudad;
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
		$this->Telefono= $Telefono;
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
	public static function save($clientes){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
	#		$insert=$db->prepare('INSERT INTO clientes VALUES (NULL,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			$insert=$db->prepare('CALL add_clientes(:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			#$insert->bindValue('IdCliente',$clientes->getIdCliente());
			$insert->bindValue('Nombre',$clientes->getNombre());
			$insert->bindValue('RFC',$clientes->getRFC());
			$insert->bindValue('Calle',$clientes->getCalle());
			$insert->bindValue('Colonia',$clientes->getColonia());
			$insert->bindValue('CodigoPostal',$clientes->getCodigoPostal());
			$insert->bindValue('Num',$clientes->getNum());
			$insert->bindValue('IdCiudad',$clientes->getIdCiudad());
			$insert->bindValue('CorreoElectronico',$clientes->getCorreoElectronico());
			$insert->bindValue('Telefono',$clientes->getTelefono());
#			$insert->execute();		//Primero vemos la disponibildad del RFC		$current_value_1 = DataBase::check_current_value("clientes", "RFC", "IdCliente", $clientes->getIdCliente());	//el valor actual		$check_avaliable_1 = DataBase::check_repeated_row("clientes", "RFC", $clientes->getRFC());	//que no exista		//Despues vemos la disponibildad del CorreoElectronico		$current_value_2 = DataBase::check_current_value("clientes", "CorreoElectronico", "IdCliente", $clientes->getIdCliente());		$check_avaliable_2 = DataBase::check_repeated_row("clientes", "CorreoElectronico", $clientes->getCorreoElectronico());						//Validar que no se repita: RFC				if($check_avaliable_1==0){	//Disponible					$permission_1 = 1;				} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)					$permission_1 = 0;				}				//Validar que no se repita: CorreoElectronico				if($check_avaliable_2==0){	//Disponible					$permission_2 = 1;				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)					$permission_2 = 0;				}								//Si todos los permisos estan bien, proceder el insert				if($permission_1 == 1 && $permission_2 == 1){					$insert->execute();				} else if($permission_1 == 0 || $permission_2 == 0) {					$response_array['status'] = 'error'; 					header('Content-type: application/json');					echo json_encode($response_array);				}
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaClientes=[];
		$select=$db->query('CALL get_clientes("")');	//'CALL get_clientes("")'
		foreach($select->fetchAll() as $clientes){$listaClientes[]=new ClientesModel($clientes['IdCliente'],$clientes['Nombre'],$clientes['RFC'],$clientes['Calle'],$clientes['Colonia'], 
			$clientes['CodigoPostal'],$clientes['Num'],$clientes['IdCiudad'], $clientes['CorreoElectronico'],$clientes['Telefono'] );
		}
		return $listaClientes;
	}	public static function get_total_all_records($query_for_counter){		$db=DataBase::getConnect();		$select=$db->prepare($query_for_counter);		$select->execute();		$result = $select->fetchAll();		return $select->rowCount();	}		public static function all_json(){			//Acortar texto		function shorter($text, $chars_limit){			if (strlen($text) > $chars_limit){				$new_text = substr($text, 0, $chars_limit);				$new_text = trim($new_text);				return '<span data-toggle="tooltip" data-placement="top" title="'.$text.'">'.$new_text . "...".'</span>';			} else {				return $text;			}		}		if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ){			$row = $_POST['start'];			$rowperpage = $_POST['length'];			$search_filter = $_POST["search"]["value"];		} else {			$search_filter = '';			$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido		}		$db=DataBase::getConnect();		$output = array();#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]		#$query = "CALL get_clientes(:busqueda)";		$query = "SELECT * FROM clientes ";####		if( isset($search_filter) || isset($row) || isset($rowperpage) ){			$query .= 'WHERE  Nombre LIKE "%'.$search_filter.'%" AND eliminado=0 ';			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla			}		}####		$statement = $db->prepare($query);#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],		$statement->execute();		$result = $statement->fetchAll();		$statement->closeCursor();		$data = array();		$filtered_rows = $statement->rowCount();		foreach($result as $row){			$direccion = EstadosModel::getOnlyName(CiudadesModel::getEstadoByCiudadRef($row["IdCiudad"])).', '.CiudadesModel::getOnlyName($row["IdCiudad"]).', '.$row["CodigoPostal"].' '.$row["Colonia"].' '.$row["Calle"].' '.$row["Num"];			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }			$sub_array = array();			$sub_array[] = $row["Nombre"];			$sub_array[] = $row["Telefono"];			$sub_array[] = $row["CorreoElectronico"];//CRolesModel::getOnlyName($row["IdRol"]);			$sub_array[] = shorter($direccion,10);//SucursalesModel::getOnlyName($row["IdSucursal"]);if(isset($_SESSION["id_role"])){	$id_role = $_SESSION["id_role"];	if($id_role == '3'){ //Solo para auxiliares			$sub_array[] = '<button type="button" name="view" id="'.$row["IdCliente"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdCliente"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';	} else {	//Administradores: General y de sucursal			$sub_array[] = '<button type="button" name="view" id="'.$row["IdCliente"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdCliente"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdCliente"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';	}}			$data[] = $sub_array;		}				if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }		$output = array(			"draw"    => intval($draw),			"recordsTotal"  =>  self::get_total_all_records($query_for_counter), //$filtered_rows,	#Cualquiera de las 2 no marca error			"recordsFiltered" => self::get_total_all_records($query_for_counter), //self::get_total_all_records(),			"data"    => $data		);		function utf8ize($d) {	//Me ayuda con los tildes/acentos			if (is_array($d)) {				foreach ($d as $k => $v) {					$d[$k] = utf8ize($v);				}			} else if (is_string ($d)) {				return utf8_encode($d);			}			return $d;		}		echo json_encode(utf8ize($output));	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_cliente_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$clientesDb=$select->fetch();
		$clientes = new ClientesModel ($clientesDb['IdCliente'],$clientesDb['Nombre'],$clientesDb['RFC'],$clientesDb['Calle'],$clientesDb['Colonia'],
		$clientesDb['CodigoPostal'],$clientesDb['Num'],$clientesDb['IdCiudad'],$clientesDb['CorreoElectronico'],$clientesDb['Telefono']);
		//var_dump($alumno);
		//die();
		return $clientes;
	}	public static function load_info_for_invoice_html($id){		//este metodo es para vista previa en paso #4		$db=DataBase::getConnect();		$select=$db->prepare('CALL get_cliente_id(:id)');		$select->bindValue('id',$id);		$select->execute();		$clientesDb=$select->fetch();		#$clientesDb['IdCiudad'],$clientesDb['CodigoPostal'],$clientesDb['Colonia'],$clientesDb['Calle'],$clientesDb['Num'];		return '															<table class="table table-hover">																<tbody>																	<tr>																		<th scope="row">Clinte: </th>																		<td>'.$clientesDb['Nombre'].'</td>																	</tr>																	<tr>																		<th scope="row">Telefono:</th>																		<td>'.$clientesDb['Telefono'].'</td>																	</tr>																	<tr>																		<th scope="row">E-mail:</th>																		<td>'.$clientesDb['CorreoElectronico'].'</td>																	</tr>																</tbody>															</table>		';	}		public static function getOnlyName($id){		$db=DataBase::getConnect();#		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');		$select=$db->prepare('SELECT * FROM clientes WHERE IdCliente=:id');		$select->bindValue('id',$id);		$select->execute();		$cliente=$select->fetch();		return $cliente['Nombre'];	}	
	public static function update($clientes){
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE clientes SET Nombre=:Nombre,    RFC=:RFC, Calle=:Calle, Colonia=:Colonia, CodigoPostal=:CodigoPostal, Num=:Num, IdCiudad=:IdCiudad, CorreoElectronico=:CorreoElectronico, Telefono=:Telefono WHERE IdCliente=:IdCliente');			$update=$db->prepare('CALL edit_clientes(:IdCliente,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');			$update->bindValue('IdCliente',$clientes->getIdCliente());			$update->bindValue('Nombre',$clientes->getNombre());			$update->bindValue('RFC',$clientes->getRFC());			$update->bindValue('Calle',$clientes->getCalle());			$update->bindValue('Colonia',$clientes->getColonia());			$update->bindValue('CodigoPostal',$clientes->getCodigoPostal());			$update->bindValue('Num',$clientes->getNum());			$update->bindValue('IdCiudad',$clientes->getIdCiudad());			$update->bindValue('CorreoElectronico',$clientes->getCorreoElectronico());			$update->bindValue('Telefono',$clientes->getTelefono());			#$execute = $update->execute();		//Primero vemos la disponibildad del RFC		$current_value_1 = DataBase::check_current_value("clientes", "RFC", "IdCliente", $clientes->getIdCliente());	//el valor actual		$check_avaliable_1 = DataBase::check_repeated_row("clientes", "RFC", $clientes->getRFC());	//que no exista		//Despues vemos la disponibildad del CorreoElectronico		$current_value_2 = DataBase::check_current_value("clientes", "CorreoElectronico", "IdCliente", $clientes->getIdCliente());		$check_avaliable_2 = DataBase::check_repeated_row("clientes", "CorreoElectronico", $clientes->getCorreoElectronico());						//Validar que no se repita: RFC				if($check_avaliable_1==0){	//Disponible					$update->execute();				} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)					if($current_value_1 == $clientes->getRFC()){ //Es el mismo valor que el que ya tenia anteriormente						$update->execute();					} else {						$response_array['status'] = 'error'; 						header('Content-type: application/json');						echo json_encode($response_array);					}				}				//Validar que no se repita: CorreoElectronico				if($check_avaliable_2==0){	//Disponible					$update->execute();				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)					if($current_value_2 == $clientes->getCorreoElectronico()){ //Es el mismo valor que el que ya tenia anteriormente						$update->execute();					} else {						$response_array['status'] = 'error'; 						header('Content-type: application/json');						echo json_encode($response_array);					}				}
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('CALL delete_clientes(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>