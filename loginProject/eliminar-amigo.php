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
    $amigo = $user = "";
     $amigo_err = $user_err = "";
	

//*************************

    
        $user = trim($_SESSION[('username')]);

	$get=mysqli_query($conn, "SELECT amigo, pertenece_a_usuario FROM amigos WHERE pertenece_a_usuario = '$user' ORDER BY amigo ASC");
    $option = '';
     while($row = mysqli_fetch_assoc($get))
    {
      $option .= '<option value = "'.$row['amigo'].'">'.$row['amigo'].'</option>';
    }

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(empty(trim($_POST['amigo']))){
            $amigo_err = "Por favor selecciona el nombre de usuario";     
        }else{
            $amigo = trim($_POST['amigo']);
        }
		
        
        
        // Check input errors before inserting in database
        if(empty($amigo_err)){

			$sql = "DELETE FROM amigos WHERE amigo = '$amigo' AND pertenece_a_usuario = '$user'";

			if (mysqli_query($conn, $sql)) {
				echo "Amigo eliminado exitosamente, vuelve al menu para ver los cambios ";
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
        <title>Borrar Amigo</title>
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
				<h1>Eliminar amigo</h1>
				<h2>Esta accion no se puede deshacer, verifique que los datos de la persona coinciden al seleccionarlos.</h2>
				<!-- POST es para enviar-->
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					
					<!--recuperar los que ya estan en la base de datos-->
					<div class="form-group <?php echo (!empty($amigo_err)) ? 'has-error' : ''; ?>">
						<select name="amigo" class="form-control">
							<option disabled selected value>Nombre de usuario del amigo</option>        
							<?php echo $option; ?>
						</select>
						<span class="help-block"><?php echo $amigo_err; ?></span>
					</div>    
					
					<!--END-->
					
					
					<div class="form-group" align=right>
						<a href="welcome.php"><button type="button" class="btn btn-danger btn-lg" href="welcome.php">Regresar</button></a>
						<a href="welcome.php"><input  type="submit" class="btn btn-success btn-lg" value="Borrar!"></a>
					</div>
					
				</form>
			</div>
        </div>    
    </body>
</html>