<?php
	session_start();
	require_once "conect.php" ;

	$id= $_POST['id']; 
	
	try
	{
	

$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{

if($polaczenie->query("DELETE FROM Dni WHERE id_dni='$id'  "))
		{
		header("Location: trener.php");
		
		}else
                    {
                        throw new Exception($polaczenie->error);
                    }

		}


		$polaczenie->close();


	}
	catch(Exception $e)
	{
		echo ' BLAD SERWERA PROSZE LOGOWAC SIE W INNYM TERMINIE ';
	}


		
	







	
	
		
?>
