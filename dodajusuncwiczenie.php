<?php
	session_start();
	require_once "conect.php" ;

	$nazwa_cwiczenie= $_POST['nazwa_cwiczenie']; 
	$trudnosc_cwiczenie= $_POST['trudnosc_cwiczenie']; 
	$opis_cwiczenie= $_POST['opis_cwiczenie']; 
	$rodzaj_cwiczenie= $_POST['rodzaj_cwiczenie']; 
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
		
		if($polaczenie->query("INSERT INTO Cwiczenia VALUES(NULL, '$nazwa_cwiczenie', '$trudnosc_cwiczenie', '$opis_cwiczenie', '$rodzaj_cwiczenie')"))
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
		
		if($polaczenie->query("DELETE FROM CwiczeniaTymczasowy WHERE nazwa='$nazwa_cwiczenie' and trudnosc='$trudnosc_cwiczenie' and opis ='$opis_cwiczenie' and rodzaj='$rodzaj_cwiczenie' "))
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
