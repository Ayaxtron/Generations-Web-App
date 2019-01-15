<?php
  //LLAMAR A LOS METODOS DE SESSION
session_start();
	error_reporting(E_ERROR | E_PARSE);	
///llamar a la base de datos de XAMPP
    require_once 'database.php';

    // If session variable is not set it will redirect to login page
    if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
      header("location: login.php");
      exit;
    }
    
	// Define variables and initialize with empty values
    $nombre_publicacion = $texto_publicacion = "";
	$nombre_publicacion_err = $texto_publicacion_err = "";
	
	$get=mysqli_query($conn, "SELECT nombre_publicacion, texto_publicacion FROM publicaciones ORDER BY nombre_publicacion ASC");
    $option = '';
	$name = '';
     while($row = mysqli_fetch_assoc($get))
    {
      $option .= '<option value = "'.$row['nombre_publicacion'].'">'.$row['nombre_publicacion'].'</option>';
	  $name .= '<option value = "'.$row['texto_publicacion'].'">'.$row['texto_publicacion'].'</option>';
	  
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty(trim($_POST['nombre_publicacion']))){
            $nombre_publicacion_err = "Por favor seleccione el nombre de la publicación."; 
        }else{
            $nombre_publicacion = trim($_POST['nombre_publicacion']);
        }
		
        if(empty(trim($_POST['texto_publicacion']))){
            $texto_publicacion_err = "Por favor seleccione el texto de la publicación.";     
        }else{
            $texto_publicacion = trim($_POST['texto_publicacion']);
        }
        
        
        // Check input errors before inserting in database
        if(empty($nombre_publicacion_err) && empty($texto_publicacion_err)){

			$sql = "DELETE FROM publicaciones WHERE nombre_publicacion = '$nombre_publicacion' AND texto_publicacion = '$texto_publicacion'";

			if (mysqli_query($conn, $sql)) {
				echo "Publicación eliminada exitosamente";
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
        <title>Eliminar Publicación</title>
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
				<h1>Eliminar Publicación</h1>
				<h2>¡Cuidado! Esta acción no se puede deshacer.</h2>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<div class="form-group <?php echo (!empty($nombre_publicacion_err)) ? 'has-error' : ''; ?>">
						<select name="nombre_publicacion" class="form-control">
							<option disabled selected value>Selecciona la publicación a borrar</option>        
							<?php echo $option; ?>
						  </select>
						<span class="help-block"><?php echo $nombre_publicacion_err; ?></span>
					</div>    
					
					<div class="form-group <?php echo (!empty($texto_publicacion_err)) ? 'has-error' : ''; ?>">
						<select name="texto_publicacion" class="form-control">
							<option disabled selected value>Selecciona el texto de la publicación</option>        
							<?php echo $name;?>
						  </select>
						<span class="help-block"><?php echo $texto_publicacion_err; ?></span>
					</div>

					<div class="form-group" align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						<input type="submit" class="btn btn-success btn-lg" value="Borrar Publicación">
					</div>
					
				</form>
			</div>
        </div>    
    </body>
</html>