<?php
/**
 * 
 */
class eventosController 
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }


	public static function eventosC(){
		$busca= eventosModel::getAll('mis_eventos ');
			return $busca;
	}

	public static function eventoNuevoC($validator,$titulo, $color, $inicio_barra, $fin_barra,$nombre){
		if ($validator >= date("Y-m-d")) {
			//REGLA QUE EVITA LA SUPERPOSICION DE HORARIO
			$busca= eventosModel::disponibilidad($inicio_barra,$fin_barra,'mis_eventos');

			 if ($busca) {

			 			echo '<script>alert("Sala no disponible en este horario")</script>';
						header("Refresh: .1; url=../index.php");
				 }else{
					$datos=array("titulo"=>$titulo,
								"color"=>$color,
								"inicio"=>$inicio_barra,
								"nombre"=>$nombre,
								"fin"=>$fin_barra);

					$do = eventosModel::addNew($datos, "mis_eventos");
							if($do == "ok"){
								header("Location: ../index.php");		
							}
							else{
								echo '<script>alert("ocurrio un error")</script>';
								header("Refresh: .05; url=../index.php");
							}
			 }//end else $busca
			
		}else{//verificar que la fecha no haya pasado
			echo "La reserva ya no puede ser programada";
			header("Refresh: .05; url=../index.php");

		}	
			

	}


	public static function borrarEventoC($id){
		$set= eventosModel::borrarEvento($id,'mis_eventos');
		if($set == "ok"){
				echo '<script>alert("Hecho")</script>';
				header("Refresh: .02; url=../index.php");			}
			else{
				echo '<script>alert("ocurrio un error")</script>';
				header("Refresh: .02; url=../index.php");
			}

	}











	}

	

