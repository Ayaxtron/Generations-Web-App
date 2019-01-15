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
     $nombre  = $descripcion = $limite = "";
      $nombre_err = $descripcion_err = $limite_err = "";


    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        
        
        // Validate nombre
        if(empty(trim($_POST['nombre']))){
            $nombre_err = "Por favor escriba el nombre.";     
        }else{
            $nombre = trim($_POST['nombre']);
        }
        
        // Validate descripcion
        if(empty(trim($_POST['descripcion']))){
            $descripcion_err = "Por favor escriba la descripcion.";     
        }else{
            $descripcion = trim($_POST['descripcion']);
        }
        
        // Validate limite
        if(empty(trim($_POST['limite']))){
            $limite_err = "Por favor escriba el limite.";     
        }else{
            $limite = trim($_POST['limite']);
        }
        
        
        // Check input errors before inserting in database
        if(empty($nombre_err) && empty($descripcion_err) && empty($limite_err)){

            // Prepare an insert statement
            $sql = "INSERT INTO grupos (nombre, descripcion, limite) VALUES (?, ?, ?)";
      
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_descripcion, $param_limite);

                // Set parameters
               
                $param_nombre = $nombre;
                $param_descripcion = $descripcion;
                $param_limite = $limite;;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    //echo "Grupo creado exitosamente.";
                    //*****************************************************************************************************************************
                    
                    // Unirte a un grupo ya de paso
            $sql2 = "INSERT INTO miembros (pertenece_usuario,	admin,	al_grupo) VALUES ('$user',1, '$nombre')";
                    if(mysqli_query($conn, $sql2)){
                        echo "Grupo creado exitosamente";
                    }
                    //*****************************************************************************************************************************
                    
                } else{
                    echo "Ya existe un grupo con ese nombre";
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
        <title>Crear nuevo Grupo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css"></style>
    </head>
    <body>
		<div>
			<br>
			<br>
			<br>
		</div>
		
        <div class="container">
			<div class="jumbotron">
				<h1>Registrar Nuevo Grupo </h1>
				<h2>Llena este formulario para guardar un nuevo grupo.</h2>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					 
					
					<div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="nombre" class="form-control input-lg" placeholder="Nombre" value="<?php echo $nombre; ?>">
						<span class="help-block"><?php echo $nombre_err; ?></span>
					</div>    
					
					<div class="form-group  <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="descripcion" class="form-control input-lg" placeholder="Descripción" value="<?php echo $descripcion; ?>">
						<span class="help-block"><?php echo $descripcion_err; ?></span>
					</div>  

					<div class="form-group <?php echo (!empty($limite_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="limite" class="form-control input-lg" placeholder="Limite de Integrantes" value="<?php echo $limite; ?>">
						<span class="help-block"><?php echo $limite_err; ?></span>
					</div>   
					
					<div class="form-group" align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						
						<input type="submit" class="btn btn-success btn-lg" value="Confirmar">
						
					</div>
					
				</form>
			</div>
        </div>    
    </body>
</html>