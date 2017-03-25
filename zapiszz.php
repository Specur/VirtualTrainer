<?php

session_start();
	require_once "conect.php" ;
try
		{
		$produkt= $_POST['NAZWA_PRODUKT']; 
		$kcl= $_POST['KCL'];
		$weglowodany= $_POST['WEGLOWODANY']; 
		$bialko= $_POST['BIALKO'];
		$tluszcz= $_POST['TLUSZCZ'];

		$poprawne_logowanie = true;
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		@mysql_query("START TRANSACTION ");
		if($poprawne_logowanie == true){
			if($polaczenie->query("INSERT INTO ProduktTymczasowy VALUES(NULL, '$produkt', '$kcl', '$weglowodany', '$bialko', 														'$tluszcz' )"))
			{
				@mysql_query("COMMIT");
			$_SESSION['okkkk'] = "Dziękujemy za pomoc w rozwoju strony:) Produkt został dodany prawidłowo. Jeżeli przejdzie pomyślnie weryfikacje przez administratora to już wkrótce pojawi się na stronie.";
			header("Location: dodawaj.php");
		
			}else
		            {
					@mysql_query("ROLLBACK");
		                throw new Exception($polaczenie->error);
		            }

		}


		$polaczenie->close();


		}
	}
	catch(Exception $e)
	{
		echo ' BLĄD SERWERA PROSZE LOGOWAĆ SIĘ W INNYM TERMINIE ';
	}





?>
