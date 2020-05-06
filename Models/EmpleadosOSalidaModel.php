<?php 
class EmpleadosOSalidaModel
{
	private $IdEmpleadosOrdenSalida;
	private $IdOrdenSalidaRenta;
	private $IdEmpleado;
	
	function __construct($IdEmpleadosOrdenSalida, $IdOrdenSalidaRenta,$IdEmpleado)
	{
		$this->IdEmpleadosOrdenSalida($IdEmpleadosOrdenSalida);
		$this->setIdSucursal($IdOrdenSalidaRenta);
		$this->setIdTipoMovimiento($IdEmpleado);
	}
	public function getIdEmpleadosOrdenSalida(){
		return $this->IdEmpleadosOrdenSalida;
	}
	public function setIdEmpleadosOrdenSalida($IdEmpleadosOrdenSalida){
		$this->IdEmpleadosOrdenSalida = $IdEmpleadosOrdenSalida;
	}

	public function getIdOrdenSalidaRenta(){
		return $this->IdOrdenSalidaRenta;
	}
	public function setIdOrdenSalidaRenta($IdOrdenSalidaRenta){
		$this->IdOrdenSalidaRenta = $IdOrdenSalidaRenta;
	}
	
	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}


	public static function save($empleadosOS){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();

		$insert=$db->prepare('INSERT INTO empleados_orden_salida_renta VALUES (NULL, :IdEmpleadosOrdenSalida,:IdOrdenSalidaRenta,:IdEmpleado)');
		$insert->bindValue('IdEmpleadosOrdenSalida',$empleadosOS->getIdEmpleadosOrdenSalida());
		$insert->bindValue('IdOrdenSalidaRenta',$empleadosOS->getIdOrdenSalidaRenta());
		$insert->bindValue('IdEmpleado',$empleadosOS->getIdEmpleado());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaempleadosOS=[];

		$select=$db->query('SELECT * FROM empleados_orden_salida_renta order by IdEmpleadosOrdenSalida');

		foreach($select->fetchAll() as $empleadosOS){$listaempleadosOS[]=new EmpleadosOSalidaModel($empleadosOS['IdEmpleadosOrdenSalida'],$empleadosOS['IdOrdenSalidaRenta'],$empleadosOS['IdEmpleado']);
		}
		return $listaempleadosOS;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM empleados_orden_salida_renta WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$empleadosOSDb=$select->fetch();


		$empleadosOS = new EmpleadosOSalidaModel ($empleadosOSDb['IdEmpleadosOrdenSalida'],$empleadosOSDb['IdOrdenSalidaRenta'],$empleadosOSDb['IdEmpleado']);
		//var_dump($empleados_orden_salida_renta);
		//die();
		return $empleadosOS;

	}

	public static function update($empleadosOS){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE empleados_orden_salida_renta SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdEmpleadosOrdenSalida',$empleadosOS->getIdEmpleadosOrdenSalida());
		$insert->bindValue('IdOrdenSalidaRenta',$empleadosOS->getIdOrdenSalidaRenta());
		$insert->bindValue('IdEmpleado',$empleadosOS->getIdEmpleado());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM empleados_orden_salida_renta WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>