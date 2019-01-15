
<?php
    //Basado en: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
    // Initialize the session
    session_start();
	
    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login.php");
      exit;
    }
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	
	$conn = new mysqli($servername, $username, $password, "delynar");
	if(!$conn)
	{
		die("Connection failed: " . mysql_error());
	}
	
//escribir en la sesion
	$usuario = $_SESSION['username'];
	//$sql = "SELECT permiso FROM usuario WHERE nombre_de_usuario = '$usuario'";
	//$query = mysqli_query($conn, $sql);
	
	
    ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bienvenido</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
		
		</style>
    </head>

    <body>
		<div class="container">
				<br>
				<br>
				<br>
		</div>
		
		<div class="jumbotron">
			<h1 align=center>Bienvenido, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. ¿Qué deseas hacer hoy?</h1>
		</div>
		
		<nav class="navbar navbar-default navbar-fixed-top"> <!-- Barra AMIGOS y GRUPOS -->
		  <div class="container">
			<div class="navbar-header navbar-left"><!-- AMIGOS -->
				<ul>
					<li class="navbar-brand">Amigos</li>
				</ul>
			</div>
				<ul class="nav navbar-nav navbar-left"> <!-- Funciones Amigos -->
				<li><a href="amigos.php">Mis Amigos</a></li>
				<li><a href="agregar-amigo.php">Agregar Amigos</a></li>
				<li><a href="eliminar-amigo.php">Borrar Amigos</a></li>
			</ul>
			<div class="navbar-header navbar-right"><!-- GRUPOS -->
				<ul>
					<li class="navbar-brand">Grupos</li>
				</ul>
			</div>
			<div><!-- Funciones Grupos -->
				<ul class="nav navbar-nav navbar-right">
					<li><a href="agregar-grupo.php">Crear Grupo</a></li>
					<li><a href="ver-grupos.php">Mis Grupos</a></li>
					<li><a href="eliminar-grupo.php">Borrar Grupo</a></li>
				</ul>
			</div>
		</nav>
		
		<div class="container"><!-- PUBLICACIONES -->
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<ul>
						<li class="navbar-brand">Publicaciones</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="publicar.php">Nueva Publicación</a></li>
						<li><a href="ver-publicaciones.php">Mis Publicaciones</a></li>
						<li><a href="eliminar-publicacion.php">Borrar Publicación</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>
        </div>
		
		<div class="container"><!-- LOGOUT -->
			<br>
			<br>
			<br>
			
			<p align=right><a href="logout.php" class="btn btn-danger btn-lg">Cerrar sesión</a></p>
		</div>
		
    </body>
</html>