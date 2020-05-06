<?php class CTipoMovimientoModel {
	private $IdTipoMovimiento;
	private $DesTipoMovimiento;
	function __construct($IdTipoMovimiento, $DesTipoMovimiento){
		$this->setIdTipoMovimiento($IdTipoMovimiento);
		$this->setDesTipoMovimiento($DesTipoMovimiento);
	}
	public function getIdTipoMovimiento(){
		return $this->IdTipoMovimiento;
	}
	public function setIdTipoMovimiento($IdTipoMovimiento){
		$this->IdTipoMovimiento = $IdTipoMovimiento;
	}
	public function getDesTipoMovimiento(){
		return $this->DesTipoMovimiento;
	}
	public function setDesTipoMovimiento($DesTipoMovimiento){ 
		$this->DesTipoMovimiento = $DesTipoMovimiento;
	}
	public static function save($movimiento){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO c_tipo_movimiento VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdTipoMovimiento',$movimiento->getIdTipoMovimiento());
		$insert->bindValue('DesTipoMovimiento',$movimiento->getDesTipoMovimiento());
		$insert->execute();
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaMovimiento=[];
		$select=$db->query('SELECT * FROM c_tipo_movimiento order by IdTipoMovimiento');
		foreach($select->fetchAll() as $movimiento){
			$listaMovimiento[]=new CTipoMovimientoModel($movimiento['IdTipoMovimiento'],$movimiento['DesTipoMovimiento']);
		}
		return $listaMovimiento;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_tipo_movimiento WHERE IdTipoMovimiento=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$movimientoDb=$select->fetch();
		$rol = new CTipoMovimientoModel($movimientoDb['IdTipoMovimiento'],$movimientoDb['DesTipoMovimiento']);
		return $rol;
	}
	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_tipo_movimiento WHERE IdTipoMovimiento=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$movimientoDb=$select->fetch();
		$rol = new CTipoMoviemientoController ($movimientoDb['IdTipoMovimiento'],$movimientoDb['DesTipoMovimiento']);
		return $movimientoDb['DesTipoMovimiento'];
	}
	public static function update($movimiento){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_tipo_movimiento SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdTipoMovimiento',$movimiento->getIdTipoMovimiento());
		$insert->bindValue('DesTipoMovimiento',$movimiento->getDesTipoMovimiento());
		$insert->execute();
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_tipo_movimiento WHERE IdTipoMovimiento=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>