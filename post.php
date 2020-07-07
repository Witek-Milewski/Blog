<?php
session_start();
require_once("connect.php");
$connect = new mysqli($host, $db_user, $db_password, $db_name);
if (isset($_GET['tytul']))
{
	$id = $_GET['tytul'];
	$_SESSION['post_id'] = $id;
}
elseif (isset($_SESSION['post_id']))
{
	$id = $_SESSION['post_id'];
}
else
{
	header('Location: index.php');
}
if ($rezultat = @$connect->query("SELECT*FROM `tresc` WHERE `id` = '$id'"))
	{
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
			while ($row = $rezultat->fetch_assoc())
			{
				$_SESSION['tytul'] = $row['tytul'];
				$_SESSION['tresc'] = $row['tresc'];
				$_SESSION['autor'] = $row['nadawca'];
			}
		}			
		else
		{
			echo "Błąd serwera. Skontaktuj się z administratorem.";
		}
		$connect->close();
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<title>Blog Szkolny</title>
	<link rel = "stylesheet" href = "styleee.css" type = "text/css" />
</head>
<body>
	<div class = "container"/>
		<div class = "container_show_post"/>
			<br />
			<a href = "index.php"/><div class = "return"/><div class = "text"/>Powrót</div></div></a><br />
				<div class = "show_post"/>
<?php
					echo '<div class = "tytul"/>'.$_SESSION['tytul'].'</div><br /><br />';
					echo '<div class = "tresc"/>'.$_SESSION['tresc'].'</div><br /><br />';
					echo '<div class = "autor"/>'.$_SESSION['autor'].'</div><br /><br />';
?>
				</div>

		</div>
	</div>
<?php
require_once('comments.php');
require_once('read_comments.php');
?>
	<div id = "footer"/>&copy  |  Witek Milewski - milewskiwitek8@gmail.com</div>
</body>
<script>
$( "button" ).click(function() {
  $( "p" ).show( "slow" );
  $( "button" ) = "";
});
</script>
</html>