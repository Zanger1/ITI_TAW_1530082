<?php 
class RentasMaterialesController
{
	
	function __construct()
	{
		
	}

	function index(){
		
		$listaMateriales=RentasMaterialesModel::all();
		require_once('Views/clientes/index.php');
	}

	function register(){
		require_once('Views/clientes/register.php');
	}

	function save(){
		/*if (!isset($_POST['estado'])) {
			$estado="of";
		}else{
			$estado="on";
		}*/
		$materiales= new RentasMaterialesModel(null,$_POST['IdRentasMateriales'],$_POST['IdUnidadRenta'],$_POST['IdMaterialeasRentas'],$_POST['Cantidad']);

		RentasMaterialesModel::save($materiales);
		$this->show();
	}

	function show(){
		$listaMateriales=RentasMaterialesModel::all();

		require_once('Views/clientes/index.php');
	}

	function updateshow(){
		$id=$_GET['IdRentasMateriales'];
		$materiales=RentasMaterialesModel::searchById($id);
		require_once('Views/clientes/updateshow.php');
	}

	function update(){
		$clientes = new RentasMaterialesModel($_POST['IdRentasMateriales'],$_POST['IdUnidadRenta'],$_POST['IdMaterialeasRentas'],$_POST['Cantidad'],$_POST['Colonia']);
		RentasMaterialesModel::update($materiales);
		$this->show();
	}
	function delete(){
		$id=$_GET['IdRentasMateriales'];
		RentasMaterialesModel::delete($IdRentasMateriales);
		$this->show();
	}
	function error(){
		require_once('Views/clientes/error.php');
	}

}

?>