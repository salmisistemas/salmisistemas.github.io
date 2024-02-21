<?php
	require_once "conexion.php";
	/**
	 * 
	 */
	class eventosModel
	{
		

		/*----------  obtener todos los datos de usuario por id  ----------*/
		public static function getAll($tabla){
			$stmt=Conexion::conectar()->prepare("SELECT id, 
														titulo as title, 
														color, 
														nombre, 
														inicio as start, 
														fin as end
												 FROM $tabla WHERE estatus=1");
			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}
		/*----------  overificar si no hay una reserva dentro del horario que se dese3a apartar ----------*/
		public static function disponibilidad($iniciando,$final,$tabla){
			$stmt=Conexion::conectar()->prepare("SELECT id, 
														titulo as title, 
														nombre, 
														inicio, 
														fin 
		FROM $tabla where estatus =1 AND (inicio BETWEEN '".$iniciando."' and '".$final."' OR fin BETWEEN '".$iniciando."' and '".$final."')");

			$stmt->execute();
			return $stmt->fetchAll();
			$stmt->close();
		}

	public static function addNew($datos, $tabla){
			$stmt = Conexion::conectar()->prepare("INSERT INTO ".$tabla." (
																titulo ,
																color,
																inicio,
																fin,
																nombre,
																estatus
																)VALUES (:titulo,:color,:inicio,:fin,:nombre,1)");
			$stmt -> bindParam(":titulo", $datos["titulo"]);
			$stmt -> bindParam(":color", $datos["color"]);
			$stmt -> bindParam(":inicio", $datos["inicio"]);
			$stmt -> bindParam(":fin", $datos["fin"]);
			$stmt -> bindParam(":nombre", $datos["nombre"]);

			if($stmt->execute()){
				return "ok";
			}
			else{
				return "error";
			}
			$stmt->close();
		}


		/*----------  obtener todos los datos de usuario por id  ----------*/
		public static function borrarEvento($data, $tabla){
			$stmt=Conexion::conectar()->prepare("UPDATE $tabla SET estatus=0 where id=$data");
			if($stmt->execute()){
				return "ok";
			}
			else{
				return "error";
			}

			$stmt->close();
		}







	}

?>