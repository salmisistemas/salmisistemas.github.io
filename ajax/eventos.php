<?php 
include "../controller/eventosController.php";
include "../models/eventosModel.php";

if (isset($_GET['action'])) {
	if ($_GET['action']=='eventos') {
		$events= eventosController::eventosC();
		echo json_encode($events);
	}

}
if (isset($_POST['action'])) {
	if ($_POST['action']=='nuevo') {
		 //var_dump($_POST);


		$events= eventosController::eventoNuevoC();

	}
if ($_POST["action"]=="borrarEvento" && $_POST["eventoId"]) {
		$events= eventosController::borrarEventoC($_POST["eventoId"]);	
}

if ($_POST['action']=="modal") {
	# code...
$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING);
$inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_STRING);
$fin = filter_input(INPUT_POST, 'fin', FILTER_SANITIZE_STRING);



if(!empty($titulo) && !empty($color) && !empty($inicio) && !empty($fin)){
	//Convertir la fecha y la hora del formato
	$data = explode(" ", $inicio);
	list($date, $hora) = $data;
	$data_barra = array_reverse(explode("/", $date));
	$data_barra = implode("-", $data_barra);
	$inicio_barra = $data_barra . "T" . $hora;
	
	$data = explode(" ", $fin);
	list($date,$hora) = $data;
	$data_barra = array_reverse(explode("/", $date));
	$data_barra = implode("-", $data_barra);
	$fin_barra = $data_barra . "T" . $hora;

		$events= eventosController::eventoNuevoC($data_barra,$titulo, $color, $inicio_barra, $fin_barra,$nombre);

}else{
	header("Location: ../index.php");
}


}

}
