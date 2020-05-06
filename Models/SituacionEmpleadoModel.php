<?php 
class SituacionEmpleadoModel
{
	private $IdSituacionEmpleado;
	private $DescSitEmpleado;

	
	function __construct($IdSituacionEmpleado,  $DescSitEmpleado)
	{
		$this->setIdSituacionEmpleado($IdSituacionEmpleado);
		$this->setDescSitEmpleado($DescSitEmpleado);
	}

	public function getIdSituacionEmpleado(){
		return $this->IdSituacionEmpleado;
	}
	public function setIdSituacionEmpleado($IdSituacionEmpleado){
		$this->IdSituacionEmpleado = $IdSituacionEmpleado;
	}

	public function getDescSitEmpleado(){
		return $this->DescSitEmpleado;
	}
	public function setDescSitEmpleado($DescSitEmpleado){ 
		$this->DescSitEmpleado = $DescSitEmpleado;
	}

	public static function save($Sitempleados){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO situacion_empleados VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdSituacionEmpleado',$Sitempleados->getIdSituacionEmpleado());
		$insert->bindValue('DescSitEmpleado',$Sitempleados->getDescSitEmpleado());
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaSitEmpleados=[];

		$select=$db->query('SELECT * FROM situacion_empleado order by IdSituacionEmpleado');

		foreach($select->fetchAll() as $Sitempleados){
			$listaSitEmpleados[]=new SituacionEmpleadoModel($Sitempleados['IdSituacionEmpleado'],$Sitempleados['DescSitEmpleado']);
		}
		return $listaSitEmpleados;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM situacion_empleado WHERE IdSituacionEmpleado=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$SitempleadosDb=$select->fetch();
		$Sitempleado = new SituacionEmpleadoModel($SitempleadosDb['IdSituacionEmpleado'],$SitempleadosDb['DescSitEmpleado']);
		//return $Sitempleado;
		return $SitempleadosDb;
	}
	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM situacion_empleado WHERE IdSituacionEmpleado=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$SitempleadosDb=$select->fetch();
		$Sitempleado = new SituacionEmpleadoModel($SitempleadosDb['IdSituacionEmpleado'],$SitempleadosDb['DescSitEmpleado']);
		//return $Sitempleado;
		return $SitempleadosDb['DescSitEmpleado'];
	}

	public static function update($Sitempleados){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdSituacionEmpleado',$Sitempleados->getIdSituacionEmpleado());
		$insert->bindValue('DescSitEmpleado',$Sitempleados->getDescSitEmpleado());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM situacion_empleados WHERE IdSituacionEmpleado=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>