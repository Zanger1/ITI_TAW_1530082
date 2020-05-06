<?php 
class CStatusModel
{
	private $IdStatus;
	private $Descripcion;

	
	function __construct($IdStatus, $Descripcion)
	{
		$this->setIdStatuas($IdStatus);
		$this->setDescripcion($Descripcion);
	}

	public function getIdStatus(){
		return $this->IdStatus;
	}
	public function setIdStatuas($IdStatus){
		$this->IdStatus = $IdStatus;
	}

	public function getDescripcion(){
		return $this->Descripcion;
	}
	public function setDescripcion($Descripcion){ 
		$this->Descripcion = $Descripcion;
	}


	public static function save($status){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO c_status VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdStatus',$status->getIdStatus());
		$insert->bindValue('Descripcion',$status->getDescripcion());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listastatus=[];

		$select=$db->query('SELECT * FROM c_status order by IdStatus');

		foreach($select->fetchAll() as $status){
			$listastatus[]=new CStatusModel($status['IdStatus'],$status['Descripcion']);
		}
		return $listastatus;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_status WHERE IdStatus=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$statusDb=$select->fetch();
		$Status = new CStatusModel ($statusDb['IdStatus'],$statusDb['Descripcion']);
		return $Status;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_status WHERE IdStatus=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$statusDb=$select->fetch();
		
		$Status = new CStatusModel ($statusDb['IdStatus'],$statusDb['Descripcion']);
		return $statusDb['Descripcion'];
	}

	public static function update($status){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_status SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdStatus',$status->getIdStatus());
		$insert->bindValue('Descripcion',$status->getDescripcion());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_status WHERE IdStatus=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>