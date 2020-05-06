<?php
class CTipoSucursalModel
{
	private $IdTipoSucursal;
	private $TipoSucursal;
	
	function __construct($IdTipoSucursal, $TipoSucursal)
	{
		$this->setIdTipoSucursal($IdTipoSucursal);
		$this->IdTipoSucursal($IdTipoSucursal);
	}
//-------------------------------------------------
	public function getIdTipoSucursal(){
		return $this->IdTipoSucursal;
	}
	public function setIdTipoSucursal($IdTipoSucursal){
		$this->IdTipoSucursal = $IdTipoSucursal;
	}
//--------------------------------------------------
	public function getTipoSucursal(){
		return $this->TipoSucursal;
	}
	public function setTipoSucursal($TipoSucursal){ 
		$this->TipoSucursal = $TipoSucursal;
	}


	public static function save($tipoSucursal){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO _tipo_sucursal VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdTipoSucursal',$tipoSucursal->getIdTipoSucursal());
		$insert->bindValue('TipoSucursal',$tipoSucursal->getTipoSucursal());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listatipoSucursal=[];

		$select=$db->query('SELECT * FROM _tipo_sucursal order by IdTipoSucursal');

		foreach($select->fetchAll() as $tipoSucursal){$listatipoSucursal[]=new CTipoSucursalModel($tipoSucursal['IdTipoSucursal'],$tipoSucursal['TipoSucursal']);
		}
		return $listatipoSucursal;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM _tipo_sucursal WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$tipoSDb=$select->fetch();


		$tipoSucursal = new CTipoSucursalModel ($tipoSDb['IdTipoSucursal'],$tipoSDb['TipoSucursal']);
		//var_dump($_tipo_sucursal);
		//die();
		return $tipoSucursal;

	}

	public static function update($tipoSucursal){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE _tipo_sucursal SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdTipoSucursal',$tipoSucursal->getIdTipoUnidades());
		$insert->bindValue('TipoSucursal',$tipoSucursal->getDescTipoUnidad());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM _tipo_sucursal WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>