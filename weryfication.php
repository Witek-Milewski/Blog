<?php
session_start();

	if (!isset($_SESSION['logged']))
{
	header('Location: login.php');
	exit();
}


?>

<!DOCTYPE>
<html>
<head>
	<title>Blog szkolny</title>
	<link rel="stylesheet" href = "styleee.css" type = "text/css"/>
</head>

<body>
<div class = "container"/>
	
			<br /><a href = "index.php"/><div class = "return"/>Powrót</div></a>
	<div id = "posts"/>
			<?php
			require_once "connect.php";
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connect->connect_errno!=0)
			{
				echo "Error: ".$connect->connect_errno;
			}
			else
			{	
				$sql = ("SELECT * FROM `WERYFIKACJA` ORDER BY `id` DESC");
				$rezultat = $connect->query($sql);
				

					
			}				
				if ($rezultat->num_rows > 0)
				{
					while($row = $rezultat->fetch_assoc())
					{
						$id = $row['id'];

						$tytul = $row['tytul'];
						$tresc = $row['tresc'];
						$nadawca = $row['nadawca'];
						$edit = $row['edit'];
						echo '<div class = "idv3" />ID: '.$id.'</div><br />';
						
						echo '<div class = "tytulv3" />Tytuł: '.$tytul.'</div><br />';
						echo '<div class = "trescv3" />Treść: '.$tresc.'</div><br />';
						echo '<div class = "autorv3" />Autor postu: '.$nadawca.'</div><br /><br />';
					
		?>
	<div id = "inputs"/>
		<div class = "podaj_id" />Aby zatwierdzić, podaj ID</div>
		<form action = "confrim.php" method = "POST"/>
		<input class = "input" type = "text" name = "id"/>	
		</form>





		<div class = "podaj_id"/>Aby usunąć, podaj ID.</div>
		<form action = "delete.php" method = "POST"/>
		<input class = "input" type = "text" name = "id"/><br /><br /><br />
		<?php
		if (isset($_SESSION['error_idd']))
						{
							echo "<span style = 'color:red;'/>Aby zweryfikować, bądź usunąć podaj prawidłowe ID</span>";

						}

						?>

			<hr style="height:2px;border-width:0;color:gray;background-color:white">
		</form><br /><br />
		<?php	
						
						
						
					}
				}
				else{
					echo '<div class = "no_posts_weryfi"/>Brak nowych postów do zatwierdzenia!<br /><br /></div>';
					
				}
		?>					

	</div>
	</div>
	<div id = "footer"/>&copy  |  Witek Milewski - milewskiwitek8@gmail.com</div>
</div>
</body>
</html>
