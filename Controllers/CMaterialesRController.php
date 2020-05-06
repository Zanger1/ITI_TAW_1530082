<?php 
class CMaterialesRController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaRentas=CMaterialesRModel::all();
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
		$Rentas= new CMaterialesRModel(null,$_POST['IdMaterialesRenta'],$_POST['NomMaterial'],$_POST['PrecioMaterial'],$_POST['UnidadMaterial']);

		CMaterialesRModel::save($Rentas);
		$this->show();
	}

	function show(){
		$listaRentas=CMaterialesRModel::all();

		require_once('Views/invetario/index.php');
	}

	function updateshow(){
		$id=$_GET['IdMaterialesRenta'];
		$Rentas=CMaterialesRModel::searchById($id);
		require_once('Views/Rentas/updateshow.php');
	}

	function update(){
		$Rentas = new CMaterialesRModel($_POST['IdMaterialesRenta'],$_POST['NomMaterial'],$_POST['PrecioMaterial'],$_POST['UnidadMaterial']);
		CMaterialesRModel::update($Rentas);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdMaterialesRenta'];
		CMaterialesRModel::delete($IdMaterialesRenta);
		$this->show();
	}


	function error(){
		require_once('Views/invetario/error.php');
	}

}

?>