<?php
session_start();
if (!isset($_POST['name']) OR (!isset($_POST['password'])))
{
	header('Location: login.php');
	exit();
}


$pass = $_POST['password'];
$login = $_POST['name'];

$_SESSION['password'] = $pass;
$_SESSION['login'] = $login;

require_once("connect.php");
$connect = new mysqli($host, $db_user, $db_password, $db_name);


if ($rezultat = @$connect->query(sprintf("SELECT*FROM `users` WHERE `name`='%s' AND `password` ='%s'", 
		mysqli_real_escape_string($connect, $login),
		mysqli_real_escape_string($connect, $pass))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				
				$_SESSION['logged'] = "true";
				
				header('Location: weryfication.php');
				if(isset($_SESSION['error_login']))
				{
					unset($_SESSION['error_login']);

				}
			}
			else
			{
				
				header('Location: login.php');
				$_SESSION['error_login'] = True;
			}

	

		}
	$connect->close();
	
	
	


?>