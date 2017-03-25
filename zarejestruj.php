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
		if(!(is_int($wiek))){
			$udane_logowanie = false;
			$_SESSION['error_wiek']= "Wiek musi byc liczba";
			
				}

		if(strlen($wiek)>3 )
		{
			$udane_logowanie = false;
			$_SESSION['error_wiek']= "Prosze podac poprawny wiek";
		}	
		
		if(!(is_int($waga))){
			$udane_logowanie = false;
			$_SESSION['error_waga']= "Waga musi byc liczba";
				}

		if(strlen($waga)>3 )
				{
			$udane_logowanie = false;
			$_SESSION['error_waga']= "Prosze podac poprawną wage";
				}


	//sprawdzam nick
	$login= $_POST['login']; 
	if(strlen($login)<3 || (strlen($login)>20))
	{
		$udane_logowanie = false;
		$_SESSION['error_login']= "Nick musi posiadać od 5 do 15 zaków!";
		header('Location: registration.php'); 
		exit;
	}
	if(ctype_alnum($login)==false)
	{
        $poprawne_logowanie = false;
	$_SESSION['error_login']= "Nick musi skladac sie tylko z liter i cyfr(bez polskich znakow)!";
	}
	//sprawdzam imie
	$imie = $_POST['imie']; 
	//$sprawdz = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
	//if(!ereg($sprawdz, $imie))
	//{
	//$poprawne_logowanie = false;
	//$_SESSION['error_imie']= "Prosze podać poprawne imie!";
	//}
	

	
	//sprawdzam email
	$email=$_POST['email'];
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
		$udane_logowanie = false;
		$_SESSION['error_haslo']= "Haslo musi posiadać od 7 do 20 zaków!";
	}

	if($haslo != $haslo2){
		$udane_logowanie = false;
		$_SESSION['error_haslo']= "Podane hasła nie są identyczne";
	}
	$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);

	//sprawdzanie checkbox'a
	
	if(!isset($_POST['regulamin'])){
		$udane_logowanie = false;
		$_SESSION['error_regulamin']= "prosze potwierdzic regulamin!";
	}

	//sprawdzanie bota
	$kod = "6Ld0DQ0UAAAAAGK1PUeNeYBsO1zelO3lwUGSSZto";
	$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$kod.'&response='.$_POST['g-recaptcha-response']);

	$odpowiedz = json_decode($sprawdz);

	if($odpowiedz->success==false){
		$udane_logowanie = false;
		$_SESSION['error_bot']= "Potwierdz że nie jestes botem";
	}

		mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
		$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );

		if($polaczenie->connect_errno!=0)
		{
		throw new Exception(mysqli_connect_errno());
		}
		else
		{
		$rezultat = $polaczenie->query("SELECT * FROM Uzytkownik WHERE login='$login'");

		if(!$rezultat) throw new Exception($polaczenie->error);

		$ile_takich_loginow = $rezultat->num_rows;
		if($ile_takich_loginow>0)
		{
		$udane_logowanie = false;
		
		$_SESSION['error_login']= "Taki nick już istnieje";
		}
		if($poprawne_logowanie == true){
		if($polaczenie->query("INSERT INTO Uzytkownik VALUES(NULL, '$login', '$haslo','0', '$email', '$imie', '$wiek','$waga', 'Utrzymac wage')"))
		{
		$_SESSION['udanarejestracja'] = true;
		
		header("Location: index.php");
		
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
		echo $e;
	}

	
		
	




}


	
	
		
?>
