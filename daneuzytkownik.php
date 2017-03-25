<?php
 
    session_start();
    require_once "conect.php" ;

    

if(count($_POST)>0){
$poprawne_logowanie = true;
$loginaktualny = $_SESSION['login'];
$passwordaktualny = $_SESSION['password'];

$wiek= $_POST['wiek']; 
$waga= $_POST['waga'];
$login= $_POST['login']; 
$login2= $_POST['login']; 
$imie= $_POST['imie'];
$email= $_POST['email']; 
$cel = $_POST['cel'];
$haslo = $_POST['password'];

if(!password_verify($haslo, $passwordaktualny)){
$poprawne_logowanie = false;
			$_SESSION['error_haslo']= "BŁĘDNE HASŁO!";	
}
		
if(empty($wiek)){
$wiek = $_SESSION['wiek'];
}
if(empty($waga)){
$waga = $_SESSION['waga'];
}
if(empty($login)){
$login = $_SESSION['login'];
}
if(empty($imie)){
$imie = $_SESSION['imie'];
}
if(empty($email)){
$email = $_SESSION['email'];
}
if(empty($cel)){
$cel = $_SESSION['cel'];
}

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
			
		if(strlen($login)<3 || (strlen($login)>20))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_login']= "Login musi posiadać od 5 do 15 zaków!";
		}

		$login=	htmlentities($login, ENT_QUOTES, "UTF-8");
		$login2=htmlentities($login2, ENT_QUOTES, "UTF-8");
		if(ctype_alnum($login)	==	false)
		{
	        $poprawne_logowanie = false;
		$_SESSION['error_login']= "Login musi skladac sie tylko z liter i cyfr(bez polskich znakow)!";
		}
		



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
		
	

	
			//sprawdzam email
		
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

		if(filter_var($emailB, FILTER_VALIDATE_EMAIL)==false || ($emailB !=$email))
		{
		$poprawne_logowanie = false;
		$_SESSION['error_email']= "Blędny e-mail!";
		}


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
		$rezultat = $polaczenie->query("SELECT * FROM Uzytkownik WHERE login= '$login2'");

		if(!$rezultat) throw new Exception($polaczenie->error);

		$ile_takich_loginow = $rezultat->num_rows;

		if($ile_takich_loginow>0)
		{
		$poprawne_logowanie = false;
		$_SESSION['error_login']= "Taki nick już istnieje";
		}

		if($_POST['login'] == $loginaktualny)
		{
		$poprawne_logowanie = false;
		$_SESSION['error_login']= "Prosze podać inny nick";
		}
		

		if($poprawne_logowanie == true){
$sqql = "UPDATE Uzytkownik SET login='$login', email='$email', imie='$imie', wiek='$wiek' , waga='$waga', cel='$cel' WHERE login = '$loginaktualny'";
			

			if(mysqli_query($polaczenie, $sqql))
			{
			$_SESSION['wiek']=$wiek; 
			$_SESSION['waga']=$waga;
			$_SESSION['login']=$login; 
			$_SESSION['imie']=$imie;
			$_SESSION['email']=$email; 
			$_SESSION['cel']=$cel;
		
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


<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
<link rel="stylesheet" href="crunchify.css" type="text/css">
 
<title>VirtualTrainer</title>

<noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

<script>
//tworzenie rozwijanego menu
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</head>
<body>
	<?php
			 $connection = @new mysqli("localhost","root", "", "mstec");
    mysqli_query($connection, "SET CHARSET utf8");
    mysqli_query($connection, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
   
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
    else{
      foreach ($_COOKIE as $k=>$v) {
	$_COOKIE[$k] = mysqli_real_escape_string($connection, $v);
}

           if (!isset($_COOKIE['id'])){header("location:index.php");exit;}

	
	$cz = $_SERVER['HTTP_USER_AGENT'];
	$dz = $_SERVER['REMOTE_ADDR'];		 		
	$ci = $_COOKIE['id'];
	$rezultat2=@$connection->query(sprintf("SELECT id_uzytkownika FROM sesja where id = '$ci' and Web = '$cz' AND ip = '$dz'"));
	$wiersz2 = $rezultat2->fetch_assoc();
	$user=$wiersz2['id_uzytkownika'];
		if ($rezultat = @$connection->query(sprintf("SELECT * FROM uzytkownik where Id_uzytkownik='$user'")))
		{
	
				
			$ilu_userow = $rezultat->num_rows;

		
						$wiersz = $rezultat->fetch_assoc();
				//echo "Witaj  ";
			//echo $wiersz['imie_uzytkownika']; echo " ";
			//echo $wiersz['nazwisko_uzytkowinka'];
					
			}
			
		
			
			
			
			
			
			
			
		
		
		   
		   
           $q = mysqli_fetch_assoc(mysqli_query($connection, "select id_uzytkownika from sesja where id = '$_COOKIE[id]';"));

          if (!empty($q['id_uzytkownika'])){
                //   echo "Zalogowany uzytkownik o ID: " . $q['id_uzytkownika'] ;
					
            } else {
                   header("location:index.php");exit;
            }
    }
    ?>
	<div id = "baner">
		<b>Virtual</b>Trainer
	
		<i><b>"Motywacja jest tym, co pozwala zacząć. Nawyk jest tym, co pozwala Ci wytrwać"</b></i>

		 <div class="dropdown">
  			 <button onclick="myFunction()" class="dropbtn">menu</button>
  		<div id="myDropdown" class="dropdown-content">
   			 <a href="daneuzytkownik.php">Dane osobowe</a>
    			 <a href="autor.php">O autorze</a>
   			 <a href="logout.php">Wyloguj</a>
  		</div>
</div>
	</div>	
		
		
		

			<div id="menu">
				
				
				<div class="option"><a href="main.php">Strona główna</a></div>
				<div class="option"><a href="kalkulator.php">Kalkulatory</a></div>
				<div class="option"><a href="cwiczenia.php">Ćwiczenia</a></div>
				<div class="option"><a href="diety.php">Diety</a></div>
				<div class="option"><a href="produkt.php">Produkty</a></div>
				<div class="option"><a href="inspiracje.php">Inspiracje</a></div>
				<div class="option"><a href="dodawaj.php">Rozwój</a></div>
				<div class="option"><a href="trener.php">Trener</a></div>
				<div id="picture"><img src="7108.png" alt="HTML5 Icon" style="width:128px;height:115px;"> </div>
			</div>
		
		
		<div id="window">
			<br/>
			<form method="post">
			Imie:
			<?php  echo $_SESSION['imie']?> <br/>
			Zmień imię:<input type="text" name="imie"><br/>
	<?php 
	if(isset($_SESSION['error_imie'])){
	echo '<div class="error">'.$_SESSION['error_imie'].'</div>';
	unset($_SESSION['error_imie']);
		}
	?>
			Email:
			<?php  echo $_SESSION['email']?><br/>
			Zmień email:<input type="email" name="email"><br/>
	<?php 
	if(isset($_SESSION['error_email'])){
	echo '<div class="error">'.$_SESSION['error_email'].'</div>';
	unset($_SESSION['error_email']);
	}
	?>
			Waga:
			<?php  echo $_SESSION['waga']?><br/>
			Zmień wagę:<input type="number" name ="waga"><br/>
	<?php 
	if(isset($_SESSION['error_waga'])){
	echo '<div class="error">'.$_SESSION['error_waga'].'</div>';
	unset($_SESSION['error_waga']);
	}
	?>
			Wiek:
			<?php  echo $_SESSION['wiek']?><br/>
			Zmień wiek:<input type="number" name="wiek"><br/>
	<?php 
	if(isset($_SESSION['error_wiek'])){
	echo '<div class="error">'.$_SESSION['error_wiek'].'</div>';
	unset($_SESSION['error_wiek']);
	}
	?>
			Login:
			<?php  echo $_SESSION['login']?><br/>
			Zmień login:<input type="text" name = "login"><br/><br/>
	<?php 
	if(isset($_SESSION['error_login'])){
	echo '<div class="error">'.$_SESSION['error_login'].'</div>';
	unset($_SESSION['error_login']);
	}
	?>


	Ustaw cel jaki chcesz osiągnąć:</br>
		chce:<select name="cel">
	<option selected="selected">Utrzymac wage</option>
	<option>Schudnac</option>
	<option>Przytyc</option>
	<option>Zbudowac miesnie </option>
		</select>
<br/>
	<?php 
	if(isset($_SESSION['error_haslo'])){
	echo '<div class="error">'.$_SESSION['error_haslo'].'</div>';
	unset($_SESSION['error_haslo']);
	}
	?>
<br/>
Aby potwierdzić dane prosze wpisać hasło:
			<input type="password" name = "password"><br/><br/>
	<br/>
			<input type="submit" value="Zatwierdź zmiany">
			</form>
<br/><br/><br/>
		</div>
		
		<div id="foot">
			
			
			<b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
