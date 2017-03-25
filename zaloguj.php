<?php
session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
	header('Location: index.php');
	exit();
}


require_once "conect.php" ;
	
	
	

$polaczenie=new mysqli( $host, $db_user, $db_password, $db_name );
if($polaczenie->connect_errno!=0)
	{
		echo "Problem";
	}
	else 
	{
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
        	
     /////////////////////////////////////////////////////////////////////////////
        if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM Uzytkownik WHERE login='%s'",
        mysqli_real_escape_string($polaczenie,$login))))
        {

			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz = $rezultat->fetch_assoc();
$id = md5(rand(-10000,10000).microtime()).md5(crc32(microtime()).$_SERVER['REMOTE_ADDR']);
					mysqli_query($polaczenie, "delete from sesja where id_uzytkownika = '$wiersz[Id_uzytkownik]';"); 	
					mysqli_query($polaczenie, "insert into sesja (id_sesji,id_uzytkownika, id, ip, web) values (NULL,'$wiersz[Id_uzytkownik]','$id','$_SERVER[REMOTE_ADDR]','$_SERVER[HTTP_USER_AGENT]')");
				if(password_verify($password, $wiersz['password']))
				{
					setcookie("id", $id);
					$_SESSION['zalogowany']=true;
					$_SESSION['id'] = $wiersz['Id_uzytkownik'];
					$_SESSION['imie'] = $wiersz['imie'];	
					$_SESSION['email'] = $wiersz['email'];
					$_SESSION['waga'] = $wiersz['waga'];
					$_SESSION['wiek'] = $wiersz['wiek'];
					$_SESSION['login'] = $wiersz['login'];
					$_SESSION['rodzaj'] = $wiersz['rodzaj'];
					$_SESSION['cel'] = 	$wiersz['cel'];
					$_SESSION['password'] = $wiersz['password'];
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: main.php');
				}else{
				$_SESSION['blad'] = '<span style="color:red"><font size="3">Niepoprawny login lub hasło!</font></span>';
				header('Location: index.php');
					}

			}
			else
			{
				
				$_SESSION['blad'] = '<span style="color:red"><font size="3">Niepoprawy login lub hasło!</font></span>';
				header('Location: index.php');
			}
			
		}
		
		
			
$polaczenie->close();
	}


	

?>
