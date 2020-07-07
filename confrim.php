<?php
session_start();
if (!isset($_POST['id']))
{
	header ('Location: weryfication.php');
	exit();
}
	$id = $_POST['id'];



	require_once "connect.php";
	$connect = new mysqli ($host, $db_user, $db_password, $db_name);
	$sql = "SELECT * FROM `weryfikacja` WHERE `id` = '$id'";
	$result = $connect->query($sql);
	
	if ($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		
			
		$tytul = $row['tytul'];
		$tresc = $row['tresc'];
		$nadawca = $row['nadawca'];
		$edit = $row['edit'];


		$result = $connect->query("DELETE FROM `weryfikacja` WHERE `id` = '$id'");
			
		
			if ($result = $connect->query("INSERT INTO `tresc`(`id`, `nadawca`, `tytul`, `tresc`, `edit`) VALUES (NULL, '$nadawca', '$tytul' , '$tresc', '$edit') "))
			{
				if(isset($_SESSION['error_idd']))
				{
					unset ($_SESSION['error_idd']);

				}
				header('Location: weryfication.php');
			}	
			else
			{
				echo "";
			}
		
			
	}
	else
	{
		$_SESSION['error_idd'] = "xddd";
		header('Location: weryfication.php');

	}


?>