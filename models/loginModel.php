<?php

require_once "conexion.php";

class loginModel{

	public static function loginInit($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT username, password FROM $tabla WHERE username = :usuario");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}


}
