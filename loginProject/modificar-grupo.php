 <html> 
	<head>
		<meta charset="UTF-8">
        <title>Modificar Grupos</title>
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
				<h1>Modificar Grupos</h1>
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
                    
                    
                    //QUER
                    $user = trim($_SESSION['username']);
                            $sql2="SELECT al_grupo FROM miembros WHERE pertenece_usuario = '$user' AND admin='1' ";
                              //CONSULTA DE SQL
						  $result2=mysqli_query($conn, $sql2);
                              
                              
                              if(!empty($result2) && $result2 != false){ 
                              //*********************
                              $row = $result2->fetch_assoc();
                              $grupo =  trim($row['al_grupo']);
                                  
                                  if($grupo==""){
                                       echo "<table><tr><td>No hay grupos que sean tuyos, selecciona el botón 'Agregar grupo' en el menú principal para crear uno nuevo.</td></tr></table>";
                                  }
                                  
                              //QUERY
                            $sql="SELECT * FROM grupos WHERE nombre = '$grupo'";
                              echo "<table>";
                              //CONSULTA DE SQL
						  $result=mysqli_query($conn, $sql);
                              
                              while($row = $result->fetch_assoc()){
                                  
                              echo "<tr><td>".$row["nombre"]."</td><td><a href='editName.php?edit=$row[nombre]'> edit</td>
                            
                            <td>".$row["descripcion"]."</td><td><a href='editDesc.php?edit=$row[nombre]'> edit</td>
                            
                            <td>".$row["limite"]."</td><td><a href='editLim.php?edit=$row[nombre]'> edit</td></tr>";
}
                                  echo "</table>";
                                  
                          }else{
                           echo "<table><tr><td>No hay grupos que sean tuyos, selecciona el botón 'Agregar grupo' en el menú principal para crear uno nuevo.</td></tr></table>";
                              }
                    
                    /*
					$sql = "SELECT * FROM grupos";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						echo "<table><tr><th>Nombre</th><th></th><th>Descripción</th><th></th><th>Limite</th><th></th></tr>";
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr><td>".$row["nombre"]."</td><td><a href='editName.php?edit=$row[nombre]'> edit</td>
                            
                            <td>".$row["descripcion"]."</td><td><a href='editDesc.php?edit=$row[nombre]'> edit</td>
                            
                            <td>".$row["limite"]."</td><td><a href='editLim.php?edit=$row[nombre]'> edit</td></tr>";

						}
						echo "</table>";
					} else {
						echo "No hay grupos que sean tuyos, selecciona el botón 'Agregar grupo' en el menú principal para crear uno nuevo.";
					}
                    */
                    
                    
            
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
