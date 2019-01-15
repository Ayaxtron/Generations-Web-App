<?php
session_start();
	
///llamar a la base de datos de XAMPP
    require_once 'database.php';

    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login.php");
      exit;
    }

    ?>

<html> 
	<head>
		<meta charset="UTF-8">
        <title>Publicaciones</title>
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
				<div>
				<?php 
					require_once 'database.php';
					
					$usuario = trim($_SESSION['username']);

				$sql = "SELECT * FROM publicaciones WHERE nom_usu = '$usuario'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					echo "<table><tr><th>Nombre</th><th>Texto</th></tr>";
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<tr><td>".$row["nombre_publicacion"]."</td><td>".$row["texto_publicacion"]." </td></tr>";

					}
					echo "</table>";
				} else {
					echo "<h3>No hay publicaciones aún, selecciona el botón 'Nueva publicación' en el menú principal para crear una nueva.</h3>";
				}

				?>

				</div>
				<div>
					<h2>Buscar publicación</h2>
					<form  method="post" action="ver-publicaciones.php?go"  id="searchform"> 
						<div class="container col-xs-10">
							<input class="form-control input-lg" type="text" placeholder="Busque palabras que se encontraban en su publicación." name="name">
						</div>
						<input class="btn btn-primary btn-lg" type="submit" name="submit" value="Buscar"> 
					</form> 
					<div align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
                        <a href="modificar-publicaciones.php"><button type="button" class="btn btn-info btn-lg" href="modificar-publicaciones.php">Modificar Publicaciones</button></a>
					</div>
					<?php
                    
                    
                     //LLAMAR A LOS METODOS DE SESSION


  

						  if(isset($_POST['submit'])){
						  if(isset($_GET['go'])){
						  if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){
						  $name=$_POST['name'];
						  $sql="SELECT  * FROM publicaciones WHERE nombre_publicacion LIKE '%" . $name .  "%' OR texto_publicacion LIKE '%" . $name ."%'";
						  //-run  the query against the mysql query function
						  $result=mysqli_query($conn, $sql);
						  //-create  while loop and loop through result set
						  while($row=mysqli_fetch_array($result)){
								  $nombre_publicacion  =$row['nombre_publicacion'];
								  $texto_publicacion=$row['texto_publicacion'];
				
								  
						  //-display the result of the array
						  echo "<ul>\n";
						  echo "<li>Nombre: " .$nombre_publicacion."</li>\n";
						  echo "<li>Texto: " .$texto_publicacion."</li>\n";
						  echo "</ul>";
						  }
						  }
						  else{
						  echo  "<p>Porfavor escribe el nombre de la publicación</p>";
						  }
						  }
						  }
						  $conn->close();
					?>
				</div>
			</div>
		</div>

	</body> 
</html>