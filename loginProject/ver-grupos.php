<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
	
///llamar a la base de datos de XAMPP
    require_once 'database.php';

    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login.php");
      exit;
    }

$user = trim($_SESSION['username']);
$grupo = "";

?>


<!DOCTYPE html>

<html> 
	<head>
		<meta charset="UTF-8">
		<title>Mis Grupos</title>	
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
					
                    //a cuales pertenece el user?
				$sql2 = "SELECT al_grupo FROM miembros WHERE pertenece_usuario = '$user'";
				$result2 = $conn->query($sql2);
                
                    
                    //si encontro algo?
                    if ($result2->num_rows > 0) {
					echo "<table><tr><th>Nombre</th><th>Descripción</th><th>Limite</th></tr>";
                        
                        
                    
                    
					// usemos el array de a los que pertenece, tiene los nombres y el while nos da los index o i
					while($row2 = $result2->fetch_assoc()) {
						
                        //limpiemos el dato que scamos del sql2
                        $value = trim($row2['al_grupo']);
                        
                        //saquemos de sql la info de grupos, value uso un index y saco un valor nombre que usaremos uwu
                    $sql = "SELECT * FROM grupos WHERE nombre = '$value' ";
                        
                        //lo conseguido del sql lo metemos a un array
				    $result = $conn->query($sql);
                        
                   
                        // imprimimos la tabla de ese array de tupples XD
					$row = $result->fetch_assoc();
						echo "<tr><td>".$row["nombre"]." </td><td>".$row["descripcion"]."</td><td>".$row["limite"]."</td></tr>";

					 

					}
					echo "</table>";
				} else {
					echo "No hay grupos aún, selecciona el botón 'Unirme a un grupo' o ve el crea el tuyo desde el menu";
				}
                    

				?>

				</div>
				
				<div id="search">
					<h3>Ver integrantes en el grupo</h3> 
					
                    <form  method="post" action="ver-grupos.php?go"  id="searchform"> 
					
                        <div class="container col-xs-10">
						<input class="form-control input-lg" type="text" name="value" placeholder="Busca el nombre del grupo al que perteneces"> 
					</div>
                        
					  <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Buscar"> 
					</form> 
					
					
						
					</div>
					<div>
						<br>
						<form action="grupos.php" align=right>
								<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
								<a href="modificar-grupo.php"><button type="button" class="btn btn-info btn-lg" href="modificar-grupo.php">Modificar Grupo</button></a>
								<input type="Submit" class="btn btn-primary btn-lg" value="Unirte a un grupo">
						</form>
                        
                        <?php
                        
                        //********************* ver los integrantes
                        
						  if(isset($_POST['submit'])){
						  if(isset($_GET['go'])){    
                              //********************    
                          
                              
                              //POST ES LA CONEXION DEL HTML INPUT AL PHP
                          $grupo=$_POST['value'];
                                
                            //QUERY
                            $sql2="SELECT al_grupo FROM miembros WHERE pertenece_usuario = '$user' AND al_grupo = '$grupo'";
                              //CONSULTA DE SQL
						  $result2=mysqli_query($conn, $sql2);
                              
                              
                              if(!empty($result2) && $result2 != false){ 
                              //*********************
                              $row = $result2->fetch_assoc();
                              $grupo =  trim($row['al_grupo']);
                                  
                                  if($grupo==""){
                                       echo "<table><tr><td>No perteneces a ese grupo o no existe</td></tr></table>";
                                  }
                                  
                              //QUERY
                            $sql="SELECT pertenece_usuario FROM miembros WHERE al_grupo = '$grupo'";
                              
                              //CONSULTA DE SQL
						  $result=mysqli_query($conn, $sql);
                              
                              while($row = $result->fetch_assoc()){
                                  echo "<table><tr><td>".$row["pertenece_usuario"]."</td></tr></table>";
                              }
                                  
                          }else{
                              echo "<table><tr><td>No perteneces a ese grupo o no existe</td></tr></table>";
                          }
                          }
                          }
                        
                        $conn->close();
                          
					?>
                        
					</div>
				</div>
			<div>
	</body> 
</html>