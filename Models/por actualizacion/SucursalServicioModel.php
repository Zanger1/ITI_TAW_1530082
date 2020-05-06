<?php 
class SucursalServicioModel {
	private $IdSucursalServicio;
	private $IdSucursal;
	private $IdServicio;
	function __construct($IdSucursalServicio, $IdSucursal,$IdServicio){
		$this->setIdSucursalServicio($IdSucursalServicio);
		$this->setIdSucursal($IdSucursal);
		$this->setIdServicio($IdServicio);	
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
	public static function save($sucursal){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO sucursal_servicio VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdSucursalServicio',$sucursal->getIdSucursalServicio());
		$insert->bindValue('IdSucursal',$sucursal->getIdSucursal());
		$insert->bindValue('IdServicio',$sucursal->getIdServicio());
		$insert->execute();
	}
	public static function all(){		$db=DataBase::getConnect();
		$listaSucursalS=[];
		$select=$db->query('SELECT * FROM sucursal_servicio order by IdEmpleado');
		foreach($select->fetchAll() as $sucursal){
			$listaSucursalS[]=new SucursalServicioModel($sucursal['IdSucursalServicio'],$sucursal['IdSucursal'],$sucursal['IdServicio']);
		}
		return $listaSucursalS;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursal_servicio WHERE IdEmpleado=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalDb=$select->fetch();
		$sucursalS = new SucursalServicioModel ($sucursalDb['IdSucursalServicio'],$sucursalDb['IdSucursal'], $sucursalDb['IdServicio']);
		//var_dump($alumno);
		//die();
		return $sucursalS;
	}
	public static function update($sucursal){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdSucursalServicio',$sucursal->getIdSucursalServicio());
		$insert->bindValue('IdSucursal',$sucursal->getIdSucursal());
		$insert->bindValue('IdServicio',$sucursal->getIdServicio());
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM sucursal_servicio WHERE IdEmpleado=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}	public static function getOnlyBasicInfoForInvoice_line1($id){		$db=DataBase::getConnect();#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');		$select=$db->prepare('CALL get_servicios_id(:id)');		$select->bindValue('id',$id);		$select->execute();		$inventarioDb=$select->fetch();		return $inventarioDb['NombreServicio'].', '.$inventarioDb['nombre'].', '.$inventarioDb['descripcion'];	//nombre, tamano, descripcion	}	public static function getOnlyBasicInfoForInvoice_line2($id){		$db=DataBase::getConnect();#		$select=$db->prepare('SELECT * FROM inventario_unidades_renta WHERE IdInventarioUnidadesRenta=:id');		$select=$db->prepare('CALL get_servicios_id(:id)');		$select->bindValue('id',$id);		$select->execute();		$inventarioDb=$select->fetch();		return $inventarioDb['incluye'];	}
}?>