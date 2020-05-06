<?php

date_default_timezone_set('America/Monterrey');
//tiene mas parametros
//ver info

setlocale(LC_TIME, "es_ES");
//jlopezl
//siepre se llama a esta clase por eso se pone aqui 
//lo de que aqui se empiezan a crar las variables de session

session_start();
class DataBase {

	private static $instance=NULL;
	
	function __construct(){}

	public static function  getConnect(){
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			//no activar por que marca error en el loguin
			//$pdo_options[PDO::ATTR_EMULATE_PREPARES]=FALSE;

			self::$instance= new PDO('mysql:host=localhost;dbname=sanitam','root','',$pdo_options);
			//jlopezl
			//corregir el problema con las tildes en todos los campos.
			//es decir, que se vean bien.
			self::$instance -> query ("SET NAMES 'utf8'");
		}
		return self::$instance;
	}
	
	public static function closeConnect(){
		$instance=null;
	}

	//Metodo que revisa si en X tabla, existe un registro con un valor para evitar duplicados
	function check_repeated_row($table, $field_col, $field_value){		//tabla, columna, valor, omitir_repetido .... , $omit_repeat
		$db=DataBase::getConnect();
		$select=$db->prepare("SELECT ".$field_col." FROM ".$table." WHERE ".$field_col." = :field_value");
#		$select->bindValue('table',$table);
#		$select->bindValue('field',$field);
		$select->bindValue('field_value',$field_value);
		$select->execute();
		$check=$select->fetch();
		$duplicate = "";
		if($select->rowCount() > 0){
			#return "Dato duplicado";
			$duplicate = 1;
			//omit_repeat debe ser NULL cuando hagas un nuevo registro
		} else {
			#return "Dato disponible";
			$duplicate = 0;
			//Dejaremos insertar datos
			//omit_repeat = ingrese el texto que pueda omitir en el caso de que .........................
		}
		return $duplicate;
	}

	//Metodo que revisa el valor actual
	function check_current_value($table, $field_col, $id_col, $id_value){		//tabla, campo, donde el id es igual a...
		$db=DataBase::getConnect();
#		$select=$db->prepare("SELECT * FROM ".$table." WHERE id = :value");
				////campo tabla: [correo_enviado] | tabla | clave_unica | clave_unica que selecciona | 
		$select=$db->prepare("SELECT ".$field_col." FROM ".$table." WHERE ".$id_col." = :id_value");
		$select->bindValue('id_value',$id_value);
		$select->execute();
		$check=$select->fetch();
		return $check[$field_col];
	}
	
	function speed_crud($sql){
		$db=DataBase::getConnect();
		$select=$db->prepare($sql);
		$select->execute();
		#return 'ejecutado';
		#$check=$select->fetch();
	}

	function console_read($sql){
		$array = [];
		$db=DataBase::getConnect();
		$select=$db->prepare($sql);
		$select->execute();
		$array = $select->fetchAll(\PDO::FETCH_ASSOC);
		return $array;
	}

}

	//Metodo para corregir tildes & acentos que vengan de la base de datos
	function string_encoder($txt){
		$encoding = mb_detect_encoding($txt, 'ASCII,UTF-8,ISO-8859-1');
		if ($encoding == "ISO-8859-1") {
			$txt = utf8_encode($txt); //$txt
		}
		return $txt;
	}

    if(!isset($_SESSION)){ 
        session_start(); 
    }
	
	
#echo DataBase::check_repeated_row("usuarios", "usuario", "admin22");	//Test
#echo DataBase::check_current_value("usuarios", "usuario", "IdUsuario", 19); //Test
#echo DataBase::check_current_value("clientes", "CorreoElectronico", "IdCliente", 5);

	
?>