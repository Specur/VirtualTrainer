<?php
session_start();
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	header('Location: main.php');
	exit();
}


?>




<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <title>VirtualTrainer</title>
    
         <noscript>
<div id = "ns">
Przepraszamy, ale VirtualTrainer nie działa prawidłowo bez włączonej obsługi języka JavaScript. 
</div>
</noscript>

   <link rel="stylesheet" href="style.css" type="text/css" />
     
</head>
 
<body>
 
    <div id="container2">
        
			
			<?php 
	if(isset($_SESSION['zarejestrowanoo'])){
	echo '<div class="error">'.$_SESSION['zarejestrowanoo'].'</div>';
	unset($_SESSION['zarejestrowanoo']);
	}
	?>
					<!--title -->
							<div id="title"><b>Virtual</b>Trainer</div>

			<form action="zaloguj.php" method="post">
				
            <input type="text" placeholder="login:" name="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" >
             
            <input type="password" placeholder="hasło:" name="password" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" >
             
            <input type="submit" value="Zaloguj się">
				
			</form>
		<?php
			if(isset($_SESSION['blad']))    echo $_SESSION['blad'];
			unset($_SESSION['blad']);
		?>
		
<div id="text">
	Nie masz jeszcze konta? <a href="registration.php"><b>Zarejestruj się!</b></a>
</div>

             
      
    </div>
    <div id ="warn">
    <p><strong>UWAGA!</strong> Niniejsza strona wykorzystuje pliki cookies. 
    Informacje uzyskane za pomocą cookies wykorzystywane są głównie 
    w celach statystycznych.</br> Pozostając na stronie godzisz się na 
    ich zapisywanie w Twojej przeglądarce. 
	</div>
</body>
</html>
