<?php
 
//Basado en: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
    
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

$usuarioSESSION = trim($_SESSION['username']);

    //Inicializcion de variables
    $amigo  = $confirmar_amigo = "";
    $amigo_err  = $confirmar_amigo_err = "";

    // Processing form data when form is submitted 
    //al darle submit entra aqui
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //Session
        $usuario = trim($_SESSION['username']);
        
       // echo "0";
        
        // Validate amigo
        //****************************************************
        
         if(empty(trim($_POST["amigo"]))){
            $amigo_err = "Por favor escriba el nombre de usuario del amigo";
        } else{
            // Prepare a select statement
            $sql = "SELECT nombre_de_usuario FROM usuario WHERE nombre_de_usuario = ?";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_amigo);

                // Set parameters
                $param_amigo = trim($_POST["amigo"]);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 0){
                        $amigo_err = "ERROR: Este usuario no existe.";
                        //echo "1";
                    } else{
                        $prueba1 = trim($_POST["amigo"]);
                        $amigo_err = null;
                        //echo "1";
                        $sql2 = "SELECT amigo FROM amigos WHERE pertenece_a_usuario = '$usuarioSESSION'     AND amigo = '$prueba1'";
            
                        
            if($stmt = mysqli_prepare($conn, $sql2)){
                
                
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_amigoExi);

                // Set parameters
                $param_amigoExi = trim($_POST["amigo"]);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 0){
                        
                        $amigo = trim($_POST["amigo"]);
                       $amigo_err = null;
                        
                        //echo "2";
                        
                    } else{
                        $amigo_err = "ERROR: Este usuario ya fue agregado";
                        $amigo = null;
                        //echo "2";
                    }           
                    
                
                }
            }
                        
                    }
        //************************************************
        //REVISAR QUE NO ESTEN VACIO
        // Check input errors before inserting in database
                    
        //SEGUNDA VALIDACION, REPITE? **********************************************************************************************
        
                    //amigo existe, ya  lo tienes?
                    
         
                    
                    
                    
                    
                    
                    
                    
        //SEGUNDA VALIDACION, REPITE? **********************************************************************************************
                    
        if(empty($amigo_err) && empty($usuario_err)){

            
            //INSERCION DE DATOS AL SQL, SE ENVIAN PARAMETROS, Y ESOS SALEN DE LAS VARIABLES
            // Prepare an insert statement
            //INTO {LA TABLA EN LA QUE SE VA A PONER}
            $sql = "INSERT INTO amigos (amigo, pertenece_a_usuario) VALUES (?, ?)"; 
            //{?'s iguales al tupple'}
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                //Ligamos aqui la vraiable para que sea
                mysqli_stmt_bind_param($stmt, "ss", $param_amigo, $param_usuario);

                //s's iguales al numero de variables de la tabla, o el tupple y antes va el statement o bien stmt
                
                // Set parameters
               
                $param_amigo = $amigo;
                $param_usuario = $usuario;            

            
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    echo "Amigo agregado.";
                } else{
                    echo "Algo salio mal, pruebe despues";
                }
                 
                
                
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
        // Close connection
        mysqli_close($conn);
    
                
                
                    
                }
            }
         }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar Amigo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css"></style>
    </head>
	
    <body>
		<div class="container">
			<br>
			<br>
			<br>
		</div>
		
        <div class="container">
			<div class="jumbotron">
				<h1>Añadir a un amigo</h1>
				
				<!-- Se añade la funcion post al formulario para enviarlo -->
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<div class="form-group <?php echo (!empty($amigo_err)) ? 'has-error' : ''; ?>">
						<input type="text" name="amigo" class="form-control" placeholder="Nombre de usuario" value="<?php echo $amigo; ?>">
						<span class="help-block"><?php echo $amigo_err; ?></span>
					</div>    
					
					<div class="form-group" align=left>
						
					</div>
					<div class="form-group" align=right>
					<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						
                        <a href="welcome.php"><input href="welcome.php" type="submit" class="btn btn-success btn-lg" value="Enviar"></a>
					</div>

					
					
				</form>
			</div>
        </div>    
    </body>
</html>