<?php
 
    session_start();
     
     require_once "conect.php" ;
    
?>


<form  method="post" id="pozdrowienie2" action="doodaj.php">


<?php
	
$connection = @mysql_connect($host, $db_user, $db_password)
    or die('Brak połączenia z serwerem MySQL');
    $db = @mysql_select_db($db_name, $connection)
    or die('Nie mogę połączyć się z bazą danych'); 

mysql_query("SET CHARSET utf8");
mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
	
$wynik = @mysql_query('SELECT * FROM  Produkt ')
or die('Błąd zapytania');

if(mysql_num_rows($wynik) > 0) {
  echo "<select name='cel'>";
    while($r = mysql_fetch_assoc($wynik)) {
      echo "<option value=".$r['Id_produkt'].">".$r['nazwa']."</option>";
		
    }
echo "</select>";
    
	
}

?> 
		

<input type="number" placeholder="ilosc w gramach" name="ilosc"  onfocus="this.placeholder=''" onblur="this.placeholder='ilosc w gramach'" ></br>
<button onclick="return spr2()">Dodaj</button>


</form>

