
<?php
	session_start();
	require_once "conect.php" ;
try
	{
		$cel= $_POST['cel']; 
		$iid =$_SESSION['id'];
		$ilosc = $_POST['ilosc'];
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		
		
		if($polaczenie->query("INSERT INTO Dni VALUES(NULL, '$iid', '$cel', '".date('Y-m-d')."','$ilosc' )"))
		{
		$_SESSION['udanarejestracja'] = true;
		
		header("Location: trener.php");
		
		}else
                    {
                        throw new Exception($polaczenie->error);
                    }

		


		$polaczenie->close();


		}
	}
	catch(Exception $e)
	{
		echo $e;
	}

	?>
