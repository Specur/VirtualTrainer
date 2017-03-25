<?php
 
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

			
			<div id="odp">
			<b>Dieta 1000 kalorii:</b></br></br>
			Organizm dorosłej osoby potrzebuje średnio około 3000 kalorii do prawidłowego funkcjonowania. Co się może stać, gdy 				dawkę tę zmniejszymy o 2/3? Nasz organizm zostanie zmuszony do zużycia zmagazynowanego w nim tłuszczu, dzięki czemu 				zaczniemy tracić zbędne kilogramy. Na tej właśnie zasadzie opiera się niezwykle popularny program odchudzający, jakim 				jest dieta 1000 kalorii.</br></br></br>
Głównym założeniem planu 1000 jest ograniczenie dziennej dawki kalorycznej przy jednoczesnym dostarczaniu organizmowi wszelkich niezbędnych składników odżywczych, witamin i minerałów. Dieta opiera się na spożywaniu posiłków często, lecz w niewielkich ilościach. Śniadanie nie powinno przekraczać 200 kalorii, drugie śniadanie – 150, obiad – 350, podwieczorek – 100 zaś kolacja (którą jemy najpóźniej o godzinie 19:00) – 200. Należy pić co najmniej 2 litry wody mineralnej dziennie – wypełnia ona żołądek i jest najlepszym środkiem na głód.</br></br>

Pewną niedogodnością diety 1000 jest konieczność śledzenia tabel kalorycznych. Obecnie wiele programów odchudzających skupia się raczej na kontrolowani indeksu glikemicznego lub przestrzralnej, która skutecznie oczyszcza organizm z toksyn a także wypełnia żołądek. Podczas posiłku nigdy się nie spieszmy – jedząc wolniej, możemy się bardziej nasycić i nie grozi nam przejedzenie.</br></br>

			</div>
			<div id="odp">
			<b>Dieta 7 dni:</b></br></br>
Stosowanie tej diety przez siedem dni pozwala zrzucić nawet i do 3 kilogramów. Opiera się ona głównie na produktach, które są stosowane w programach biologicznej odnowy. Dieta dostarcza organizmowi niezbędnych składników mineralnych i witamin, przez co nasz organizm zwiększa przemianę materii, a tym samym likwiduje toksyny i rozpoczyna spalanie nagromadzonego tłuszczu. Skuteczność tego harmonogramu żywieniowego jednak jest kwestią indywidualną. Każdy człowiek bowiem inaczej reaguje na przedstawione poniżej produkty. Nie możemy liczyć, iż w każdym przypadku przyniesie ona takie same rezultaty.</br></br>

Składniki, które zostały wykorzystane, chodzi tutaj przede wszystkim o truskawki, to owoce sezonowe. Niestety w trakcie zimy trudno je zdobyć lub są bardzo drogie. Dlatego też dieta nie sprawi większych problemów, jeśli stosowana będzie w okresie zbiorów owoców i warzyw. Dzienne jadłospisy tego planu żywienia zostały stworzone w oparciu o wykorzystanie danych składników. By uzyskać możliwie jak najlepsze rezultaty należy opierać się na produktach proponowanych w danym dniu.</br>
			</div>
			<div id="odp">
			<b>Dieta cukrzycowa:</b></br></br>
Dieta cukrzycowa wymaga dyscypliny. Właściwie stosowana pomoże w utrzymaniu odpowiedniej harmonii cukru w organizmie. Dieta ta posiada główne zastosowanie u osób chorych na cukrzycę, jednakże stosować mogą ją również osoby, które nie chcą zapaść na tą chorobę. Przecież lepiej zapobiegać niż leczyć. Ten sposób żywienia stosować może każda osoba z uwzględnieniem indywidualnego dziennego zapotrzebowania na kalorie. W tej kwestii najlepszym rozwiązaniem jest konsultacja z lekarzem.
Do podstawowych zasad diety cukrzycowej należą:
</br></br>
    przestrzeganie dziennego harmonogramu żywieniowego. Oznacza to, że pierwszy posiłek spożywamy najpóźniej do 2 godzin po przebudzeniu, a ostatni do 2 godzin przed snem;</br>
    dieta musi być oparta o dzienny harmonogram zapotrzebowania na kalorie;</br>
    posiłki powinny zawierać każdą jedną grupę pokarmową, czyli tłuszcze, węglowodany, białka itd.;</br>
    produkty najbardziej zalecane, zawierające białko to ryby i chude mięsa. Oczywiście również można zastosować rośliny strączkowe, a także chudy nabiał;</br>
    źródłami tłuszczu w diecie mogą być oleje roślinne, orzechy;</br>
    Stosować możemy wszystkie warzywa z wyłączeniem ziemniaków, buraków, a także kukurydzy. Te należy spożywać jak najrzadziej, max. 2 razy w tygodniu;</br>
    należy spożywać napoje bez dodatku cukru, oczywiście najlepsza jest zwykła, czysta, niegazowana woda, lub też kawa bez cukru;</br>

			</div>
			</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
		</div>
		
		<div id="foot">
			
			
			<b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
