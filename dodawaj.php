<?php
 
    session_start();
     require_once "conect.php" ;  
?>


<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
<link rel="stylesheet" href="crunchify.css" type="text/css">
     <script type="text/javascript" src="xmlhttprequest.js"></script>
    <script type="text/javascript" src="ajax.js"></script> 
<title>VirtualTrainer</title>
<noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

<script>

function sprawdz_powitaj()
{


    // przypisanie obiektu pola tekstowego do zmiennej
   	var pole_nazwa = document.forms['produktform'].NAZWA_PRODUKT;
	var pole_kcl = document.forms['produktform'].KCL;
	var pole_weglowodany = document.forms['produktform'].WEGLOWODANY;
	var pole_bialko = document.forms['produktform'].BIALKO;
	var pole_tluszcz = document.forms['produktform'].TLUSZCZ;
	var formularz=document.forms[0];
	
	
    // odczyt imienia
	var ok = true;
	var kom = '';
	var nazwa = pole_nazwa.value;
	var kcl = pole_kcl.value;	
	var weglowodany = pole_weglowodany.value;
	var bialko = pole_bialko.value;	
	var tluszcz = pole_tluszcz.value;
 				var reg = new RegExp('<[a-zA-Z/]{1,15}.*?>','g');
				var reg1 = new RegExp('[^a-zA-z\.]','g');
				 
   				nazwa = nazwa.replace(reg, '');

	document.forms['produktform'].NAZWA_PRODUKT.value = nazwa.replace(reg1, '');
if(kcl == '' || weglowodany == '' || bialko == '' || tluszcz == '' || nazwa ==''){
ok = false;
kom = "Żadne z pól nie może byc puste!";
}
    
if( kcl<-1 || weglowodany<-1 || bialko <-1 || tluszcz < -1 || kcl > 10000 || weglowodany > 10000 || bialko > 10000 || tluszcz > 10000){
	ok = false;	
       kom="Wartości poszczególnych składników musza mieścić się w przedziale od 0 do 10000";

}

if(ok == true){
 formularz.submit();
}
else
    {
document.getElementById("pole").innerHTML = kom;
       
    }
    return false;
}
</script>
<script>
function sprawdz_powitaj2()
{
    // przypisanie obiektu pola tekstowego do zmiennej
   	var pole_nazwa = document.forms['cwiczeniaform'].NAZWA;
	var pole_trudnosc = document.forms['cwiczeniaform'].TRUDNOSC;
	var pole_czesc = document.forms['cwiczeniaform'].CZESC_CIALA;
	var pole_text = document.forms['cwiczeniaform'].TEXT1;
	var formularz=document.forms[0];
	var ok = true;
	var kom = '';
	
    // odczyt imienia
	var nazwa = pole_nazwa.value;
	var trudnosc = pole_trudnosc.value;	
	var czesc = pole_czesc.value;
	var text = pole_text.value;	
				var reg = new RegExp('<[a-zA-Z/]{1,15}.*?>','g');
				var reg1 = new RegExp('[^a-zA-z\.]','g');
	nazwa = nazwa.replace(reg, '');
	document.forms['cwiczeniaform'].NAZWA.value = nazwa.replace(reg1, '');

		czesc = czesc.replace(reg, '');
	document.forms['cwiczeniaform'].CZESC_CIALA.value = czesc.replace(reg1, '');

text = text.replace(reg, '');
	document.forms['cwiczeniaform'].TEXT1.value = text.replace(reg1, '');		 
   				

if (trudnosc == '' || trudnosc > 10 || trudnosc < 0){
		kom="Prosze wprowadzić poprawną wartość trudności od 0 do 10";
        	ok = false;

}
if(nazwa == '' || czesc == '' || text == ''){
kom="Żadne z pól nie może być puste";
        	ok = false;
}
if(ok == true){
formularz.submit();
}
    else
    {
document.getElementById("pole").innerHTML = kom;
       
    }
    return false;
}
</script>


<script>

function sprawdz_powitaj3()
{

    // przypisanie obiektu pola tekstowego do zmiennej
   	var pole_nazwa = document.forms['inspiracjeform'].NAZWA;
	var pole_page = document.forms['inspiracjeform'].homepage;
	var pole_text = document.forms['inspiracjeform'].TEXT1;
	var formularz=document.forms[0];
var ok = true;
	var kom = '';	

    // odczyt imienia
	var nazwa = pole_nazwa.value;
	var page = pole_page.value;	
	var text = pole_text.value;



	var reg = new RegExp('<[a-zA-Z/]{1,15}.*?>','g');
				var reg1 = new RegExp('[^a-zA-z\.]','g');
				 
   				nazwa = nazwa.replace(reg, '');

	document.forms['inspiracjeform'].NAZWA.value = nazwa.replace(reg1, '');

text = text.replace(reg, '');

	document.forms['inspiracjeform'].TEXT1.value = text.replace(reg1, '');

	
	
    // sprawdzenie czy imie jest wpisane
if (page == '' || nazwa == '' || text == '' ){
		
        kom="Wszystkie pola są wymagane!";
        	ok = false;
}

if(ok == true){
formularz.submit();
}
    else
    {
document.getElementById("pole").innerHTML = kom;
       
    }
    return false;
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
</br>
<b>Jeśli chcesz pomóc nam w rozwuju strony dodaj własne produkty, inspiracje lub ćwiczenia. Wszystko to możesz zrobić w tej zakładce.</b>
		

    <button class="button2" onclick="wymienTresc('dodaj-produkt.php', 'content', this);">Dodaj produkt</button>
    <button class="button2" onclick="wymienTresc('dodaj-cwiczenie.php', 'content', this);">Dodaj ćwiczenie</button>
    <button class="button2" onclick="wymienTresc('dodaj-inspiracje.php', 'content', this);">Dodaj inspiracje</button>


<div id='pole' style="color: red">
	<?php 
	if(isset($_SESSION['okkkk'])){
	echo '<div class="error">'.$_SESSION['okkkk'].'</div>';
	unset($_SESSION['okkkk']);
	}
	?>
</div>
<div id="content">
</div>


		</div>
		
		<div id="foot">
			
			
			  <b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
