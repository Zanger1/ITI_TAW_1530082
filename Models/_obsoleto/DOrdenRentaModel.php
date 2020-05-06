<?php 
class DOrdenRentaModel
{
	private $IdDetalleOrdenRentas;
	private $IdOrdenRenta;
	private $FolioCotizacion;
	private $FolioRenta;
	private $IdInventarioUnidadesRenta;
	private $Incluye;
	private $Precio;
	private $Cantidad;
	
	function __construct($IdDetalleOrdenRentas, $IdOrdenRenta,$FolioCotizacion, $FolioRenta,
	$IdInventarioUnidadesRenta,$Incluye, $Precio,$Cantidad)
	{
		$this->setidEmpleado($IdDetalleOrdenRentas);
		$this->setIdOrdenRenta($IdOrdenRenta);
		$this->setFolioCotizacion($FolioCotizacion);
		$this->setFolioRenta($FolioRenta);
		$this->setIdInventarioUnidadesRenta($IdInventarioUnidadesRenta);
		$this->setIncluye($Incluye);
		$this->setPrecio($Precio);
		$this->setCantidad($Cantidad);
	}

	public function getIdDetalleOrdenRentas(){
		return $this->IdDetalleOrdenRentas;
	}
	public function setIdDetalleOrdenRentas($IdDetalleOrdenRentas){
		$this->IdDetalleOrdenRentas = $IdDetalleOrdenRentas;
	}
//---------------------------------------------
	public function getIdOrdenRenta(){
		return $this->IdOrdenRenta;
	}
	public function setIdOrdenRenta($IdOrdenRenta){ 
		$this->IdOrdenRenta = $IdOrdenRenta;
	}
//----------------------------------------------
	public function getFolioCotizacion(){
		return $this->FolioCotizacion;
	}
	public function setFolioCotizacion($FolioCotizacion){
		$this->FolioCotizacion = $FolioCotizacion;
	}
//-------------------------------------------
	public function getFolioRenta(){
		return $this->FolioRenta;
	}
	public function setFolioRenta($FolioRenta){
		$this->FolioRenta = $FolioRenta;
	}
//------------------------------------------
	public function getIdInventarioUnidadesRenta(){
		return $this->IdInventarioUnidadesRenta;
	}
	public function setRFC($IdInventarioUnidadesRenta){
		$this->IdInventarioUnidadesRenta = $IdInventarioUnidadesRenta;
	}
//---------------------------------------
	public function getIncluye(){
		return $this->Incluye;
	}
	public function setIncluye($Incluye){
		$this->Incluye = $Incluye;
	}
//_-----------------------------------------------
	public function getPrecio(){
		return $this->Precio;
	}
	public function setPrecio($Precio){
		$this->Precio = $Precio;
	}
//-----------------------------------------
	public function getCantidad(){
		return $this->Cantidad;
	}
	public function setCantidad($Cantidad){
		$this->Cantidad = $Cantidad;
	}
//------------------------------------------
	public static function save($OrdenRenta){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO detalle_orden_rentas VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdDetalleOrdenRentas',$OrdenRenta->getIdDetalleOrdenRentas());
		$insert->bindValue('IdOrdenRenta',$OrdenRenta->getIdOrdenRenta());
		$insert->bindValue('FolioCotizacion',$OrdenRenta->getFolioCotizacion());
		$insert->bindValue('FolioRenta',$OrdenRenta->getFolioRenta());
		$insert->bindValue('IdInventarioUnidadesRenta',$OrdenRenta->getIdInventarioUnidadesRenta());
		$insert->bindValue('Incluye',$OrdenRenta->getIncluye());
		$insert->bindValue('Precio',$OrdenRenta->getPrecio());
		$insert->bindValue('Cantidad',$OrdenRenta->getCantidad());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaOrdenRentaDb=[];

		$select=$db->query('SELECT * FROM detalle_orden_rentas order by idEmpleado');

		foreach($select->fetchAll() as $OrdenRenta){
			$listaOrdenRenta[]=new DOrdenRentaModel($OrdenRenta['IdDetalleOrdenRentas'],$OrdenRenta['IdOrdenRenta'],$OrdenRenta['FolioCotizacion'],
			$OrdenRenta['FolioRenta'], $OrdenRenta['IdInventarioUnidadesRenta'], $OrdenRenta['Incluye'], $OrdenRenta['Precio'], $OrdenRenta['Cantidad']);
		}
		return $listaOrdenRenta;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM detalle_orden_rentas WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$OrdenRentaDb=$select->fetch();


		$OrdenRenta = new DOrdenRentaModel($OrdenRentaDb['IdDetalleOrdenRentas'],$OrdenRentaDb['IdOrdenRenta'],$OrdenRentaDb['FolioCotizacion'],
			$OrdenRentaDb['FolioRenta'], $OrdenRentaDb['IdInventarioUnidadesRenta'], $OrdenRentaDb['Incluye'], $OrdenRentaDb['Precio'], $OrdenRenta['Cantidad']);
		//var_dump($alumno);
		//die();
		return $OrdenRenta;

	}

	public static function update($OrdenRenta){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdDetalleOrdenRentas',$OrdenRenta->getIdDetalleOrdenRentas());
		$insert->bindValue('IdOrdenRenta',$OrdenRenta->getIdOrdenRenta());
		$insert->bindValue('FolioCotizacion',$OrdenRenta->getFolioCotizacion());
		$insert->bindValue('FolioRenta',$OrdenRenta->getFolioRenta());
		$insert->bindValue('IdInventarioUnidadesRenta',$OrdenRenta->getIdInventarioUnidadesRenta());
		$insert->bindValue('Incluye',$OrdenRenta->getIncluye());
		$insert->bindValue('Precio',$OrdenRenta->getPrecio());
		$insert->bindValue('Cantidad',$OrdenRenta->getCantidad());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM detalle_orden_rentas WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>