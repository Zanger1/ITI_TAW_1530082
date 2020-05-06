<?php 
class CServiciosModel

{
	private $IdServicio;
	private $NombreServicio;
	private $Precio;


	
	function __construct($IdServicio, $NombreServicio,$Precio)
	{
		$this->setIdServicio($IdServicio);
		$this->setNombreServicio($NombreServicio);
		$this->setPrecio($Precio);
		
	}
    public function getIdServicio(){
		return $this->IdServicio;
	}
	public function setIdCajaChica($IdServicio){
		$this->IdServicio = $IdServicio;
	}
//-----------------------------------------------
	public function getNombreServicio(){
		return $this->NombreServicio;
	}
	public function setNombreServicio($NombreServicio){
		$this->NombreServicio = $NombreServicio;
	}
//------------------------------------------------------
	
	public function getPrecio(){
		return $this->Precio;
	}

	public function setPrecio($Precio){
		$this->Precio = $Precio;
	}

//--------------------------------
	public static function save($servicio){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();

		$insert=$db->prepare('INSERT INTO caja_chica VALUES (NULL, :IdServicio,:NombreServicio,:Precio)');
		$insert->bindValue('IdServicio',$servicio->getIdServicio());
		$insert->bindValue('NombreServicio',$servicio->getNombreServicio());
		$insert->bindValue('Precio',$servicio->getIdTipoMovimiento());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaServicio=[];

		$select=$db->query('SELECT * FROM caja_chica order by IdServicio');

		foreach($select->fetchAll() as $servicio){$listaServicio[]=new CServiciosModel($servicio['IdServicio'],$servicio['NombreServicio'],$servicio['Precio']);
		}
		return $listaServicio;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM alumno WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$servicioDb=$select->fetch();


		$servicio = new CServiciosModel ($servicioDb['IdServicio'],$servicioDb['NombreServicio'],$servicioDb['Precio']);
		//var_dump($alumno);
		//die();
		return $servicio;

	}

	public static function update($servicio){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdServicio',$servicio->getIdServicio());
		$insert->bindValue('NombreServicio',$servicio->setIdServicio());
		$insert->bindValue('Precio',$servicio->getIdTipoMovimiento());;
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>