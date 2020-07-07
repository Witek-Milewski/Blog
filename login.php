<?php
	session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Blog Szkolny</title>
	<link rel="stylesheet" href = "styleee.css" type = "text/css"/>
</head>

<body>
<div class = "container"/>
	<div id = "log"/>
		
			<br /><a href = "index.php"/><div class = "return"/><div class = "text"/>Powrót</div></div></a><br />
		
		<div id = "form"/>
			<form action="check.php" method="post">
				Login:

				<br /><br />
				<input class = "login" type = "text" name = "name"/>
				<br /><br /><br /><br />
				Hasło: 

				<br /><br />
				<input class = "password" type = "password" name = "password"/>
				<br />
				
				<br />
				<?php
					if(isset($_SESSION['error_login']))
					{
						echo '<span style = "color:red; font-size: 30px;"/>Podaj prawidłowe dane!</span>';

					}
				?>

				<br /><br />
				<input class = "submit" type = "submit" value = "Zaloguj się"/>
			</form>
		</div>
	</div>
	<br /><br /><br /><div id = "footer"/>&copy  |  Witek Milewski - milewskiwitek8@gmail.com</div>
</div>
</body>
</html>