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
	var pole_wzrost = document.forms['pozdrowienie2'].wzrost;
	
	
    // odczyt imienia
try{
	var waga = pole_waga.value;
	var wzrost = pole_wzrost.value;	
	wzrost= wzrost/100;
}catch(e){
alert('kod:' + e.number + ', info: ' + e.message);
}
	

    // sprawdzenie czy imie jest wpisane
    if (waga != '' && wzrost != ''  && waga>0 && wzrost>0){
var bmi = waga/(wzrost*wzrost);
        document.getElementById("pole").innerHTML = "Twoje BMI wynosi: "+Math.round(bmi) ;
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
<div id="window_mniejsze">
<b>Wskaźnik masy ciała - BMI</b><br/><br/>

Według Światowej Organizacji Zdrowia prawidłowy BMI oscyluje pomiędzy 18,6 – 24,9. Oznaczanie wskaźnika masy ciała ma znaczenie w ocenie zagrożenia chorobami związanymi z nadwagą i otyłością, np. cukrzycą, chorobą niedokrwienną serca, miażdżycą. Podwyższona wartość BMI związana jest ze zwiększonym ryzykiem wystąpienia takich chorób.<br/><br/>

    do 16: wygłodzenie<br/>
    od 16 do 17: wychudzenie<br/>
    od 17 do 18.5: niedowaga<br/>
    od 18.5 do 25: wartość prawidłowa<br/>
    od 25 do 30: nadwaga<br/>
    od 30 do 35: I stopień otyłości<br/>
    od 35 do 40: II stopień otyłości<br/>
    powyżej 40: III stopień otyłości<br/>
<br/>PROSZE WPROWADZIĆ WSZYTSKIE DANE PRAWIDŁOWO ABY WYŚWIETLIŁ SIE WYNIK:<br/><br/>
</div>

<form id="pozdrowienie2">
<input type="number" placeholder="WAGA" name="waga"  onfocus="this.placeholder=''" onblur="this.placeholder='WAGA'" >
<input type="number" placeholder="WZROST" name="wzrost" onfocus="this.placeholder=''" onblur="this.placeholder='WZROST'" >
<input type="radio" value="m" name="plec" checked="checked"/> m
<input type="radio" value="k" name="plec" /> k
<button onclick="return sprawdz_powitaj()">OBLICZ BMI!</button>
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
