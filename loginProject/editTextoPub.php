<html> 
	<head>
		<meta charset="UTF-8">
        <title>Cambiar Nombre a Publicacion</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	</head>
	<body> 
		<div>
			<br>
			<br>
			<br>
		</div>
		
		<div class="container">
			 <?php 
			include_once 'database.php';
			   if( isset($_GET['edit']) )
				{
			$nombre_publicacion = $_GET['edit'];
			$res= mysqli_query($conn,"SELECT * FROM publicaciones WHERE nombre_publicacion='$nombre_publicacion'");
			$row= mysqli_fetch_array($res);
				}

			if( isset($_POST['newDesc']) )
			{
			$newDesc = $_POST['newDesc'];
			$nombre_publicacion  	 = $_POST['nombre_publicacion'];
			$sql     = "UPDATE publicaciones SET texto_publicacion='$newDesc' WHERE nombre_publicacion='$nombre_publicacion'";
			$res 	 = mysqli_query($conn,$sql) 
										or die("Could not update".mysqli_error());
			echo "<meta http-equiv='refresh' content='0;url=modificar-publicaciones.php'>";
			}
			?>
			
			<div class="jumbotron">
				<h1>Cambiar texto</h1>
				<form action="editTextoPub.php" method="POST" >
					<div class="container col-xs-10">
						<input class="form-control input-lg" type="text" name="newDesc" placeholder="Nombre actual: <?php echo $row[1]; ?>. Ingresa el nuevo texto."> 
					</div>
				  <input type="hidden" name="nombre_publicacion" value="<?php echo $row[0]; ?>">
				  <input class="btn btn-success btn-lg" type="submit" name="submit" value="Actualizar"> 
				  <div align=right>
					<br>
					<a href="modificar-publicaciones.php"><button type="button" class="btn btn-danger btn-lg">Regresar</button></a>
				  </div>
				  
				</form> 
				
			
				
			</div>
			
		</div>

	</body> 
</html>