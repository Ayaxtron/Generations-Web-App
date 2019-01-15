 <html> 
	<head>
		<meta charset="UTF-8">
        <title>Modificar Publicaciones</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
		table{
			width: 100%
		}
		
		th{
			font-size: 24px;
			padding: 10px;
		}
		
		td {
			font-size: 20px;
			padding: 10px;
		}
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
				<h1>Modificar Publicaciones</h1>
				<div class="principal">
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
					$sql = "SELECT * FROM publicaciones";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						echo "<table><tr><th>Nombre</th><th>Texto</th></tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["nombre_publicacion"]."</td><td><a href='editNombrePub.php?edit=$row[nombre_publicacion]'>edit</td><td>".$row["texto_publicacion"]."</td><td><a href='editTextoPub.php?edit=$row[nombre_publicacion]'>edit</td></tr>";

						}
						echo "</table>";
					} else {
						echo "No hay publicaciones aún, selecciona el botón 'Nueva publicación' en el menú principal para crear una nuevo.";
					}
					?>
					<div align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
					</div>
				</div>
			</div>
		</div>

	</body> 
	<!-- QUE ES ESTO? a href='edit.php?edit=$row[id]'></a -->

</html>
