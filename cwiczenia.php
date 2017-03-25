<?php
 
    session_start();
     require_once "conect.php" ;

    if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
     
?>


<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
<link rel="stylesheet" href="crunchify.css" type="text/css">
 <noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

<title>VirtualTrainer</title>
<script>
function ReverseContent(d)
{
  if (d.length < 1)
    return;

  if (document.getElementById(d).style.display == "none")
  {
    document.getElementById(d).style.display = "block";
  }
  else
  {
    document.getElementById(d).style.display = "none";
  }
}
</script>

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
	

$wynik = @mysql_query("SELECT * FROM Cwiczenia")
or die('Błąd zapytania');

/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
echo "<table cellpadding=\"2\" border=1>";
echo "<tr>";
	echo "<th>ID</th>";
        echo "<th>Nazw ćwiczenia</th>";
        echo "<th>Trudność</th>";
	echo "<th>Część ciała</th>";
        echo "<th>Opis</th>";
        echo "</tr>";

if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
    while($r = mysql_fetch_assoc($wynik)) {
        echo "<tr>";
	echo "<td>".$r['id_cwiczenia']."</td>";
        echo "<td>".$r['nazwa']."</td>";
        echo "<td>".$r['trudnosc']."</td>";
	echo "<td>".$r['rodzaj']."</td>";
        echo "<td>".' <div id = "dynamiczne_menu'.$r["id_cwiczenia"].'" style="display:none;">'.$r["opis"].'
		</div>
				<button onclick= ReverseContent("dynamiczne_menu'.$r["id_cwiczenia"].'"); class="dropbtn">?</button>


							'."</td>";

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
