<?php 
class CMaterialesSController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaClientes=CMaterialesSModel::all();
		require_once('Views/invetario/index.php');
	}

	function register(){
		require_once('Views/invetario/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$Materiales= new CMaterialesSModel(null,$_POST['IdMaterialesServicio'],$_POST['NomMaterial'],$_POST['PrecioMaterial'],$_POST['UnidadMaterial']);

		CMaterialesSModel::save($Materiales);
		$this->show();
	}

	function show(){
		$listaClientes=CMaterialesSModel::all();

		require_once('Views/invetario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdMaterialesServicio'];
		$Materiales=CMaterialesSModel::searchById($id);
		require_once('Views/Materiales/updateshow.php');
	}

	function update(){
		$Materiales = new CMaterialesSModel($_POST['IdMaterialesServicio'],$_POST['NomMaterial'],$_POST['PrecioMaterial'],$_POST['UnidadMaterial']);
		CMaterialesSModel::update($Materiales);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdMaterialesServicio'];
		CMaterialesSModel::delete($IdMaterialesServicio);
		$this->show();
	}


	function error(){
		require_once('Views/invetario/error.php');
	}

}

?>