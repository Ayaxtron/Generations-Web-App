<html> 
	<head>
		<meta charset="UTF-8">
        <title>Cambiar Descripción de Grupo</title>
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
			$nombre = $_GET['edit'];

			$res= mysqli_query($conn,"SELECT * FROM grupos WHERE nombre='$nombre'");
			$row= mysqli_fetch_array($res);
		}

		if( isset($_POST['newDesc']) )
		{
			

			$newDesc = $_POST['newDesc'];
			$sql     = "UPDATE grupos SET descripcion='$newDesc' WHERE nombre='$nombre'";
			$res 	 = mysqli_query($conn,$sql) 
										or die("Could not update".mysqli_error());
			echo "<meta http-equiv='refresh' content='0;url=modificar-grupo.php'>";

		
		}
			?>
			
			<div class="jumbotron">
				<h1>Cambiar descripción</h1>
				<form action="editDesc.php" method="POST" >
				<div class="container col-xs-10">
				  <input class="form-control input-lg" type="text" name="newDesc" placeholder="Descripción anteriror: <?php echo $row[1]; ?>. Ingresa la nueva descripción"> 
				</div>
				  <input type="hidden" name="id" value="<?php echo $row[1]; ?>">
				  <input class="btn btn-success btn-lg" type="submit" name="submit" value="Actualizar"> 
				  <div align=right>
					<br>
					<a href="modificar-grupo.php"><button type="button" class="btn btn-danger btn-lg">Regresar</button></a>
				  </div>
				</form> 
				
			
				
			</div>
			
		</div>

	</body> 
</html>