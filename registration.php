<?php
	session_start();
	require_once "conect.php" ;

	if(isset($_POST['imie']))
		{	
			//udana walidacja
			$poprawne_logowanie = true;


			//sprawdzenie lat i wagi	
		$wiek= $_POST['wiek']; 
		$waga= $_POST['waga'];
		if((is_int($wiek)))
		{
			$poprawne_logowanie = false;
			$_SESSION['error_wiek']= "Prosze podać poprawny wiek!";			
		}

		if(strlen($wiek) > 2 )
		{
			$poprawne_logowanie = false;
			$_SESSION['error_wiek']= "Prosze podać poprawny wiek!";
		}	
		
		if((is_int($waga)))
		{
			$poprawne_logowanie = false;
			$_SESSION['error_waga']= "Prosze podać poprawną wagę!";
		}

		if(strlen($waga) > 3 )
		{
			$poprawne_logowanie = false;
			$_SESSION['error_waga']= "Prosze podac poprawną wagę";
		}


			//sprawdzam nick
		$login= $_POST['login']; 
		$login=	htmlentities($login, ENT_QUOTES, "UTF-8");
		if(strlen($login)<3 || (strlen($login)>20))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_login']= "Login musi posiadać od 5 do 15 zaków!";
		}


		//if(ctype_alnum($login)	==	false)
	//	{
	 //       $poprawne_logowanie = false;
	//	$_SESSION['error_login']= "Login musi skladac sie tylko z liter i cyfr(bez polskich znakow)!";
	//	}
	
			//sprawdzam imie
		$imie = $_POST['imie']; 
		if(!preg_match('/^[\pL \'-]*$/u', $imie))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_imie']= "Prosze podać poprawne imie!";
		}
		if(empty($imie))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_imie']= "Imie nie może być puste!";
		}
		
		$imie=	htmlentities($imie, ENT_QUOTES, "UTF-8");
	

	
			//sprawdzam email
		$email=$_POST['email'];
		$email=	htmlentities($email, ENT_QUOTES, "UTF-8");
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

		if(filter_var($emailB, FILTER_VALIDATE_EMAIL)==false || ($emailB !=$email))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_email']= "Blędny e-mail!";
		}

			//sprawdzam poprawnosc hasla
		$haslo= $_POST['haslo']; 
		$haslo2= $_POST['haslo2'];
		if(strlen($haslo)<7 || (strlen($haslo)>20))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_haslo']= "Haslo musi posiadać od 7 do 20 zaków!";
		}

		if($haslo != $haslo2)
		{
		$poprawne_logowanie = false;
		$_SESSION['error_haslo']= "Podane hasła nie są identyczne!";
		}
		$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

			//sprawdzanie checkbox'a
	
		if(!isset($_POST['regulamin']))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_regulamin']= "Aby się zarejestrować trzeba potwierdzic regulamin!";
		}

			
		//Zapamiętaj wprowadzone dane
       				$_SESSION['fr_login'] = $login;
       				$_SESSION['fr_email'] = $email;
				$_SESSION['fr_imie'] = $imie;
       				$_SESSION['fr_waga'] = $waga;
				$_SESSION['fr_wiek'] = $wiek;
       			 
			mysqli_report(MYSQLI_REPORT_STRICT);
			//laczenie z baza
		try
		{
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
			@mysql_query("START TRANSACTION ");
		$rezultat = $polaczenie->query("SELECT * FROM Uzytkownik WHERE login='$login'");

		if(!$rezultat) throw new Exception($polaczenie->error);

		$ile_takich_loginow = $rezultat->num_rows;
		if($ile_takich_loginow>0)
		{
		$poprawne_logowanie = false;
	
		$_SESSION['error_login']= "Taki nick już istnieje";
		}
		if($poprawne_logowanie == true){
			if($polaczenie->query("INSERT INTO Uzytkownik VALUES(NULL, '$login', '$haslo_hash','0', '$email', '$imie', 														'$wiek','$waga','0','Utrzymac wage')"))
			{
			@mysql_query("COMMIT");
			$_SESSION['zarejestrowanoo'] = "Udana rejestracja";
			header("Location: index.php");
		
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
		echo $e;
	}

}


	
	
		
?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
<noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

   	 <meta charset="utf-8" />
   	 <title>VirtualTrainer</title>
	 <script src='https://www.google.com/recaptcha/api.js'></script> 
   	 <link rel="stylesheet" href="style.css" type="text/css" />
     
</head>
 
<body>
 
<div id="container2">
        
				<!--title -->
	<div id="title"><b>Virtual</b>Trainer</div>

	<form method="post">	
				<!--input imie-->
			<input type="text" placeholder="imie:" value="<?php
            if (isset($_SESSION['fr_imie']))
            {
                echo $_SESSION['fr_imie'];
                unset($_SESSION['fr_imie']);
            }
        	?>" name="imie" onfocus="this.placeholder=''" onblur="this.placeholder='imie'" >
	
	<?php 
	if(isset($_SESSION['error_imie'])){
	echo '<div class="error">'.$_SESSION['error_imie'].'</div>';
	unset($_SESSION['error_imie']);
		}
	?>
				<!--input email-->
			<input type="email" placeholder="email:"
	value="<?php
            if (isset($_SESSION['fr_email']))
            {
                echo $_SESSION['fr_email'];
                unset($_SESSION['fr_email']);
            }
        	?>" name="email" onfocus="this.placeholder=''" onblur="this.placeholder='email'" >
	<?php 
	if(isset($_SESSION['error_email'])){
	echo '<div class="error">'.$_SESSION['error_email'].'</div>';
	unset($_SESSION['error_email']);
	}
	?>
				<!--input login-->
            		<input type="text" placeholder="login:"
	value="<?php
            if (isset($_SESSION['fr_login']))
            {
                echo $_SESSION['fr_login'];
                unset($_SESSION['fr_login']);
            }
        	?>" name="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" >
	<?php 
	if(isset($_SESSION['error_login'])){
	echo '<div class="error">'.$_SESSION['error_login'].'</div>';
	unset($_SESSION['error_login']);
	}
	?>
             			<!--input haslo-->
           		<input type="password" placeholder="hasło:" name="haslo"
			 onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >
	<?php 
	if(isset($_SESSION['error_haslo'])){
	echo '<div class="error">'.$_SESSION['error_haslo'].'</div>';
	unset($_SESSION['error_haslo']);
	}
	?>
				<!--input powtorz haslo-->
			<input type="password" placeholder="powtórz hasło:" name="haslo2"
			 onfocus="this.placeholder=''" onblur="this.placeholder='powtórz hasło'" >

				<!--input wiek-->
			<input type="number" placeholder="wiek:"
		value="<?php
            if (isset($_SESSION['fr_wiek']))
            {
                echo $_SESSION['fr_wiek'];
                unset($_SESSION['fr_wiek']);
            }
        	?>" name="wiek"	 onfocus="this.placeholder=''" onblur="this.placeholder='wiek'" >
	<?php 
	if(isset($_SESSION['error_wiek'])){
	echo '<div class="error">'.$_SESSION['error_wiek'].'</div>';
	unset($_SESSION['error_wiek']);
	}
	?>
				<!--input waga-->
			<input type="number" placeholder="waga:" 
		value="<?php
            if (isset($_SESSION['fr_waga']))
            {
                echo $_SESSION['fr_waga'];
                unset($_SESSION['fr_waga']);
            }
        	?>"name="waga" onfocus="this.placeholder=''" onblur="this.placeholder='waga'" >
	<?php 
	if(isset($_SESSION['error_waga'])){
	echo '<div class="error">'.$_SESSION['error_waga'].'</div>';
	unset($_SESSION['error_waga']);
	}
	?>
		
				<!--input check-box-->
			<input type="checkbox" name="regulamin" /> Akceptuję regulamin.
	<?php 
	if(isset($_SESSION['error_regulamin'])){
	echo '<div class="error">'.$_SESSION['error_regulamin'].'</div>';
	unset($_SESSION['error_regulamin']);
	}
	?>
             			<!--input przycisk-->
          	<input type="submit" value="Zarejestruj się">
       	</form>

<div id="text">
	 <a href="index.php"><b>Wróć do strony logowania!</b></a>
</div>

</div>
     
</body>
</html>
