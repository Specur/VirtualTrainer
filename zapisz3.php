<?php

session_start();
	require_once "conect.php" ;
try
		{
		$nazwa= $_POST['NAZWA']; 
		$page= $_POST['homepage'];
		$text= $_POST['TEXT1']; 
		

		$poprawne_logowanie = true;
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		if($poprawne_logowanie == true){
			if($polaczenie->query("INSERT INTO InspiracjeTymczasowy VALUES(NULL, '$page', '$text', '$nazwa' )"))
			{
			$_SESSION['okkkk'] = "Dziękujemy za pomoc w rozwoju strony:) Inspiracja została dodana prawidłowo. Jeżeli przejdzie pomyślnie weryfikacje przez administratora to już wkrótce pojawi się na stronie.";
			header("Location: dodawaj.php");
		
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
		echo ' BLĄD SERWERA PROSZE LOGOWAĆ SIĘ W INNYM TERMINIE ';
	}





?>
