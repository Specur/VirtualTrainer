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
		
		
		

			<div id="menuuu">
				
				
				<div class="option"><a href="main.php">Strona główna</a></div>
				<div class="option"><a href="kalkulator.php">Kalkulatory</a></div>
				<div class="option"><a href="cwiczenia.php">Ćwiczenia</a></div>
				<div class="option"><a href="diety.php">Diety</a></div>
				<div class="option"><a href="produkt.php">Produkty</a></div>
				<div class="option"><a href="inspiracje.php">Inspiracje</a></div>
				<div class="option"><a href="dodawaj.php">Rozwój</a></div>
				<div class="option"><a href="main.php">Trener</a></div>
				<div id="picture"><img src="7108.png" alt="HTML5 Icon" style="width:128px;height:115px;"> </div>
			</div>
		
		
		<div id="window">
<b>Jeśli chcesz pomóc nam w rozwuju strony dodaj własne produkty, inspiracje lub ćwiczenia. Wszystko to możesz zrobić w tej zakładce.</b>
		
<ol id="menu">
    <li><a href="dodaj-produkt-caly.html" onclick="wymienTresc('dodaj-produkt.html', 'content', this);">Dodaj produkt</a></li>

    <li><a href="dodaj-cwiczenie-caly.html" onclick="wymienTresc('dodaj-cwiczenie.html', 'content', this);">Dodaj ćwiczenie</a></li>

    <li><a href="dodaj-inspiracje-caly.html" onclick="wymienTresc('dodaj-inspiracje.html', 'content', this);">Dodaj inspiracje</a></li>

  </ol>
<div id="content">

</div>


		</div>
		
		<div id="foot">
			
			
			<a href="http://www.virtualtrainer.fora.pl/forum-testowe,1/">FORUM         </a>    <b>Mirosław  Stec 2016r.</b> 
		</div>
		





	
</body>
</html>
