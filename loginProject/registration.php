<?php
    //Basado en: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
    require_once 'database.php';

    
	// Define variables and initialize with empty values
    $username = $password = $confirm_password = $nombre = $tel = $apellido = $nacimiento = "";
    $username_err = $password_err = $confirm_password_err = $nombre_err = $apellido_err = $nacimiento_err = $tel_err = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor, escribe tu nombre de usuario.";
        } else{
            // Prepare a select statement
            $sql = "SELECT nombre_de_usuario FROM usuario WHERE nombre_de_usuario = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "Este nombre de ususario ya existe.";
                    } else{
                        $username = trim($_POST["username"]);
                    }
                } else{
                    echo "Vuelve a intentar más tarde";
                }
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }

        // Validate password
        if(empty(trim($_POST['password']))){
            $password_err = "Por favor, escribe tu contraseña.";     
        } elseif(strlen(trim($_POST['password'])) < 6){
            $password_err = "La contraseña debe tener al menos 6 caracteres.";
        } else{
            $password = trim($_POST['password']);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = 'Por favor confirma tu contraseña.';     
        } else{
            $confirm_password = trim($_POST['confirm_password']);
            if($password != $confirm_password){
                $confirm_password_err = 'Las contraseñas no coinciden.';
            }
        }
//*********************************************************************
        
        //Nombre
        if(empty(trim($_POST['nombre']))){
            $nombre_err = "Por favor, escribe tu nombre.";     
        }else{
            $nombre = trim($_POST['nombre']);
        }
        
        //Apellido
        if(empty(trim($_POST['apellido']))){
            $apellido_err = "Por favor, algun apellido.";     
        }else{
            $apellido = trim($_POST['apellido']);
        }
        
        //Telefono
        if(empty(trim($_POST['tel']))){
            $tel_err = "Por favor, algun telefono de contacto.";     
        }else{
            $tel = trim($_POST['tel']);
        }
        
        //fecha
        if(empty(trim($_POST['nacimiento']))){
            $nacimiento_err = "Por favor, marca tu fecha de nacimiento.";     
        }else{
            $nacimiento = trim($_POST['nacimiento']);
        }
//********************************************************************
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($nombre_err) && empty($apellido_err) && empty($nacimiento_err)){

            // Prepare an insert statement
            $sql = "INSERT INTO usuario (nombre_de_usuario, contrasenia, nombre_real, apellido_real, fecha_nac, telefono) VALUES (?, ?,?,?,?,?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_password, $param_nombre, $param_apellido, $param_nacimiento, $param_tel);

                // Set parameters
                $param_username = $username;
               
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                 $param_nombre = $nombre;
                $param_apellido = $apellido;
                $param_nacimiento = $nacimiento;
                $param_tel = $tel;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
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
        <title>Registro</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css"></style>
    </head>
	
    <body>
		<div class="container">
			
		</div>
		
		<div class="container">
			<div class="jumbotron">
			
            <h1>Regístrate</h1>
            <h3>Por favor, ingrese sus datos</h3>
			
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
					
						<input type="text" name="username"class="form-control input-lg" placeholder="Usuario" value="<?php echo $username; ?>">
						<span class="help-block"><?php echo $username_err; ?></span>
						
					</div>
					
					<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
						
						<input type="password" name="password" class="form-control input-lg" placeholder="Contraseña" value="<?php echo $password; ?>">
						<span class="help-block"><?php echo $password_err; ?></span>
						
					</div>
					
					<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						
						<input type="password" name="confirm_password" class="form-control input-lg" placeholder="Confirmar Contraseña" value="<?php echo $confirm_password; ?>">
						<span class="help-block"><?php echo $confirm_password_err; ?></span>
						
					</div>
                    
                    <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
						
						<input type="text" name="nombre" class="form-control input-lg" placeholder="Nombre real, confidencial sólo visible para amigos" value="<?php echo $nombre; ?>">
						<span class="help-block"><?php echo $nombre_err; ?></span>
						
					</div>
                    
                    <div class="form-group <?php echo (!empty($apellido_err)) ? 'has-error' : ''; ?>">
						
						<input type="text" name="apellido" class="form-control input-lg" placeholder="Uno o más Apellidos reales, confidencial sólo visible para amigos" value="<?php echo $apellido; ?>">
						<span class="help-block"><?php echo $apellido_err; ?></span>
						
					</div>
                    
                    <div class="form-group <?php echo (!empty($tel_err)) ? 'has-error' : ''; ?>">
						
						<input type="text" name="tel" class="form-control input-lg" placeholder="Telefono de contacto, confidencial sólo visible para amigos" value="<?php echo $tel; ?>">
						<span class="help-block"><?php echo $tel_err; ?></span>
						
					</div>
                    
                      <div class="form-group <?php echo (!empty($nacimiento_err)) ? 'has-error' : ''; ?>">
						<h3>Por favor, ingrese su fecha de nacimiento</h3>
						<input type="date" name="nacimiento" class="form-control input-lg" placeholder="Fecha de nacimiento real, confidencial sólo visible para amigos" value="<?php echo $nacimiento; ?>">
						<span class="help-block"><?php echo $nacimiento_err; ?></span>
						
					</div>
					
					<div class="form-group">
						
						<p align=right><input type="reset" class="btn btn-default btn-lg" value="Vaciar Campos">
						<input type="submit" class="btn btn-success btn-lg" value="Registrame!" align="right"></p>
						
					</div>
					
					<h3 align=center>¿Ya tienes una cuenta? <a href="login.php">Inicia Sesión</a>.</h3>
					
				</form>
			</div>    
		</div>
	</body>
	
</html>