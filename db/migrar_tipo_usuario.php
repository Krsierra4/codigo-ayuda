<?php 

date_default_timezone_set("America/Guatemala");
ini_set('max_execution_time', 2000000);
ini_set("display_errors",false);

require "Database.php";

$db1 = new Database();
$db1->hostDB = "";
$db1->userDB = "";
$db1->passDB = "";
$db1->nameDB = "";
$db1->newConnection();

$db2 = new Database();
$db2->hostDB = "";
$db2->userDB = "";
$db2->passDB = "";
$db2->nameDB = "";
$db2->newConnection();

$roles = $db1->resultsQuery("SELECT * FROM usuario_grupo");

// cerebro viejo 
// admin    - 3
// operador - 4
// usuario  - 5

// cerebro nuevo
// admin    - 1
// operador - 2
// usuario  - 3


function getRol($valor) {

	switch ($valor) {
		case 3:
			return 1;
			break;
		case 4:
			return 2;
			break;
		case 5:
			return 3;
			break;		
		
		default:
			return 0;
			break;
	}
}


foreach($roles as $rol){

$usuario = $rol['id_user'];
$grupo = $rol['id_group'];

$query = "SELECT id FROM grupousuarios WHERE idGrupo = $grupo AND idUsuario = $usuario";
$idAsignacion = $db2->resultsQuery($query);

	if(count($idAsignacion) > 0){
		echo "<p style='color: green'>$query</p><br>";

		$idAsignacion = $idAsignacion[0]['id'];

		$tipo = getRol($rol['rol']);

		$query = "UPDATE grupousuarios SET tipoUsuario = $tipo WHERE id =  $idAsignacion";

		if($db2->makeQuery($query)) {
			echo "<p style='color: green'>$query</p><br>";
		}else{
			echo "<p style='color: red'>$query</p><br>";
		}

	}else{
		echo "<p style='color: red'>$query</p><br>";
	}

}

