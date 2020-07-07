<?php
session_start();
	if ((isset($_POST['tytul'])) AND (isset($_POST['tresc'])) AND (isset($_POST['nadawca'])))
	{
		if ((EMPTY($_POST['tytul']))OR (EMPTY($_POST['tresc'])) OR (EMPTY($_POST['nadawca'])))
		{
			$_SESSION['error_dane'] = 'Uzupełnij wszystkie pola!'.'<br /><br />';
		}

		else
		{
			if (isset($_SESSION['logged']))
			{
				$edit = $_SESSION['login'];
			}
			if (isset($error_dane))
			{
				unset($error_dane);
			}
			
			require_once("connect.php");
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			
			$nadawca = $_POST['nadawca'];
			$tytul = $_POST['tytul'];
			$tresc = $_POST['tresc'];
			if (isset($edit))
			{
				if ($rezultat = $connect->query("INSERT INTO `WERYFIKACJA`(`id`, `nadawca`, `tytul`, `tresc`, `edit`) VALUES (NULL, '$nadawca', '$tytul' , '$tresc', '$edit') "))
				{
					header('Location: index.php');
					unset ($edit);
				}
			}
			else
			{
				if ($rezultat = $connect->query("INSERT INTO `WERYFIKACJA`(`id`, `nadawca`, `tytul`, `tresc`, `edit`) VALUES (NULL, '$nadawca', '$tytul' , '$tresc', 'False') "))
				{
					header('Location: index.php');
					
				}
			}
		}
	}
?>


<!DOCTYPE HTML>
<html>
<head>
	<title>Blog Szkolny</title>
	<link rel="stylesheet" href = "styleee.css" type = "text/css"/>
</head>

<body>
<div class = "container"/>
	
		<a href = "index.php"/><div class = "return"/><div class = "text"/>Powrót</div></div></a>
	<div id = "color"/>
		<div id = "weryfication"/>Twój post zostanie zweryfikowany przez administrację serwera</div><br />


		<form method = "post">
			Tytuł:
			<br /><br /><input class = "tytul2" type = "text" name = "tytul"/>
			<br /><br /><br />
			
			Treść:
						<br /><br /><textarea class = "tresc2" name="tresc" type = "text" cols="100" rows="10"></textarea>
			<br /><br /><br />
			
			Autor:
			<br /><br /><input class = "nadawca2" 
			<?php 
			if (isset($_SESSION['logged']))
			{
				$login = $_SESSION['login'];
				echo "value = '$login'";
			}
			 ?>

			type = 'text' name = 'nadawca'/>
			<br />
		<?php
			if (isset($_SESSION['error_dane']))
			{
				echo '<br /><span style="color:red">'.$_SESSION['error_dane'].'</span>';
			}
		?>
			<br /><input type = "submit" class = "submit"value = "Utwórz post"/>
			
		</form>
	</div>	
<div id = "footer"/>&copy  |  Witek Milewski - milewskiwitek8@gmail.com</div>
</div>
</body>
</html>








