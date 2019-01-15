<?php
    //Basado en: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
   include("database.php");
   session_start();

    $username = $password = "";
    $username_err = $password_err = "";
   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
      
   // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Por favor, escribe tu nombre de usuario.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Por favor, escribe tu contraseña.';
    } else{
        $password = trim($_POST['password']);
    }
        
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        //Seleccionar que "seleccionaremos" de la base de datos
        $sql = "SELECT nombre_de_usuario, contrasenia FROM usuario WHERE nombre_de_usuario = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Contraseña incorrecta.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No existe ninguna cuenta registrada con ese usuario.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css"></style>
    </head>
    
	<body>
		<div class="container">
			<br>
			<br>
			<br>
		</div>
		
		<div class = "container">
			
			<div class="jumbotron">
				<h1 align=center>Generations</h1>
				<h2 align=center >Iniciar Sesión</h2>
				
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?> ">
						<input type="text" name="username"class="form-control input-lg" placeholder="Usuario" value="<?php echo $username; ?>">
						<span class="help-block"><?php echo $username_err; ?></span>
					</div>
					
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						<input type="password" name="password" class="form-control input-lg" placeholder="Contraseña">
						<span class="help-block"><?php echo $password_err; ?></span>
					</div>
					
					<div class="form-group">
						<p align=center><input type="submit" class="btn btn-success btn-lg" value="Entrar"></p>
					</div>
					
					<br>
					
					<h2 align=center>¿No tienes una cuenta? <a href="registration.php">Regístrate</a></h2>
					
				</form>
			</div>
			
		</div>
	</body>

</html>