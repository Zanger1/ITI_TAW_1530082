<?php
class CEstadosModel
{
	private $IdEstado;
	private $Estado;

	
	function __construct($IdEstado, $Estado)
	{
		$this->setIdEstado($IdEstado);
		$this->setEstado($Estado);
	}

	public function getIdEstado(){
		return $this->IdEstado;
	}
	public function setIdEstado($IdEstado){
		$this->IdEstado = $IdEstado;
	}

	public function getEstado(){
		return $this->Estado;
	}
	public function setEstado($Estado){ 
		$this->Estado = $Estado;
	}


	public static function save($Estados){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO c_materiales_rentas VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdEstado',$Estados->getIdEstado());
		$insert->bindValue('Estado',$Estados->getEstado());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaClientes=[];

		$select=$db->query('SELECT * FROM c_materiales_rentas order by IdEstado');

		foreach($select->fetchAll() as $Estados){$listaClientes[]=new CMaterialesSModel($Estados['IdEstado'],$Estados['Estado']);
		}
		return $listaClientes;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_materiales_rentas WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$EstadosDb=$select->fetch();


		$Estados = new CMaterialesSModel ($EstadosDb['IdEstado'],$EstadosDb['Estado']);
		//var_dump($alumno);
		//die();
		return $Estados;

	}

	public static function update($Estados){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_materiales_servicios SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdEstado',$Estados->getIdEstado());
		$insert->bindValue('Estado',$Estados->getEstado());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_materiales_rentas WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>