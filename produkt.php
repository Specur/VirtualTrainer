﻿<?php
 
    session_start();
     require_once "conect.php" ;

     
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

			
			 <?php
	

$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	

$wynik = @mysql_query("SELECT * FROM Produkt")
or die('Błąd zapytania');


/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
echo "<table cellpadding=\"2\" border=1>";
 echo "<tr>";
        echo "<th>NAZWA</th>";
        echo "<th>KCL</th>";
	echo "<th>WĘGLOWODANY</th>";
        echo "<th>BIAŁKO</th>";
	echo "<th>TŁUSZCZ</th>";
        echo "</tr>";
if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
    
    while($r = mysql_fetch_assoc($wynik)) {
        echo "<tr>";
        echo "<td>".$r['nazwa']."</td>";
        echo "<td>".$r['kalorie']."</td>";
	echo "<td>".$r['weglowodany']."</td>";
        echo "<td>".$r['bialko']."</td>";
	echo "<td>".$r['tluszcz']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


?> 
		</div>
		
		<div id="foot">
			
			
			<b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
