
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

    $usuarioSESSION = trim($_SESSION['username']);

	// Define variables and initialize with empty values
     $texto_publicacion  = $nombre_publicacion  = "";
     $texto_publicacion_err = $nombre_publicacion_err  = "";

    // Processing form data when form is submitted

    if($_SERVER["REQUEST_METHOD"] == "POST"){


     $usuario = trim($_SESSION['username']);

        // Validate nombre_publicacion
        if(empty(trim($_POST['nombre_publicacion']))){
            $nombre_publicacion_err = "Por favor escriba un nombre para su publicación.";     
        }else{
            $nombre_publicacion = trim($_POST['nombre_publicacion']);
        }

    	// Validate texto_publicacion
        if(empty(trim($_POST['texto_publicacion']))){
            $texto_publicacion_err = "Por favor escriba lo que quiere publicar.";     
        }else{
            $texto_publicacion = trim($_POST['texto_publicacion']);
        }
		

        

        // Check input errors before inserting in database
        if(empty($texto_publicacion_err) && empty($nombre_publicacion_err)){

            // Prepare an insert statement
            $sql = "INSERT INTO publicaciones (nom_usu,nombre_publicacion, texto_publicacion) VALUES (?,?, ?)";
			
			if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss",$param_usuario, $param_nombre_publicacion, $param_texto_publicacion);

                // Set parameters
               
                $param_nombre_publicacion = $nombre_publicacion;
                $param_texto_publicacion = $texto_publicacion;
                 $param_usuario = $usuario;  
			
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    echo "Publicación agregada.";
                } else{
                    echo "Eliga otro nombre para su publicación.";
                }
            }
			

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nueva Publicación</title>
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
				<h1>Nueva Publicación</h1>
				<h4>Dale un título a tu publicación y escribe su contenido.</h4>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($nombre_publicacion_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="nombre_publicacion" class="form-control" placeholder="Nombre" value="<?php echo $nombre_publicacion; ?>">
						<span class="help-block"><?php echo $nombre_publicacion_err; ?></span>
					</div> 
					
					<div class="form-group <?php echo (!empty($texto_publicacion_err)) ? 'has-error' : ''; ?>">
						<!-- si no guarda el texto de publicación cambiar 'textarea' por 'input type="text"' y eliminar </textarea> -->
						<textarea name="texto_publicacion" class="form-control" rows="5" placeholder="Escribe aquí el contenido de tu publicación." value="<?php echo $texto_publicacion; ?>"></textarea>
						<span class="help-block"><?php echo $texto_publicacion_err; ?></span>
					</div>      
					
					<div class="form-group" align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						<input type="reset" class="btn btn-info btn-lg" value="Borrar Campos">
						<input type="submit" class="btn btn-success btn-lg" value="Publicar!">
						
					</div>
					
				</form>
			<div>
        </div>    
    </body>
</html>