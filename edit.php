<?php
session_start();
if (!isset($_GET['id']))
{
	header('Location: index.php');
	exit();
}

$id = $_GET['id'];
require_once "connect.php";
$connect = new mysqli($host, $db_user, $db_password, $db_name);
if ($connect->connect_errno!=0)
{
	echo "Error: ".$connect->connect_errno;
}
else
{	
	$sql = ("SELECT * FROM `tresc` WHERE `id` = '$id'");
	$rezultat = $connect->query($sql);
				

					
}				
if ($rezultat->num_rows > 0)
{
	if($row = $rezultat->fetch_assoc())
	{
		$edit = $row['edit'];
		if ($edit != "False")
		{
			if (isset($_SESSION['logged']))
			{
				$login = $_SESSION['login'];
				if ($edit == $login)
				{
					$tytul = $row['tytul'];
					$tresc = $row['tresc'];
					$nadawca = $row['nadawca'];
									
					echo "	<!DOCTYPE HTML>";
					echo "<html>";
					echo "<head>";
					echo '	<title>Blog Szkolny</title>';
					echo '	<link rel="stylesheet" href = "styleee.css" type = "text/css"/>';
					echo "</head>";

					echo "<body>";
					echo '<div class = "containerv2"/>';
					echo '<div class ="center"/>';
					echo '<a href = "index.php"/><div class = "return"/><div class = "text"/>Powrót</div></div></a>';
					echo "<form method='POST'>";
					echo 	"<input class = 'tytul2' type = 'text' value = '$tytul' name='tytul2' /><br /><br>";
					echo 	"<textarea class = 'tresc2' type = 'text' name='tresc2' name = 'comment'/>$tresc</textarea><br><br>";
					echo 	"<input class = 'nadawca2' type = 'text' value = '$nadawca' name='nadawca2'/><br><br>";
					if (isset($_SESSION['error_same']))
					{
						echo '<br /><br /><span style = "color:red; font-size: 30px;"/>Post nie został edytowany!</span><br /><br />';

					}
					
					echo 	"<input class = 'submit' type = 'submit' value = 'Edytuj' name='submit2' /><br /><br>";
					echo "</form>";
					if (isset($_POST['tytul2']) AND isset($_POST['tresc2']) and isset($_POST['nadawca2']))
					{	
						$tytul2 = $_POST['tytul2'];
						$tresc2 = $_POST['tresc2'];
						$nadawca2 = $_POST['nadawca2'];

						if (($tytul != $tytul2) OR ($tresc != $tresc2) OR ($nadawca != $nadawca2))
						{
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							if ($connect->connect_errno!=0)
							{
								echo "Error: ".$connect->connect_errno;
							}
							else
							{	


								$sql = ("UPDATE `tresc` SET `tytul` = '$tytul2', `tresc` = '$tresc2', `nadawca` = '$nadawca2' WHERE `id` = '$id'");
								@$rezultat = $connect->query($sql);
								if(isset($_SESSION['error_same']))
								{
									unset($_SESSION['error_same']);

								}
								header('Location: index.php');
								exit();

						
							}				
							if (@$rezultat->num_rows > 0)
							{
								if(isset($_SESSION['error_same']))
								{
									unset($_SESSION['error_same']);

								}
								header('Location: index.php');
								exit();

							}
																
						}
						else 
						{
							$_SESSION['error_same'] = True;

						}	
							
					}
					
				}
					
			}
					
						
		}
					
					
	}
	
}


?>
</div>
</div>
</body>
</html>