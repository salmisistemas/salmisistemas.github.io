<?php

class login{

	public function loginController(){

		if(isset($_POST["username"])){
			if($_POST["username"]!=NULL && preg_match('/^[a-zA-Z0-9]+$/', $_POST["pwd"])){
					$encriptar = crypt($_POST["pwd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');



				$datosController = array("usuario"=>$_POST["username"],
				                     "password"=>$encriptar);

				$respuesta = loginModel::loginInit($datosController, "administrador");

				$usuarioActual = $_POST["username"];


					if($respuesta["username"] == $_POST["username"] && $respuesta["password"] == $encriptar){


						#$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);

						
						session_start();

						$_SESSION["validar"] = true;
						$_SESSION["username"] = $respuesta["username"];

						header("location:index.php");

					}else{
						echo '<div class="alert alert-danger">Error al ingresar</div>';
						
					}


			}

		}
	}

}
