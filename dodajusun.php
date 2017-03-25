<?php
	session_start();
	require_once "conect.php" ;

	$nazwa_produkt= $_POST['nazwa_produkt']; 
	$kalorie_produkt= $_POST['kalorie_produkt']; 
	$weglowodany_produkt= $_POST['weglowodany_produkt']; 
	$bialka_produkt= $_POST['bialka_produkt']; 
	$tluszcz_produkt= $_POST['tluszcz_produkt'];
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
		
		if($polaczenie->query("INSERT INTO Produkt VALUES(NULL, '$nazwa_produkt', '$kalorie_produkt', '$weglowodany_produkt', '$bialka_produkt', '$tluszcz_produkt')"))
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
		
		if($polaczenie->query("DELETE FROM ProduktTymczasowy WHERE nazwa='$nazwa_produkt' and kalorie='$kalorie_produkt' and weglowodany ='$weglowodany_produkt' and bialka='$bialka_produkt' and tluszcz ='$tluszcz_produkt'"))
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
