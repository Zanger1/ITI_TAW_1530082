<?php 

class InventarioModel {

	private $IdInventarioUnidadesRenta;
	private $Precio;
	private $Descripcion;
	private $Incluye;
	private $Cantidad;
	private $IdUnidadRenta;
	private $IdSucursal;
	private $IdTipoUnidades;
	private $foto;
	
	function __construct($IdInventarioUnidadesRenta, $Precio, $Descripcion, $Incluye, $Cantidad, $IdUnidadRenta, $IdSucursal, $IdTipoUnidades, $foto){
		$this->setIdInventarioUnidadesRenta($IdInventarioUnidadesRenta);
		$this->setPrecio($Precio);
		$this->setDescripcion($Descripcion);
		$this->setIncluye($Incluye);
		$this->setCantidad($Cantidad);
		$this->setIdUnidadRenta($IdUnidadRenta);
		$this->setIdSucursal($IdSucursal);
		$this->setIdTipoUnidades($IdTipoUnidades);
		$this->setFoto($foto);
	}

	public function getIdInventarioUnidadesRenta(){
		return $this->IdInventarioUnidadesRenta;
	}

	public function setIdInventarioUnidadesRenta($IdInventarioUnidadesRenta){
		$this->IdInventarioUnidadesRenta = $IdInventarioUnidadesRenta;
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

	public function getCantidad(){
		return $this->Cantidad;
	}

	public function setCantidad($Cantidad){
		$this->Cantidad = $Cantidad;
	}

	public function getIdUnidadRenta(){
		return $this->IdUnidadRenta;
	}

	public function setIdUnidadRenta($IdUnidadRenta){
		$this->IdUnidadRenta = $IdUnidadRenta;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}

	public function getIdTipoUnidades(){
		return $this->IdTipoUnidades;
	}

	public function setIdTipoUnidades($IdTipoUnidades){
		$this->IdTipoUnidades = $IdTipoUnidades;
	}

	public function getFoto(){
		return $this->foto;
	}

	public function setFoto($foto){
		$this->foto = $foto;
	}

	public static function save($inventario){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO inventario_unidades_renta VALUES (NULL,:Precio,:Descripcion,:Incluye,:cantidad,:IdUnidadRenta,:IdSucursal,:IdTipoUnidades,:foto,0)');
		//$insert->bindValue('IdInventarioUnidadesRenta',$inventario->getIdInventarioUnidadesRenta());
		$insert->bindValue('Precio',$inventario->getPrecio());
		$insert->bindValue('Descripcion',$inventario->getDescripcion());
		$insert->bindValue('Incluye',$inventario->getIncluye());
		$insert->bindValue('cantidad',$inventario->getCantidad());
		$insert->bindValue('IdUnidadRenta',$inventario->getIdUnidadRenta());
		$insert->bindValue('IdSucursal',$inventario->getIdSucursal());
		$insert->bindValue('IdTipoUnidades',$inventario->getIdTipoUnidades());
		$insert->bindValue('foto',$inventario->getFoto());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaEmpleados=[];
		$select=$db->query('SELECT * FROM inventario_unidades_renta order by IdInventarioUnidadesRenta');
#		$select=$db->query('CALL get_inventarios("","")');
		foreach($select->fetchAll() as $inventario){
			$listaEmpleados[]=new InventarioModel($inventario['IdInventarioUnidadesRenta'],$inventario['Precio'],$inventario['Descripcion'],
			$inventario['Incluye'],$inventario['cantidad'], $inventario['IdUnidadRenta'], $inventario['IdSucursal'], $inventario['IdTipoUnidades'], $inventario['foto'] );
		}
		return $listaEmpleados;
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
		if(isset($_GET["IdSucursal"])) 
		{ 
			$filtro_sucursal = $_GET["IdSucursal"]; 
		} 
		else if (isset($_SESSION["id_sucursal"]))
		{ 
			$filtro_sucursal = $_SESSION["id_sucursal"]; 
		}
		#$query = 'CALL get_inventarios(:busqueda,:sucursal)';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
		#$query = 'CALL get_inventarios(:busqueda,:sucursal)';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
		$query = 'SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades AND unidades.eliminado=0 '; //AND inventario.IdSucursal="'.$_SESSION["id_sucursal"].'"';	//La llamada recive 2 params... :busqueda y ID ((de preuba) de sucursal
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			$query .= 'AND unidades.DesUnidad LIKE "%'.$search_filter.'%" AND inventario.eliminado=0 ';

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
			$NoRecuperado =  VentasModel::NoRecuperado($row["IdInventarioUnidadesRenta"]);
			
			#Opcion 2. //Actualmente se usa este. te dice si el inventario 
			$Cotizado = VentasModel::Cotizado($row["IdInventarioUnidadesRenta"]);
			$total_no_disponible = $Cotizado;	//Se ha seleccionado la opcion 2 " $Cotizado " pero, NO BORRAR la opcion 1 " $NoRecuperado "

			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["DesUnidad"].' '.$row["DescTipoUnidad"];
			$sub_array[] = SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = $row["cantidad"]; //- $total_no_disponible;

		if($total_no_disponible>0){
			$sub_array[] = '<button type="button" name="track" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-success btn-sm track" data-toggle="tooltip" data-placement="top" title="Mostrar ubicacions">'.$total_no_disponible.'</button>'; //Envia el ID del innvenario,
		} else if($total_no_disponible==0) {
			$sub_array[] = $total_no_disponible; //Envia el ID del innvenario,
		}
			$sub_array[] = $row["cantidad"] + $total_no_disponible;	//este era el total que indicaba el inventario + el disponible que se calculaba si el carrito decia que no se ha recupeado

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdInventarioUnidadesRenta"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('CALL get_inventario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$inventarioDb=$select->fetch();
		$inventario = new InventarioModel ($inventarioDb['IdInventarioUnidadesRenta'],$inventarioDb['Precio'], $inventarioDb['Descripcion'],
		$inventarioDb['Incluye'], $inventarioDb['cantidad'],$inventarioDb['IdUnidadRenta'],$inventarioDb['IdSucursal'], $inventarioDb['IdTipoUnidades'], $inventarioDb['foto']);
		//var_dump($alumno);
		//die();
		return $inventario;
	}

	public static function getOnlyBasicInfoForInvoice_line1($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('CALL get_inventario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$inventarioDb=$select->fetch();
		return $inventarioDb['DesUnidad'].', '.$inventarioDb['DescTipoUnidad'].', '.$inventarioDb['Descripcion'];
	}

	public static function getOnlyBasicInfoForInvoice_line2($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('CALL get_inventario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$inventarioDb=$select->fetch();
		return $inventarioDb['Incluye'];
	}

	public static function track($id){
		//Esto sirve para rastrear un item del inventario
		$db=DataBase::getConnect();
		$items = [];
/*		$select=$db->prepare('
			SELECT * FROM 
				inventario_unidades_renta as inventario,
				unidades_renta as unidades,
				c_tipo_unidades as tipos,
				_cotizaciones_cart as carrito, 
				orden_rentas as ordenes,
				municipio, 
				clientes 
			WHERE 
					inventario.IdUnidadRenta = unidades.IdUnidadRenta AND 
					inventario.IdTipoUnidades = tipos.IdTipoUnidades AND
	carrito.IdInventarioUnidadesRenta = :id AND inventario.IdInventarioUnidadesRenta = :id AND
				municipio.idm=ordenes.IdCiudad AND 
				ordenes.IdCliente = clientes.IdCliente
				AND carrito.recuperado=0 AND ordenes.clave_unica = carrito.clave_unica
		');*/
		$select=$db->prepare('CALL track(:id)'); //prodecimiento
		$select->bindValue('id',$id);
		$select->execute();
		$inventario=$select->fetchAll();
		foreach($inventario as $item){
			$items[] = array($item["DesUnidad"],$item["Descripcion"],$item["DescTipoUnidad"],$item["cantidad"],$item["IdCliente"]);	//Cantidad podria confundirse, definir alias
		}
		
		return $inventario;
		//$inventarioDb['IdInventarioUnidadesRenta'];
		/*
		 *	SELECT * FROM _cotizaciones_cart as carrito, orden_rentas as ordenes, municipio, clientes WHERE carrito.IdInventarioUnidadesRenta = '1' AND municipio.idm=ordenes.IdCiudad AND ordenes.IdCliente = clientes.IdCliente
		 *	
		 *	#Bajo el siguiente termino: agregas del inventario al carrito, guardas la cotizacion, si el cliente la aprueba pues bien, sino esta se elimina porque y el stock recupera lo perdido, cuando finaliza una cotizacion, el stock tabien se vuelve a recuperar
		 *	//Datos que me interesan
		 *
					<tr>
						<th>WC - Amarillo - Doble</th>	//Falta unir select con c_tipo, unidades_renta...
						<th>Cantidad</th>
						<th>Cliente</th>	//Nombre,
						<th>Ubicación</th>	//Todos los datos de entrega
					</tr>
		 */
	}

	public static function update($inventario){
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE inventario_unidades_renta SET Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
#		$update=$db->prepare('CALL edit_inventario()  Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
		$update=$db->prepare('CALL edit_inventario(:IdInventarioUnidadesRenta,:Precio,:Descripcion,:Incluye,:cantidad,:IdUnidadRenta,:IdSucursal,:IdTipoUnidades,:foto)  ');
		$update->bindValue('Precio',$inventario->getPrecio());
		$update->bindValue('Descripcion',$inventario->getDescripcion());
		$update->bindValue('Incluye',$inventario->getIncluye());
		$update->bindValue('cantidad',$inventario->getCantidad());
		$update->bindValue('IdUnidadRenta',$inventario->getIdUnidadRenta());
		$update->bindValue('IdSucursal',$inventario->getIdSucursal());
		$update->bindValue('IdTipoUnidades',$inventario->getIdTipoUnidades());
		$update->bindValue('foto',$inventario->getFoto());
		$update->bindValue('IdInventarioUnidadesRenta',$inventario->getIdInventarioUnidadesRenta());
		$update->execute();
	}

	public static function actualizar_stock_por_carrito($id, $qty){
		//Cada vez que en cotizaciones se agregue al carrito - se le restan al stock (cantidad disponible)
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE inventario_unidades_renta SET Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
#		$update=$db->prepare('CALL edit_inventario()  Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
		$update=$db->prepare('UPDATE inventario_unidades_renta SET cantidad = cantidad - :qty WHERE IdInventarioUnidadesRenta = :IdInventarioUnidadesRenta');
			# es_orden=1 es nuevo porque ahora el inventario solo rastrea cuando es orden,
		#$update->bindValue('cantidad',$inventario->getCantidad());
		$update->bindValue('qty',$qty);
		$update->bindValue('IdInventarioUnidadesRenta',$id);
		$update->execute();
	}

	public static function actualizar_stock_por_carrito_Recuperado($id, $qty){
		//Cada vez que en cotizaciones se agregue al carrito - se le restan al stock (cantidad disponible)
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE inventario_unidades_renta SET Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
#		$update=$db->prepare('CALL edit_inventario()  Precio=:Precio, Descripcion=:Descripcion, Incluye=:Incluye, cantidad=:cantidad, IdUnidadRenta=:IdUnidadRenta, IdSucursal=:IdSucursal, IdTipoUnidades=:IdTipoUnidades, foto=:foto WHERE IdInventarioUnidadesRenta=:IdInventarioUnidadesRenta');
		$update=$db->prepare('UPDATE inventario_unidades_renta SET cantidad = cantidad + :qty WHERE IdInventarioUnidadesRenta = :IdInventarioUnidadesRenta');
			# es_orden=1 es nuevo porque ahora el inventario solo rastrea cuando es orden,
		#$update->bindValue('cantidad',$inventario->getCantidad());
		$update->bindValue('qty',$qty);
		$update->bindValue('IdInventarioUnidadesRenta',$id);
		$update->execute();
	}


	public static function return_stock($id, $qty){
		//Cada vez que en cotizaciones se ACTUALICE un carrito - se le restan al stock (cantidad disponible)
		//Este metodo puede ser utilizado en 2 ocasiones dieferentes: para ACTULIZAR o para ELIMINAR una cotizacion
		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE inventario_unidades_renta SET cantidad = cantidad + :qty WHERE IdInventarioUnidadesRenta = :IdInventarioUnidadesRenta');
		#$update->bindValue('cantidad',$inventario->getCantidad());
		$update->bindValue('qty',$qty);
		$update->bindValue('IdInventarioUnidadesRenta',$id);
		$update->execute();
	}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('CALL delete_inventario(:IdInventarioUnidadesRenta)');
		$delete->bindValue('IdInventarioUnidadesRenta',$id);
		$delete->execute();
	}

}
?>