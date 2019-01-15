<?php
    //Creates the connection with the database
	$servername = "localhost";
	$username = "root";
	$password = "";
	
	$conn = new mysqli($servername, $username, $password, "generations");
	if(!$conn)
	{
		die("Connection failed: " . mysql_error());
	}
	
?>