<?php 
$firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);

if (mb_strlen($firstname) < 3 || mb_strlen($firstname) > 25) {
  echo "Недопустимая длина имени";
  exit();
} elseif (mb_strlen($email) < 3 || mb_strlen($email) > 40) {
  echo "Недопустимая длина email";
  exit();
} elseif (mb_strlen($pass) < 5 || mb_strlen($pass) > 40) {
  echo "Недопустимая длина пароля";
  exit();
}

$pass = md5($pass."qwertyuiopasdfghjklzxcvbnm123456789");

$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
$user = $result->fetch_assoc();
if ($user == true) {
  echo "Такой пользователь уже существует ";
  echo('<a href="/index.php">Назад</a>');
  exit();
} else {
  $mysql->query("INSERT INTO `users` (`firstname`, `email`, `pass`) VALUES ('$firstname', '$email', '$pass')");
}



$mysql->close();
header('Location: /index.php');
?>