<?php 

class SucursalServicioModel {

	private $IdSucursalServicio;
	private $IdSucursal;
	private $IdServicio;
    //jlopezl

	private  $IdTamano;
	private  $Precio;
	private  $Descripcion;
	private  $Incluye;


	/*jlopezl
	function __construct($IdSucursalServicio, $IdSucursal,$IdServicio){
		$this->setIdSucursalServicio($IdSucursalServicio);
		$this->setIdSucursal($IdSucursal);
		$this->setIdServicio($IdServicio);	
	}
	*/
	//jlopezl
	function __construct($IdSucursalServicio, $IdSucursal, $IdServicio, $IdTamano, $Precio, $Descripcion,  $Incluye){
		$this->setIdSucursalServicio($IdSucursalServicio);
		$this->setIdSucursal($IdSucursal);
		$this->setIdServicio($IdServicio);	
		
		$this->setIdTamano($IdTamano);	
		$this->setPrecio($Precio);	
		$this->setDescripcion($Descripcion);	
		$this->setIncluye($Incluye);	
	}

	public function getIdSucursalServicio(){
		return $this->IdSucursalServicio;
	}

	public function setIdSucursalServicio($IdSucursalServicio){
		$this->IdSucursalServicio = $IdSucursalServicio;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}
	
	public function setIdSucursal($IdSucursal){ 
		$this->IdSucursal = $IdSucursal;
	}

	public function getIdServicio(){
		return $this->IdServicio;
	}

	public function setIdServicio($IdServicio){
		$this->IdServicio = $IdServicio;
	}


   //jlopezl
	public function getIdTamano(){
		return $this->IdTamano;
	}

	public function setIdTamano($IdTamano){
		$this->IdTamano = $IdTamano;
	}


	public function getPrecio(){
		return $this->Precio;
	}

	public function setPrecio($Precio){
		$this->Precio = $Precio;
	}



	public function getDescripcion(){
		return $this->Descripcion;
	}

	public function setDescripcion($Descripcion){
		$this->Descripcion = $Descripcion;
	}


	public function getIncluye(){
		return $this->Incluye;
	}

	public function setIncluye($Incluye){
		$this->Incluye = $Incluye;
	}


	public static function save($sucursal){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO sucursal_servicio VALUES (NULL,:IdSucursal,:IdServicio,:IdTamano, :precio, :descripcion, :incluye,0)');
		#$insert->bindValue('IdSucursalServicio',$sucursal->getIdSucursalServicio());
		$insert->bindValue('IdSucursal',$sucursal->getIdSucursal());
		$insert->bindValue('IdServicio',$sucursal->getIdServicio());
		$insert->bindValue('IdTamano',$sucursal->getIdTamano());
		$insert->bindValue('precio',$sucursal->getPrecio());
		$insert->bindValue('descripcion',$sucursal->getDescripcion());
		$insert->bindValue('incluye',$sucursal->getIncluye());
		$insert->execute();
	}


	public static function all(){
		$db=DataBase::getConnect();
		$listaSucursaleS=[];
		$select=$db->query('SELECT * FROM sucursal_servicio order by IdSucursalServicio');
		foreach($select->fetchAll() as $sucursal){
			$listaSucursalS[]=new SucursalServicioModel($sucursal['IdSucursalServicio'],$sucursal['IdSucursal'],$sucursal['IdServicio']);
		}
		return $listaSucursalS;
	}

