<nav class="navbar navbar-default" style="background: #d90303;">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="./">CALENDARIO</a> </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?=
          (!isset($_SESSION["validar"]))? '<li ><a href="./login.php">CANCELACIONES</a></li>' : '<li ><a href="./salir.php">'.$_SESSION["username"].' (click para salir)</a></li>' ;
 
         ?>
        
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>

<style>
  .navbar-default .navbar-brand   {
    color: white;
}
  .navbar-default .navbar-brand:hover {
    color: white;
    text-decoration: underline;
    text-decoration-style: double;
}

.navbar-default .navbar-nav > li > a {
    color: white;
}
.navbar-default .navbar-nav > li > a:hover {
    color: white;
    text-decoration: underline;
    text-decoration-style: double;
    
}
</style>