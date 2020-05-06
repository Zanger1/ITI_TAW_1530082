<?php 

class CCategriaEmpleadoController
{
	
	function __construct()
	{
		
	}

	function index(){
				$listaCategoria=CCategoriaEmpleadoModel::all();
		require_once('Views/empleados/index.php');
	

	}

	function register(){
		require_once('Views/empleados/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$categoria= new CCategoriaEmpleadoModel(null, $_POST['IdCategoriaEmpleado'],$_POST['DesCategoriaEmpleado']);

		CCategoriaEmpleadoModel::save($categoria);
		$this->show();
	}

	function show(){
		$listaCategoria=CCategoriaEmpleadoModel::all();

		require_once('Views/empleados/index.php');
	}

	function updateshow(){
		$id=$_GET['IdCliente'];
		$categoria=CCategoriaEmpleadoModel::searchById($id);
		require_once('Views/empleados/updateshow.php');
	}

	function update(){
		$categoria = new CCategoriaEmpleadoModel($_POST['IdCategoriaEmpleado'],$_POST['DesCategoriaEmpleado']);
		CCategoriaEmpleadoModel::update($categoria);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdCategoriaEmpleado'];
		CCategoriaEmpleadoModel::delete($IdCategoriaEmpleado);
		$this->show();
	}


	function error(){
		require_once('Views/empleados/error.php');
	}

}

?>