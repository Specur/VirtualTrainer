<?php

session_start();

session_unset();

header('Location: index.php');
?>


<?php



			$connection = @new mysqli("localhost","root", "", "mstec");
	
	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
            $fmn = $_SERVER[HTTP_USER_AGENT];
				
            if ( mysqli_query($connection, "delete from sesja where id = '$_COOKIE[id]' and web = '$fmn'"))
            {
				$_SESSION['zalogowano'] =false;
                setcookie("id",0,time()-1);
                unset($_COOKIE['id']);				
            }
            else
            {
                throw new Exception($connection->error);
            }		
	}				
	header('Location: index.php');

?>
