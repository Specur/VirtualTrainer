<?php
 
    session_start();
     require_once "conect.php" ;
   
	 if ($_SESSION['rodzaj'] == 0)
    {
        header('Location: main.php');
        exit();
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
	
		<i><b>KONTO ADMINISTRATORA</b></i>

		 <div class="dropdown">
  			 <button onclick="myFunction()" class="dropbtn">menu</button>
  		<div id="myDropdown" class="dropdown-content">
   			 <a href="logout.php">Wyloguj</a>
  		</div>
</div>
	</div>	
		
		
		
		
		<div id="window_admin">

PRODUKTY:
			 <?php
	@mysql_query("SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;");
@mysql_query("START TRANSACTION ");
$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	

$wynik = @mysql_query("SELECT * FROM ProduktTymczasowy")
or die('Błąd zapytania');


/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
	echo "<div id='obramowanie'>";
    echo "<table cellpadding=\"2\" border=1>";
	echo "<th>Nazwa</th>";
	echo "<th>kcl</th>";
	echo "<th>weglowodany</th>";
	echo "<th>bialko</th>";
	echo "<th>tluszcz</th>";
    while($r = mysql_fetch_assoc($wynik)) {
	echo '<form action="dodajusun.php" method="post" >';
        echo "<tr>";
        echo "<td ><input type='text' id='admin_przyciski' size=15 name='nazwa_produkt' value=".$r['nazwa']."></td>";
 	echo "<td ><input type='text' id='admin_przyciski' size=5 name='kalorie_produkt' value=".$r['kalorie']."></td>";
   	 echo "<td ><input type='text' id='admin_przyciski' size=5 name='weglowodany_produkt' value=".$r['weglowodany']."></td>";
	 echo "<td ><input type='text' id='admin_przyciski' size=5 name='bialka_produkt' value=".$r['bialka']."></td>";
         echo "<td ><input type='text' id='admin_przyciski' size=5 name='tluszcz_produkt' value=".$r['tluszcz']."></td>";
	echo "<td><input name='przycisk' id='admin_przyciski' type='submit' value='DODAJ'></td>";
	echo "<td><input name='przycisk' id='admin_przyciski' type='submit' value='USUN'></td>";
        echo "</tr>";
	echo "</form>";
    }
    echo "</table>";
	echo "</div>";
}


?> 



ĆWICZENIA:
			 <?php
	

$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	

$wynik = @mysql_query("SELECT * FROM CwiczeniaTymczasowy")
or die('Błąd zapytania');


/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
	echo "<div id='obramowanie'>";
    echo "<table cellpadding=\"2\" border=1>";
	echo "<th>Nazwa</th>";
	echo "<th>Trudność</th>";
	echo "<th>Opis</th>";
	echo "<th>Rodzaj</th>";
    while($r = mysql_fetch_assoc($wynik)) {
	echo '<form action="dodajusuncwiczenie.php" method="post" >';
        echo "<tr>";
	echo "<td ><input type='text' id='admin_przyciski' size=15 name='nazwa_cwiczenie' value=".$r['Nazwa']."></td>";
       echo "<td ><input type='text'id='admin_przyciski' size=5 name='trudnosc_cwiczenie' value=".$r['trudnosc']."></td>";;
        echo "<td ><textarea  cols='30'id='admin_przyciski' rows='4' name='opis_cwiczenie'>".$r['opis']."</textarea> </td>";
	echo "<td ><input type='text' id='admin_przyciski'size=15 name='rodzaj_cwiczenie' value=".$r['rodzaj']."></td>";
	echo "<td><input name='przycisk'id='admin_przyciski' type='submit' value='DODAJ'></td>";
	echo "<td><input name='przycisk'id='admin_przyciski' type='submit' value='USUN'></td>";
        echo "</tr>";
	echo "</form>";
    }
    echo "</table>";
	echo "</div>";
}


?> 
	




INSPIRACJE:
			 <?php
	

$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	

$wynik = @mysql_query("SELECT * FROM InspiracjeTymczasowy")
or die('Błąd zapytania');


/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
	echo "<div id='obramowanie'>";
    echo "<table cellpadding=\"2\" border=1>";
	echo "<th>Url</th>";
	echo "<th>Opis</th>";
	echo "<th>Nazwa</th>";
    while($r = mysql_fetch_assoc($wynik)) {
	echo '<form action="dodajusuninspiracje.php" method="post" >';
        echo "<tr>";	
echo "<td ><input type='text'  id='admin_przyciski' name='obrazek_inspiracje' value=".$r['obrazek']."></td>";
	echo "<td ><input type='text' id='admin_przyciski' size=15 name='opis_inspiracje' value=".$r['opis']."></td>";
        echo "<td ><input type='text'id='admin_przyciski' size=15 name='nazwa_inspiracje' value=".$r['nazwa']."></td>";
	echo "<td><input name='przycisk' id='admin_przyciski' type='submit' value='DODAJ'></td>";
	echo "<td><input name='przycisk' id='admin_przyciski' type='submit' value='USUN'></td>";
        echo "</tr>";
	echo "</form>";
	
    }
    echo "</table>";
	echo "</div>";
}
@mysql_query("COMMIT");

?> 
			
		</div>
	
		<div id="foot">
			     </a><b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>


