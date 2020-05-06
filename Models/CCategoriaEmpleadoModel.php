<?php 
class CCategoriaEmpleadoModel {

	private $IdCategoriaEmpleado;
	private $DesCategoriaEmpleado;

	function __construct($IdCategoriaEmpleado, $DesCategoriaEmpleado){
		$this->setIdCategoriaEmpleado($IdCategoriaEmpleado);
		$this->setDesCategoriaEmpleado($DesCategoriaEmpleado);
	}

	public function getIdCategoriaEmpleado(){
		return $this->IdCategoriaEmpleado;
	}

	public function setIdCategoriaEmpleado($IdCategoriaEmpleado){
		$this->IdCategoriaEmpleado = $IdCategoriaEmpleado;
	}

	public function getDesCategoriaEmpleado(){
		return $this->DesCategoriaEmpleado;
	}

	public function setDesCategoriaEmpleado($DesCategoriaEmpleado){
		$this->DesCategoriaEmpleado = $DesCategoriaEmpleado;
	}

	public static function save($categoria){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO c_categoria_empleado VALUES (NULL, :IdCategoriaEmpleado,:DesCategoriaEmpleado,:IdTipoMovimiento)');
		$insert->bindValue('IdCategoriaEmpleado',$categoria->getIdCajaChica());
		$insert->bindValue('DesCategoriaEmpleado',$categoria->getIdSucursal());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaCategoria=[];
		$select=$db->query('SELECT * FROM c_categoria_empleado order by IdCategoriaEmpleado');
		foreach($select->fetchAll() as $categoria){
			$listaCategoria[]=new CCategoriaEmpleadoModel($categoria['IdCategoriaEmpleado'],$categoria['DesCategoriaEmpleado']);
		}
		return $listaCategoria;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('CALL get_empleado_id(:id)');	//PARA PRUEBAS DE QUE ESTE FUNCIONA, INTENTAR ABRIR UN MODAL PARA AGREGAR USUARIOS
		$select=$db->prepare('SELECT DesCategoriaEmpleado FROM c_categoria_empleado WHERE IdCategoriaEmpleado=:id');	//PARA PRUEBAS DE QUE ESTE FUNCIONA, INTENTAR ABRIR UN MODAL PARA AGREGAR USUARIOS
		$select->bindValue('id',$id);
		$select->execute();
		$categoria=$select->fetch();
		return $categoria['DesCategoriaEmpleado'];
	}
	
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_categoria_empleado WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$categoriaDb=$select->fetch();
		$categoria = new CCategoriaEmpleadoModel ($categoriaDb['IdCategoriaEmpleado'],$categoriaDb['DesCategoriaEmpleado']);
		//var_dump($alumno);
		//die();
		return $categoria;
	}

	public static function update($categoria){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_categoria_empleado SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdCategoriaEmpleado',$categoria->getIdCajaChica());
		$insert->bindValue('DesCategoriaEmpleado',$categoria->getIdSucursal());;
		$insert->execute();
	}

	public static function delete($id){
		/*
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_categoria_empleado WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
		*/
	}
}
?>