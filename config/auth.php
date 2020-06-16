<?php

$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

$pass = md5($pass."qwertyuiopasdfghjklzxcvbnm123456789");

$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
$user = $result->fetch_assoc();
if(count($user) == 0) {
	echo("Пользователь не найден ");
	echo('<a href="/index.php">На главную</a>');
	exit();
}

setcookie('user', $user['firstname'], time() + 3600, "/");
setcookie('score', $user['score'], time() + 3600, "/");


$mysql->close();
header('Location: /index.php');