<?php 

//LLAMAR A LOS METODOS DE SESSION
session_start();
	
///llamar a la base de datos de XAMPP
    require_once 'database.php';

    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login.php");
      exit;
    }

?>

<!DOCTYPE html>
<html> 
<head>
<title>Grupos</title>
</head>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Los Viejitos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
		
        </style>
    </head>
    <body>
		<div>
			<br>
			<br>
			<br>
		</div>
		
        <div class="container">
			<div class="jumbotron">
				<h1>Aún en desarrollo<h1>
				<h2>Nuevo Grupo: </h2>
				<h3>Actividad: </h3>
				<div align=right>	
					<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
				</div>
            </div>
        </div> 
    </body>
</html>
        
        
         