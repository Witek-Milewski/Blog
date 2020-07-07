<?php
if(!isset($_SESSION['post_id']))
{
	header('Location: index.php');
	exit();
}
?>
<div id = "form_send_message"/>
	<form action = "read_comments.php" method = "POST"/>
		<input type = "text" name = "nadawca_comment" class = "nadawca_comment" placeholder="Podaj swoje imię..." />
		<input type = "text" name = "tresc_comment" class = "tresc_comment" placeholder="Napisz komentarz..."/>
		<input type = "submit" value = "Utwórz komentarz" name = "submit_comment" class = "submit_comment"  />
	</form>
<?php
if (isset($_SESSION['error_comment']))
{
	echo '<br /><span style = "font-size: 25px; color: red;"/>Wypełnij wszystkie pola!</span><br /><br />';

}
?>
<br /></div>
<?php
require_once('connect.php');
$post_id = $_SESSION['post_id'];
$connectt = new mysqli($host, $db_user, $db_password, $db_name);
if (!isset($post_id))
{
	$post_id = $_SESSION['post_id'];
}
if ($rezultatt = $connectt->query("SELECT*FROM `comments` WHERE `post_id` = '$post_id' ORDER BY `id` DESC "))
	{
		$ilu_userowt = $rezultatt->num_rows;
		if($ilu_userowt>0)
		{	
			echo '<div class = "comments"/>';
				while ($rowt = $rezultatt->fetch_assoc())
				{
					$nadawca = $rowt['nadawca'];
					$tresc = $rowt['tresc'];
					unset($_SESSION['error_comment']);
					echo '<div class = "comment"/>';
						echo '<div class = "comment_sender"/>'.$nadawca.'</div>';
						echo '<div class = "comment_message"/>'.$tresc.'</div>';
					echo '</div>';
					$komentarz = "Witaj!";
					
					echo '<div id = "linia"/><hr style="width:90%;height:3px;border-width:0;color:black;background-color:black"></div>';



					unset($tresc);
					unset($nadawca);
					unset($rowt['tresc']);
					unset($rowt['nadawca']);

				}
			echo '</div>';
		}	
	$connectt->close();
	}
?>
