<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>SALA DE JUNTAS SALMI</title>
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href='css/fullcalendar.min.css' rel='stylesheet' />
		<link href='css/AdminLTE.min.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
		<link rel="icon" href="https://salmi.com.mx/wp-content/uploads/cropped-icono-pestana-192x192.png" sizes="192x192" />
<style type="text/css">
body {
    margin: 0px 0px;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 17px;
}
</style>
		<script src='js/jquery.min.js'></script>
		<script src='js/bootstrap.min.js'></script>
		<script src='js/moment.min.js'></script>
		<script src='js/fullcalendar.min.js'></script>
		<script src='locale/es.js'></script>
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					//  aspectRatio: 2,
					 locale: 'es',
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: false,
					eventLimit: true, // allow "more" link when too many events
					eventClick: function(event) {
						
						$('#visualizar #title').text(event.title);
						$('#visualizar #nombre').text(event.nombre);
						$('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
						$('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
						$('.btn-delete-r').attr("value",event.id);
						$('#visualizar #mensaje').text("Para cancelar la reservacion favor de pasar al area de sistemas");
						$('#visualizar').modal('show');
						return false;
					},
					selectable: true,
					selectHelper: true,
					select: function(start, end){
						$('#cadastrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
						$('#cadastrar').modal('show');						
					},

			      events: {
				        url: 'ajax/eventos.php?action=eventos',
				        failure: function() {
				          //alert("no se pueden obtener los datos");
				        },
				        loading: function(bool) {
				        document.getElementById('loading').style.display =
				          bool ? 'block' : 'none';
				      }
			      },

				});
			});


			//Mascara para o campo data e hora
			function DataHora(evento, objeto){
				var keypress=(window.event)?event.keyCode:evento.which;
				campo = eval (objeto);
				if (campo.value == '00/00/0000 00:00:00'){
					campo.value=""
				}
			 
				caracteres = '0123456789';
				separacao1 = '/';
				separacao2 = ' ';
				separacao3 = ':';
				conjunto1 = 2;
				conjunto2 = 5;
				conjunto3 = 10;
				conjunto4 = 13;
				conjunto5 = 16;
				if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (19)){
					if (campo.value.length == conjunto1 )
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto2)
					campo.value = campo.value + separacao1;
					else if (campo.value.length == conjunto3)
					campo.value = campo.value + separacao2;
					else if (campo.value.length == conjunto4)
					campo.value = campo.value + separacao3;
					else if (campo.value.length == conjunto5)
					campo.value = campo.value + separacao3;
				}else{
					event.returnValue = false;
				}
			}



		</script>
</head>
	<body>
	
<?php include"nav.php"; ?>
<div class="container">
 <!--    <div class="col-md-12">
    </div>
  </div> -->
   <section class="content-header">
      <h1>
        RESERVACION DE SALA DE JUNTAS
        <small>Calendario</small>
      </h1>
      
    </section>

    <br>
  <div class="row">
<div class="box box-danger">
  	<!-- <div class="panel-heading">RESERVACIONES SALA DE JUNTAS SALMI</div> -->
 	 <div class="row col-md-3">
		<div class="box-body">
			<img src="logotipo.png" style="position: relative; top:200px">
		</div>
	</div> 


    <div class="col-md-9" style="margin:0">
		<div class="box-body no-padding" style="margin:0">
		<!--Inicio elementos contenedor-->
			<div id='calendar'></div>
		</div>
	<!--Fin elementos contenedor-->
	</div>
</div>


		<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" aria-label="Close" style="float: right;"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Datos del Evento</h4>
					</div>
					<div class="modal-body">
						<dl class="dl-horizontal">

							<dt>Titulo de Evento</dt>
							<dd id="title"></dd>
							<dt>Reservado por</dt>
							<dd id="nombre"></dd>
							<dt>Inicio de Evento</dt>
							<dd id="start"></dd>
							<dt>Fin de Evento</dt>
							<dd id="end"></dd>
							<br>
						</dl>
					<?php 
						if (!isset($_SESSION["validar"])) {
					?>
						<p id="mensaje"></p>
					<?php
						}else{
					?>
						<div class="row">
							<form action="ajax/eventos.php" method="POST">
								<input type="hidden" name="action" value="borrarEvento">
								<input type="hidden" class="btn-delete-r" name="eventoId" value="">
								<button type="submit" class="btn btn-danger pull-right " id="" style="margin-right: 5px; background-color:#ee0700">Eliminar reservación</button>
								
							</form>
						</div>
					<?php
						}
					 ?>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" aria-label="Close" style="float: right;"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title text-center">Registrar Evento</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" method="POST" action="ajax/eventos.php">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Titulo</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="titulo" placeholder="Titulo do Evento">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Nombre </label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nombre" required="" placeholder="Nombre completo de quien reserva">
								</div>
							</div>
								<!--

							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Color</label>
								<div class="col-sm-10">
									<select name="color" class="form-control" id="color">
										<option value="">Selecione</option>			
										<option style="color:#FFD700;" value="#FFD700">Amarillo</option>
										<option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
										<option style="color:#FF4500;" value="#FF4500">Naranja</option>
										<option style="color:#8B4513;" value="#8B4513">Marron</option>	
										<option style="color:#1C1C1C;" value="#1C1C1C">Negro</option>
										<option style="color:#436EEE;" value="#436EEE">Azul Real</option>
										<option style="color:#A020F0;" value="#A020F0">Purpura</option>
										<option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>										
										<option style="color:#228B22;" value="#228B22">Verde</option>
										<option style="color:#8B0000;" value="#8B0000">Rojo</option>
									</select>
								</div>
							</div>
							-->
							<input type="hidden" name="color" value="#228B22;">
							<input type="hidden" name="action" value="modal">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Inicio</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="inicio" id="start" onKeyPress="DataHora(event, this)">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-4 control-label">Fin de reservacion</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="fin" id="end" onKeyPress="DataHora(event, this)">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-success pull-right">Reservar sala de juntas</button>
								</div>
							</div>



						</form>
					</div>
				</div>
			</div>






</div>

  </div>
<div class="panel-footer">
  <div class="container">
    <p> </p>
  </div>
</div>

</body>
</html>