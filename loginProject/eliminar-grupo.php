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

$user = trim($_SESSION['username']);

    
	// Define variables and initialize with empty values
     $grupo =  "";
	 $grupo_err =  "";
	
	$get=mysqli_query($conn, "SELECT usuario, grupo FROM pertenencia_gru WHERE usuario = '$user' ORDER BY grupo ASC");
    

     while($row = mysqli_fetch_assoc($get))
    {
	  $grupo .= '<option value = "'.$row['grupo'].'">'.$row['grupo'].'</option>';
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
		
        if(empty(trim($_POST['grupo']))){
            $grupo = "Por favor selecciona el nombre.";     
        }else{
            $grupo = trim($_POST['grupo']);
        }
        
        
        
        // Check input errors before inserting in database
        if(empty($grupo_err)){

			$sql = "DELETE FROM pertenencia_gru WHERE usuario = '$user' AND nombre = '$grupo'";

			if (mysqli_query($conn, $sql)) {
				echo "Grupo eliminado exitosamente";
			} else {
				echo "Error deleting record: " . mysqli_error($conn);
			}
        }
        
        // Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Borrar Grupo</title>
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
				<h1>Salir de un Grupo</h1>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					   
					
					<div class="form-group input-lg <?php echo (!empty($grupo_err)) ? 'has-error' : ''; ?>">
						<select name="grupo" class="form-control">
							<option disabled selected value>Selecciona el Nombre del Grupo</option>        
							<?php echo $grupo;?>
						  </select>
						<span class="help-block"><?php echo $grupo_err; ?></span>
					</div>
					

					<div class="form-group" align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						<input type="submit" class="btn btn-success btn-lg" value="Sacame del Grupo!">
					</div>
				</form>
			</div>
        </div>    
    </body>
</html>