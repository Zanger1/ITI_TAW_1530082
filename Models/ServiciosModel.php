<?php 

class ServiciosModel {

	private $IdServicio;
	private $NombreServicio;

	function __construct($IdServicio, $NombreServicio){
		$this->setIdServicio($IdServicio);
		$this->setNombreServicio($NombreServicio);
	}

	public function getIdServicio(){
		return $this->IdServicio;
	}

	public function setIdServicio($IdServicio){
		$this->IdServicio = $IdServicio;
	}

	public function getNombreServicio(){
		return $this->NombreServicio;
	}

	public function setNombreServicio($NombreServicio){
		$this->NombreServicio = $NombreServicio;
	}


	
/* jlopez lo comento y remplazo por la siguiene funcion save

	public static function save($unidad){
		$db=DataBase::getConnect();
		$insert=$db->prepare('CALL add_usuarios(:IdEmpleado, :usuario, :contrasena, :IdRol, :IdSucursal, :estatus)');
		$insert->bindValue('IdEmpleado',$admin->getIdEmpleado());
		$insert->bindValue('usuario',$admin->getUsuario());
		$insert->execute();
		
		//Un empleado se vuelve user
		EmpleadosModel::switch_user($admin->getIdEmpleado(),1);
	}
*/


//jlopezl
	public static function save($servicio){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();

	#		$insert=$db->prepare('INSERT INTO clientes VALUES (NULL,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			
		$insert=$db->prepare('INSERT INTO c_servicios VALUES (NULL, :NombreServicio, 0)');
			#$insert=$db->prepare('CALL add_clientes(:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			
			#$insert->bindValue('IdCliente',$clientes->getIdCliente());
		$insert->bindValue('NombreServicio',$servicio->getNombreServicio());
		$insert->execute();
			/*$insert->bindValue('RFC',$clientes->getRFC());
			$insert->bindValue('Calle',$clientes->getCalle());
			$insert->bindValue('Colonia',$clientes->getColonia());
			$insert->bindValue('CodigoPostal',$clientes->getCodigoPostal());
			$insert->bindValue('Num',$clientes->getNum());
			$insert->bindValue('IdCiudad',$clientes->getIdCiudad());
			$insert->bindValue('CorreoElectronico',$clientes->getCorreoElectronico());
			$insert->bindValue('Telefono',$clientes->getTelefono());
			*/
#			$insert->execute();

		//Primero vemos la disponibildad del RFC
		//$current_value_1 = DataBase::check_current_value("unidades_renta", "DesUnidadRenta", "IdCliente", $unidad->getDesUnidad());	//el valor actual
		//$check_avaliable_1 = DataBase::check_repeated_row("unidades_renta", "DesUnidadRenta", $unidad->getDesUnidad());	//que no exista

		//Despues vemos la disponibildad del CorreoElectronico
		
		/*
		$current_value_2 = DataBase::check_current_value("clientes", "CorreoElectronico", "IdCliente", $clientes->getIdCliente());
		$check_avaliable_2 = DataBase::check_repeated_row("clientes", "CorreoElectronico", $clientes->getCorreoElectronico());*/
		
				//Validar que no se repita: RFC
		/*if($check_avaliable_1==0){	//Disponible
			$permission_1 = 1;
		} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)
			$permission_1 = 0;
		}*/

				//Validar que no se repita: CorreoElectronico
				/*
				if($check_avaliable_2==0){	//Disponible
					$permission_2 = 1;
				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)
					$permission_2 = 0;
				}
				*/
				
				//Si todos los permisos estan bien, proceder el insert
				//if($permission_1 == 1 && $permission_2 == 1){
		/*if($permission_1 == 1){
			$insert->execute();
			//} else if($permission_1 == 0 || $permission_2 == 0) {
		} else if($permission_1 == 0) {
			$response_array['status'] = 'error'; 
			header('Content-type: application/json');
			echo json_encode($response_array);
			}*/
	}
	//hasta aqui jlopezl  public static function save($unidad)


  //jlopez actualizo la funcion
	public static function all(){
		$db=DataBase::getConnect();
		$lista=[];
		//jlopezl actualizo la sig linea
		//$select=$db->query('SELECT * FROM unidades_renta');
		$select=$db->query('CALL get_servicios("")');
		foreach($select->fetchAll() as $item){			
			$lista[]=new ServiciosModel($item['IdServicio'],$item['NombreServicio']);
		}
		return $lista;
	}


//jlopezl remplazo la funcion
	/*
	public static function get_total_all_records(){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_usuarios("","")');
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}
*/