	public static function get_total_all_records($query_for_counter){
		if(isset($_SESSION["id_sucursal"])){
			$db=DataBase::getConnect();
	/*		$filtro_sucursal = '';
			if(isset($_GET["IdSucursal"])){
				$filtro_sucursal = $_GET["IdSucursal"];
			} else {
				$filtro_sucursal = $_SESSION["id_sucursal"];
			} */
	#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades');	//2 params vacios por Default
			$select=$db->prepare($query_for_counter);	#'CALL get_inventarios("","'.$filtro_sucursal.'")' 	//2 params vacios por Default
			$select->execute();
			$result = $select->fetchAll();
			return $select->rowCount();
		}
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
#		if(isset($_POST['search'])){
		#$filtro_busqueda=$_POST["search"]["value"];	} else { $filtro_busqueda=''; } //El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
#		$filtro_sucursal = "";	//Ya no va a estar vacio ...SERA = session id_sucursal
		if(isset($_GET["IdSucursal"])) { $filtro_sucursal = $_GET["IdSucursal"]; } else if (isset($_SESSION["id_sucursal"])){ $filtro_sucursal = $_SESSION["id_sucursal"]; }
		#$query = 'CALL get_inventarios(:busqueda,:sucursal)';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
		#$query = 'CALL get_inventarios(:busqueda,:sucursal)';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
        
        //jlopezl
		/*
		$query = 'SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades  '; 
*/

       $query = 'SELECT * FROM sucursal_servicio AS SC INNER JOIN  c_servicios AS S 
ON SC.IdServicio = S.IdServicio INNER JOIN tamano_servicios AS TS ON SC.IdTamano=TS.id AND SC.IdSucursal="'.$_SESSION["id_sucursal"].'"';


		//AND inventario.IdSucursal="'.$_SESSION["id_sucursal"].'"';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			$query .= 'AND S.NombreServicio LIKE "%'.$search_filter.'%" AND SC.eliminado=0 ';

			if($filtro_sucursal>0){
				$query .= ' AND IdSucursal = "'.$filtro_sucursal.'" ';	//Filtro de sucursal + archivo para determinar si se trata de la lista de cotizaciones u ordenes 
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
#		$statement->closeCursor();	//Se cierra el cursor para limpiar la sentencia y pueda ser ejecutada
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			
			//Se ha recuperado ?
/*			$no_rentado = '';
			$recuperado = OrdenRentasModel::NoRecuperado($row["IdInventarioUnidadesRenta"]);
			if($recuperado == 0){
				# Sigue rentado 
				$no_rentado = $row["cantidad"] - $recuperado;
			} else if($recuperado == 1) { 
				# se ha devuelto al inventario 
				$no_rentado =
			} */
			
			#Opcion 1 de antes: //Se usaba antes para cotizar y "separar" la cantidad, disminuyendo el stock del inventario, este solo hace un calulo, no interviene. NO BORRAR
			//jlopezl
			//$NoRecuperado =  VentasModel::NoRecuperado($row["IdInventarioUnidadesRenta"]);
			
			#Opcion 2. //Actualmente se usa este. te dice si el inventario 
			//jlopezl
			//$Cotizado = VentasModel::Cotizado($row["IdInventarioUnidadesRenta"]);
			//$total_no_disponible = $Cotizado;	//Se ha seleccionado la opcion 2 " $Cotizado " pero, NO BORRAR la opcion 1 " $NoRecuperado "

			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["NombreServicio"].' '.$row["nombre"];
			$sub_array[] = SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = "$ ".$row["precio"];
			$sub_array[] = $row["incluye"];
			//$sub_array[] = $row["cantidad"]; //- $total_no_disponible;
         /*
         jlopezl
		if($total_no_disponible>0){
			$sub_array[] = '<button type="button" name="track" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-success btn-sm track" data-toggle="tooltip" data-placement="top" title="Mostrar ubicacions">'.$total_no_disponible.'</button>'; //Envia el ID del innvenario,
		} else if($total_no_disponible==0) {
			$sub_array[] = $total_no_disponible; //Envia el ID del innvenario,
		}
		*/
			//jlopezl
			//$sub_array[] = $row["cantidad"] + $total_no_disponible;	//este era el total que indicaba el inventario + el disponible que se calculaba si el carrito decia que no se ha recupeado

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdSucursalServicio"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdSucursalServicio"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdSucursalServicio"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdSucursalServicio"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdSucursalServicio"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
	}
}
			$data[] = $sub_array;

		}

		if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }
		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  self::get_total_all_records($query_for_counter), //$filtered_rows,
			"recordsFiltered" => self::get_total_all_records($query_for_counter),
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
		$select=$db->prepare('SELECT * FROM sucursal_servicio WHERE IdSucursalServicio=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalDb=$select->fetch();
		/*
		jlopezl
		$sucursalS = new SucursalServicioModel ($sucursalDb['IdSucursalServicio'],$sucursalDb['IdSucursal'], $sucursalDb['IdServicio']);
        */
	
		/*
	function __construct($IdSucursalServicio, 
		$IdSucursal,$IdServicio, 
		$IdTamano, $Precio, $Descripcion,  $Incluye){
			*/

	  //jlopezl
	  $sucursalS = new SucursalServicioModel ($sucursalDb['IdSucursalServicio'], 
	  	$sucursalDb['IdSucursal'], 
	  	$sucursalDb['IdServicio'],
  		$sucursalDb['IdTamano'],
        $sucursalDb['precio'],
        $sucursalDb['descripcion'],
        $sucursalDb['incluye']        
	  );

		//var_dump($alumno);
		//die();
		return $sucursalS;
	}

	public static function update($sucursal){
		$db=DataBase::getConnect();
		//$update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
/*
		$update=$db->prepare('INSERT INTO sucursal_servicio VALUES (NULL,:IdSucursal,:IdServicio,:IdTamano, :precio, :descripcion, :incluye,0)');
*/

		$update=$db->prepare('UPDATE sucursal_servicio SET IdSucursal=:IdSucursal,
		 IdServicio=:IdServicio,
		 IdTamano=:IdTamano,
		 precio=:precio,
		 descripcion=:descripcion,
		 incluye=:incluye WHERE IdSucursalServicio=:IdSucursalServicio');

		$update->bindValue('IdSucursal',$sucursal->getIdSucursal());
		$update->bindValue('IdServicio',$sucursal->getIdServicio());
		$update->bindValue('IdTamano',$sucursal->getIdTamano());
		$update->bindValue('precio',$sucursal->getPrecio());
		$update->bindValue('descripcion',$sucursal->getDescripcion());
		$update->bindValue('incluye',$sucursal->getIncluye());
		$update->bindValue('IdSucursalServicio',$sucursal->getIdSucursalServicio());
		$update->execute();
	}







	public static function delete($id){
		$db=DataBase::getConnect();
		#$delete=$db->prepare('DELETE  FROM sucursal_servicio WHERE IdEmpleado=:id');
		#$delete->bindValue('id',$id);
		#$delete->execute();
		$delete=$db->prepare('UPDATE sucursal_servicio SET eliminado=:eliminado WHERE IdSucursalServicio=:IdSucursalServicio');

		$delete->bindValue('eliminado',1);
		$delete->bindValue('IdSucursalServicio',$id);
		$delete->execute();
	}


	public static function getOnlyBasicInfoForInvoice_line1($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('CALL get_servicios_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$inventarioDb=$select->fetch();
		return $inventarioDb['NombreServicio'].', '.$inventarioDb['nombre'].', '.$inventarioDb['descripcion'];	//nombre, tamano, descripcion
	}

	public static function getOnlyBasicInfoForInvoice_line2($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('CALL get_servicios_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$inventarioDb=$select->fetch();
		return $inventarioDb['incluye'];
	}

}
?>