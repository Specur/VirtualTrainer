<?php
	session_start();
	require_once "conect.php" ;

	$obrazek_inspiracje= $_POST['obrazek_inspiracje']; 
	$opis_inspiracje= $_POST['opis_inspiracje']; 
	$nazwa_inspiracje= $_POST['nazwa_inspiracje']; 
	$przycisk= $_POST['przycisk'];
	
	try
	{
	if($przycisk =='DODAJ' ){
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		
		if($polaczenie->query("INSERT INTO Inspiracje VALUES(NULL, '$obrazek_inspiracje', '$opis_inspiracje', '$nazwa_inspiracje')"))
		{
		header("Location: admin.php");
		
		}else
                    {
                        throw new Exception($polaczenie->error);
                    }

		}


		$polaczenie->close();


		
}else{

$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		
if($polaczenie->query("DELETE FROM InspiracjeTymczasowy WHERE obrazek='$obrazek_inspiracje' and opis='$opis_inspiracje' and nazwa ='$nazwa_inspiracje' "))
		{
		header("Location: admin.php");
		
		}else
                    {
                        throw new Exception($polaczenie->error);
                    }

		}


		$polaczenie->close();

}
	}
	catch(Exception $e)
	{
		echo ' BLAD SERWERA PROSZE LOGOWAC SIE W INNYM TERMINIE ';
	}


		
	







	
	
		
?>
