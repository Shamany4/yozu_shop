<?php
require_once 'function.php';
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
$price = filter_var(trim($_POST['price']), FILTER_SANITIZE_STRING);
$images = $_POST['images'];
$category = filter_var(trim($_POST['category']), FILTER_SANITIZE_STRING);

$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
$mysql->query("INSERT INTO `items` (`name`, `description`, `price`, `img`, `category`)
VALUES ('$name', '$description', '$price', '$images', '$category')");


$mysql->close();
WriteJSON();
header('Location: /admin.php');

