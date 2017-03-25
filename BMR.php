<?php
 
    session_start();
     
   
     
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

<script>
function sprawdz_powitaj()
{

    // przypisanie obiektu pola tekstowego do zmiennej
   	var pole_waga = document.forms['pozdrowienie2'].waga;
	
	var x = document.getElementById('aktywnosc').options.selectedIndex;
	
    // odczyt imienia
	var waga = pole_waga.value;
	
	
	

    // sprawdzenie czy imie jest wpisane
    if (waga != ''   && waga>0 ){
try{
var bmr = waga*24;

}catch(e){

alert('kod:' + e.number + ', info: ' + e.message);
}
if(x == 0)bmr = bmr*1.1;
if(x == 1)bmr =bmr*1.2;
if(x == 2)bmr =bmr*1.4;
        document.getElementById("pole").innerHTML = "Twoje BMR wynosi: "+Math.round(bmr) ;
}
    else
    {
document.getElementById("pole").innerHTML = "błędne dane;(";
       
    }
    return false;
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
		
		
		
	<div id="zlacz">
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
<div id="window_mniejsze"><br/>
<b>Wskaźnik podstawowej przemiany materii - BMR</b><br/><br/>

Współczynnik ten określa minimalną ilość kalorii niezbędnych do zachowania podstawowych funkcji organizmu.
Kalkulator dodatkowo określa niezbędną ilość kalorii przy określeniu poziomu Twojej aktywności fizycznej.

Zalecane tempo utraty masy ciała w wypadku nadwagi i otyłości wynosi ok 2 - 4kg na miesiąc (wyłączając specjalne wskazania medyczne). Przekroczenie tego progu może pociagać za sobą niekorzystne zmiany metaboliczne, niedobory niezbędnych składników odżywczych i zwiększa ryzyko wystąpienia tzw. efektu jojo.<br/><br/>
</div>

<form id="pozdrowienie2">
<input type="number" placeholder="WAGA" name="waga"  onfocus="this.placeholder=''" onblur="this.placeholder='WAGA'" >

<select id="aktywnosc">
		<option>Mała aktywność fizyczna</option>
		<option>Średnia aktywność fizyczna</option>
		<option>Duża aktywność fizyczna</option>
		
</select>
<input type="radio" value="m" name="plec" checked="checked"/> m
<input type="radio" value="k" name="plec" /> k
<button onclick="return sprawdz_powitaj()">OBLICZ BMR!</button>
</form>
<br/>
<div id='pole' style="color: red"></div>
		</div>
		
</div>
		<div id="foot">
			
			
			 <b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