   public static function get_total_all_records($query_for_counter){
		$db=DataBase::getConnect();
		$select=$db->prepare($query_for_counter);
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}



//jlopezl remplazo la funcion all_json() por esta

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
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		#$query = "CALL get_clientes(:busqueda)";
		$query = "SELECT * FROM c_servicios ";
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			$query .= 'WHERE  NombreServicio LIKE "%'.$search_filter.'%" AND eliminado=0 ';

			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior

			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}
####


		$statement = $db->prepare($query);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$data = array();
		$filtered_rows = $statement->rowCount();


		foreach($result as $row){
			/* jlopezl  cancele esto que no se ocupa
			$direccion = EstadosModel::getOnlyName(CiudadesModel::getEstadoByCiudadRef($row["IdCiudad"])).', '.CiudadesModel::getOnlyName($row["IdCiudad"]).', '.$row["CodigoPostal"].' '.$row["Colonia"].' '.$row["Calle"].' '.$row["Num"];
            */

			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
			//jlopezl cancele tbn esta de imagen que ya no se ocupa
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["NombreServicio"];
			$sub_array[] = null;
			$sub_array[] = null;
			$sub_array[] = null;

			/* jlopezl cancelo
			$sub_array[] = $row["Telefono"];
			$sub_array[] = $row["CorreoElectronico"];//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = shorter($direccion,10);  *///SucursalesModel::getOnlyName($row["IdSucursal"]);

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdServicio"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdServicio"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdServicio"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdServicio"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdServicio"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
//remplazada hasta qui




//jlopezl remplaza la func por la siguiente
	/*
	public static function searchById($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM usuarios WHERE IdUsuario=:id');
		$select=$db->prepare('CALL get_usuario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		return $adminDataBase['IdUsuario'];
	}
*/

public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_servicio_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$serviciosDb=$select->fetch();
		$servicio = new ServiciosModel ($serviciosDb['IdServicio'],$serviciosDb['NombreServicio']);
		return $servicio;
	}


	public static function getOnlyName($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
		$select=$db->prepare('SELECT * FROM c_servicios WHERE c_servicios=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$servicio=$select->fetch();
		return $servicio['NombreServicio'];
	}



//jlopezl 
	public static function update($servicio){
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE clientes SET Nombre=:Nombre,    RFC=:RFC, Calle=:Calle, Colonia=:Colonia, CodigoPostal=:CodigoPostal, Num=:Num, IdCiudad=:IdCiudad, CorreoElectronico=:CorreoElectronico, Telefono=:Telefono WHERE IdCliente=:IdCliente');

			$update=$db->prepare('CALL edit_servicio(:IdServicio,:NombreServicio)');
			$update->bindValue('IdServicio',$servicio->getIdServicio());
			$update->bindValue('NombreServicio',$servicio->getNombreServicio());
			$update->execute();

		//Primero vemos la disponibildad del DesUnidad
		/*$current_value_1 = DataBase::check_current_value("unidades_renta", "DesUnidad", "IdUnidadRenta", $unidades->getIdCliente());	//el valor actual
		$check_avaliable_1 = DataBase::check_repeated_row("unidades_renta", "DesUnidad", $unidades->getIdUnidadRenta());	
*/
		//que no exista

				//Validar que no se repita: RFC
				/*
				if($check_avaliable_1==0){	//Disponible
					$update->execute();
				} else if($check_avaliable_1 == 1){	//NO Disponible (Alguien mas ya lo registro)
					if($current_value_1 == $unidades->getIdUnidadRenta()){ //Es el mismo valor que el que ya tenia anteriormente
						$update->execute();
					} else {
						$response_array['status'] = 'error'; 
						header('Content-type: application/json');
						echo json_encode($response_array);
					}
				}
/**/
				//Validar que no se repita: CorreoElectronico
/*
				if($check_avaliable_2==0){	//Disponible
					$update->execute();
				} else if($check_avaliable_2 == 1){	//NO Disponible (Alguien mas ya lo registro)
					if($current_value_2 == $clientes->getCorreoElectronico()){ //Es el mismo valor que el que ya tenia anteriormente
						$update->execute();
					} else {
						$response_array['status'] = 'error'; 
						header('Content-type: application/json');
						echo json_encode($response_array);
					}
				}
				*/

	}

	public static function delete($IdServicio){
		$db=DataBase::getConnect();
		$delete=$db->prepare('CALL delete_servicio(:IdServicio)');
		$delete->bindValue('IdServicio',$IdServicio);
		$delete->execute();
	}
}
?>