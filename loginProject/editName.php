<html> 
	<head>
		<meta charset="UTF-8">
        <title>Cambiar Nombre a Grupo</title>
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

			if( isset($_POST['newName']) )
			{
			$newName = $_POST['newName'];
			
			$sql     = "UPDATE grupos SET nombre='$newName' WHERE nombre='$nombre'";
			$res 	 = mysqli_query($conn,$sql) 
										or die("Could not update".mysqli_error());
			echo "<meta http-equiv='refresh' content='0;url=modificar-grupo.php'>";
			}
			?>
			
			<div class="jumbotron">
				<h1>Cambiar nombre</h1>
				<form action="editName.php" method="POST" >
					<div class="container col-xs-10">
						<input class="form-control input-lg" type="text" name="newName" placeholder="Nombre actual: <?php echo $row[0]; ?>. Ingresa el nuevo nombre."> 
					</div>
				  <input type="hidden" name="id" value="<?php echo $row[0]; ?>">
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