<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>Agenda Personal</title>
		<link href='css/bootstrap.min.css' rel='stylesheet'>
		<link href='css/fullcalendar.min.css' rel='stylesheet' />
		<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />

	</head>		
	<script src='js/jquery.min.js'></script>
	<script src='js/bootstrap.min.js'></script>
	<body>
<?php include"nav.php"; ?>

		<div class="container">
	
		  <div class="row">
		    <div class="col-md-12">
				<div class="panel-body" style="margin-top: 30px;">
				<!--Inicio elementos contenedor-->
					 <form class="form-horizontal" action="" method="POST">
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="username">Nombre de usuario:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese el nombre de usuario">
					    </div>
					  </div>
					  <div class="form-group">
					    <label class="control-label col-sm-2" for="pwd">Conttaseña:</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Ingrese su contraseña">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-success">Submit</button>
					    </div>
					  </div>
					</form> 
				</div>
			</div>
		</div>	
		</div>
	</body>

		<?php
			include"controller/loginController.php";
			include"models/loginModel.php";
			$ingreso = new login();
			$ingreso -> loginController();
			
		?>
	

</html>