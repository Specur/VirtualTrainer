<?php
    session_start();
      require_once "conect.php";
	 if ($_SESSION['rodzaj'] == 1)
    {
        header('Location: admin.php');
        exit();
    }
     
?>
<noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

<script>
function spr2()
{

    // przypisanie obiektu pola tekstowego do zmiennej
   	var ilosc = document.forms['pozdrowienie2'].ilosc;
	var formularz=document.forms[0];
	
    // odczyt imienia
	var ilosc_ilosc = ilosc.value;
	

    // sprawdzenie czy imie jest wpisane
    if (ilosc_ilosc != '' && ilosc_ilosc > 0  ){
	formularz.submit();
}
    else
    {  
    }
    return false;
}
</script>
<script>

function spr()
{
   
	var formularz=document.forms[0];
        formularz.submit();

        return false;
}
</script>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
<link rel="stylesheet" href="crunchify.css" type="text/css">
     <script type="text/javascript" src="xmlhttprequest.js"></script>
    <script type="text/javascript" src="ajax.js"></script> 
<title>VirtualTrainer</title>


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

<ol >
    <a id = "menuuu" onclick="wymienTresc('dodaj-produkt-do-listy.php', 'content', this);">Dodaj produkt</a>
  </ol>

<div id="content">

</div>

	<?php
	

$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 
mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	echo "Cześć ".$_SESSION['imie']." ";
	echo "mamy dziś:  ";
	echo date("Y-m-d");
	echo ".</br>zjadłeś: ";
$wynik = @mysql_query('SELECT Produkt.nazwa, Produkt.kalorie, Dni.ilosc, Dni.id_dni FROM  Produkt , Dni WHERE Dni.id_uzytkownik = '.$_SESSION["id"].' and Dni.id_produkt = Produkt.Id_produkt and Dni.dzien = "'.date("Y-m-d").'"')
or die('Błąd zapytania');
$suma = 0;

/*
wyświetlamy wyniki, sprawdzamy,
czy zapytanie zwróciło wartość większą od 0
*/
if(mysql_num_rows($wynik) > 0) {
    /* jeżeli wynik jest pozytywny, to wyświetlamy dane */
    echo "<table cellpadding=\"2\" border=1>";
	echo "<th>Nazwa Produktu</th>";
	echo "<th>Ilość(g)</th>";
	echo "<th>Kcl(100g)</th>";
    while($r = mysql_fetch_assoc($wynik)) {
	echo '<form action="usunproduktdzien.php" method="post" >';
        echo "<tr>";
	echo "<input type='hidden'  id='admin_przyciskii' size=1 name='id' value=".$r['id_dni'].">";
        echo "<td><textarea id='admin_przyciskiii' disabled name='nazwa'>".$r['nazwa']."</textarea></td>";
	echo "<td><input type='text' disabled id='admin_przyciskii' size=15 name='ilosc' value=".$r['ilosc']."></td>";
	echo "<td><input type='text' disabled id='admin_przyciskii' size=15 name='kalorie' value=".$r['kalorie']."></td>";
		
	echo "<td><input type ='submit' name='przycisk' id='admin_przyciskiiii'  value='X'></td>";
        echo "</tr>";
	echo "</form>";

	$suma +=  (float)$r['kalorie']*($r['ilosc']/100);
    }

    echo "</table>";
	echo " co daje: ";
	echo $suma;
	echo " kcl. </br>";
	$cel = $_SESSION["cel"];
	$kcl = (24*$_SESSION["waga"])*1.2;
	echo "Twój cel to <b>".$cel.".</b></br>";
	
if($cel == 'Utrzymac wage'){
echo " Więc powinieneś zjeść w ciągu dnia ".$kcl." kcl.";
if($kcl+400 < $suma){
echo" Zjadłeś już zbyt wiele. Jesli będziesz jadł taką ilość jedzenia każdego dnia możesz przytyć!";
}else{
if($kcl-400 > $suma){

echo" Zjadłeś zbyt mało na dziś. Zjedz coś jeszcze aby nie schudnąć!";
}else{

echo "Zjadłeś idealną liczbe kalorii na dziś :) gratulujemy :) ";

}
}
}

if($cel == 'Schudnac'){
$p = $kcl-500;
echo " Więc powinieneś zjeść w ciągu dnia ".$p." kcl.</br>";

if($suma > $kcl-200){
echo" Zjadłeś już zbyt wiele. Jesli będziesz jadł taką ilość jedzenia możesz przytyć!";
}else{
if($suma < $kcl-500){echo"Zjadłeś zbyt mało! Musisz jeść więcej by mieć siłę do normalnego funkcjonowania.";}
else{
echo"Zjadłeś idealną liczbe kalorii na dziś :) gratulujemy! ";
}
}
}


if($cel == 'Przytyc'){
$p = $kcl+500;
echo " Więc powinieneś zjeść w ciągu dnia ".$p." kcl.</br>";

if($suma < $kcl+300){
echo"Zjadłeś zbyt mało!";
}else{


echo"Zjadłeś idealną liczbe kalorii na dziś :) gratulujemy! ";
}
}




if($cel == 'Zbudowac miesnie'){
echo " Aby to uczynić musisz jeść dużo białka. I uprawiać ćwiczenia które w naszej skali trudności przekraczają stopień 3. ";

}




}

?> 
		
		</div>
		
		<div id="foot">
			
			
			<b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
