<?php
	
session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Blog Szkolny</title>
	<meta charset = "utf-8"/>
	
<?php
	if (isset($_SESSION['logged']))
	{
		echo '<link rel="stylesheet" href = "stylee.css" type = "text/css"/>';

	}
	else
	{
		echo '<link rel="stylesheet" href = "styleee.css" type = "text/css"/>';

	}
?>
</head>

<body>

 

<div class = "container"/>
	<div id = "header"/>
		<div id = "logininformation"/>
			<?php
			if (isset($_SESSION['logged']))
			{
				echo "<div class = 'one'/><a href = 'logout.php'>Wyloguj się ".$_SESSION['login']."</a></div>";
				echo "<div class = 'two'/><a href = 'weryfication.php'>Zweryfikuj posty</a></div>";
			}
			else
			{
				
				echo '<a href = "login.php"/>Zaloguj się</a>';
			}
				
			?>
		</div>
		<div id = "createpost"/>
			<a href = "new_post.php" />Utwórz nowy post</a>
		</div>
	</div>
	
	<div id = "posts"/>
		<?php
		$strona = "connect.php";
		require_once "connect.php";
			$connect = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connect->connect_errno!=0)
			{
				echo "Error: ".$connect->connect_errno;
			}
			else
			{	
				$sql = ("SELECT * FROM `tresc` ORDER BY `id` DESC");
				$rezultat = $connect->query($sql);
				

					
			}				
				if ($rezultat->num_rows > 0)
				{
					while($row = $rezultat->fetch_assoc())
					{
						$edit = $row['edit'];
						if ($edit != "False")
						{
							if (isset($_SESSION['logged']))
							{
								$login = $_SESSION['login'];
								if ($edit == $login)
								{

									$m_edit = '<div class = "edit_post"/>Edytuj</div><br />';
								}
								else echo "<br />";

							}
							else echo "<br />";
						}
						
						$id = $row['id'];
						if (isset($m_edit))
						{
							echo "<div class = 'design_posts'/><a href = 'post.php?tytul=$id' /><div class = 'postv2'/>".$row['tytul']."<br /><br /><div class = 'edit_post'/><a href = 'edit.php?id=$id'/>Edytuj</a></div>"."</div></div></a><br /><br /><br />";
							unset($m_edit);
						
						}
						else
						{

							echo "<div class = 'design_posts'/><a href = 'post.php?tytul=$id' /><div class = 'post'/>".$row['tytul']."<br /><br /></div></a></div><br /><br /><br />";
						}

					}	

				}
				else echo "<br />";				
		?>

	</div>
	<div id = "footer"/>&copy  |  Witek Milewski - milewskiwitek8@gmail.com</div>
</div>

</body>


</html>