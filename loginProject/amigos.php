
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

//LLAMAR A LAS VARIABLES GUARDADAS CON SESSION CUANDO LOGIN
$usuario = trim($_SESSION['username']);
$amigo = "";



?>

<!DOCTYPE html>

<html> 
	<head>
		<meta charset="UTF-8">
        <title>Mis Amigos</title>
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
		<div class="container">
			<br>
			<br>
			<br>
		</div>
		<div class="container">
			<div class="jumbotron">
				<div>
				<?php 
				
				//recuperar de la tabla
				$sql = "SELECT amigo FROM amigos WHERE pertenece_a_usuario = '$usuario'";
				//guarda el tupple
                //echo "$sql";
				$result = $conn->query($sql);

				if ($result->num_rows>0) {  
					echo "<table><tr><th class='cinereousTable'>Nombre de Usuario</th></tr>";
					
					while($row = $result->fetch_assoc()) { 
						echo "<tr><td>".$row["amigo"]."</td></tr>";
					}
					echo "</table>";
				} else {
					echo "<h3 align=center>No hay amigos agregados</h3>";
				}

				?>
					
				</div>
				<!-- extrae del sql-->
				
				<div>
					<h2 align=center>Buscar en la lista de amigos para ver datos personales y de contacto</h2>
					<div class="container">
						<form  method="post" action="amigos.php?go"  id="searchform" align=center> 
							<div class="col-xs-10">
								<input  type="text" class="form-control input-lg" name="amigo" placeholder="Ingresa el nombre de usuario de un amigo">
							</div>
							<input  type="submit" class="btn btn-info btn-lg" name="submit" value="Buscar Amigos"> 
						</form> 
					<div>
					<form action="welcome.php" align=right>
							<input type="Submit" class="btn btn-danger btn-lg" value="Regresar">
					</form> 
					
					<?php
                        
                        
                       
                        $valor = "valor";
						  if(isset($_POST['submit'])){
						  if(isset($_GET['go'])){    
                              //********************    
                          
                              
                              
                              
                              //POST ES LA CONEXION DEL HTML INPUT AL PHP
                          $amigo=$_POST['amigo'];
                   
                            //QUERY
                            $sql="SELECT amigo  FROM amigos WHERE pertenece_a_usuario LIKE '$usuario' AND amigo LIKE '$amigo'";
                              
                              //CONSULTA DE SQL
						  $result=mysqli_query($conn, $sql);
                              
                              
                              
                              //PASAR TABLA DE CONSULTA OBTENIDA A UN ARRAY PHP
						  if($row=mysqli_fetch_array($result)){
                              $valor  =$row['amigo']; 
                          }else{
                              $valor = null;
                          }
                                 echo $valor;
                                 
                                 
                                 
                              
                              if(preg_match("/^[  a-zA-Z]+/", $valor) && $valor != null){
                                  $user=$valor;
                        
                             
                                  
                                  $sql="SELECT  * FROM usuario WHERE nombre_de_usuario = '$user'";
							  
                                  //-run  the query against the mysql query function
                                    $result=mysqli_query($conn, $sql);
							  
                                  //-create  while loop and loop through result set
                                  while($row=mysqli_fetch_array($result)){
								  $username  =$row['nombre_de_usuario'];
								  $nombre  =$row['nombre_real'];
								  $apellido  =$row['apellido_real'];
								  $fecha  =$row['fecha_nac'];
								  $tel  =$row['telefono'];
                                    
							  
						  //-display the result of the array
						  echo "<ul>\n";
						  echo "<li>Nombre de usuario: " .$username."</li>\n";
						  echo "<li>Nombre: " .$nombre."</li>\n";
						  echo "<li>Apellido(s): " .$apellido."</li>\n";
						  echo "<li>Fecha de nacimiento: " .$fecha."</li>\n";
						  echo "<li>Telefono de contacto: " .$tel."</li>\n";
						  echo "</ul>";
						  }
                              
						  }
						  else{
                            
                          $amigo_err = "Por favor ingresa un nombre de usuario que exista y sea tu amigo";
						  echo  "<h4 align=center>$amigo_err</h4>";
						  }
                              
                           //*******************************   
						  
            
                          }
                          }
                        
						  $conn->close();
                        
                          
					?>
				</div>
			</div>
		</div>
	</body> 
</html>