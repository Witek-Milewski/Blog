<?php
@session_start();
require_once('connect.php');
$post_id = $_SESSION['post_id'];
if (isset($_POST['nadawca_comment']) && isset($_POST['tresc_comment']))
{
	$nadawca1 = $_POST['nadawca_comment'];
	$nadawca = ucwords($nadawca1);
	$tresc = $_POST['tresc_comment'];
	if (empty($tresc) || empty($nadawca1))
	{
		$_SESSION['error_comment'] = True;
		header('Location: post.php');
		exit();

	}
	$connect = new mysqli($host, $db_user, $db_password, $db_name);
	if ($rezultat = $connect->query("INSERT INTO `comments` (`post_id`, `id`, `tresc`, `nadawca`, `if_comment_comment`) VALUES ('$post_id', NULL, '$tresc', '$nadawca', 'False')"))
	{
		unset($_POST['nadawca_comment']);
		unset($_POST['tresc_comment']);
		unset($nadawca);
		unset($tresc);
		unset($post_id);
		unset($nadawca1);
		$connect->close();
		header('Location: post.php');
	}
}
?>