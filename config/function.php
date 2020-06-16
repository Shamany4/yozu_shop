<?php

// Получаем товары из БД
function init() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$item = $mysql->query("SELECT `id`, `name` FROM `items`");
	if (mysqli_num_rows($item) > 0) {
		$out = array();
		while ($row = $item->fetch_assoc()) {
			$out[$row["id"]] = $row;
		}
		echo json_encode($out);
	}
	else {
		echo "Не получены товары!";
	}
	$mysql->close();
}

// Авторизация пользователей
function UserAuth() {
  $email = filter_var(trim($_POST['user_email']), FILTER_SANITIZE_STRING);
  $pass = filter_var(trim($_POST['user_pass']), FILTER_SANITIZE_STRING);
  $pass = md5($pass."qwertyuiopasdfghjklzxcvbnm123456789");
  $mysql = new mysqli('localhost', 'root', 'root', 'myshop');
  $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
  $user = $result->fetch_assoc();
  if(count($user) == 0) {
    echo '0';
    exit();
  }
  setcookie('user', $user['firstname'], time() + 3600, "/");
  setcookie('id', $user['id'], time() + 3600, "/");
	$id = $mysql->query("SELECT `id` FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
	$id = mysqli_fetch_assoc($id);
	foreach ($id as $key) {
		$id = $key;
	}
	$get_money = $mysql->query("SELECT `user_money` FROM `user_bank` WHERE `user_id` = '$id'");
	$res_money = $get_money->fetch_assoc();
	setcookie('money', $res_money['user_money'], time() + 3600, "/");
  $mysql->close();
}

// Добавление товаров в корзину БД
function UserBasket() {
	$user_id = $_POST['user_id'];
	$item_id = $_POST['item_id'];
	$count_item = $_POST['count_item'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$mysql->query("INSERT INTO `user_basket` (`user_id`, `item_id`, `count_item`) VALUES ('$user_id', '$item_id', '$count_item')");
	$mysql->close();
}

// Обновляем и добавляем деньги пользователю
function UpdateMoney() {
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$pass = md5($pass."qwertyuiopasdfghjklzxcvbnm123456789");
	$money = $_POST['money'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	// Получаем ID пользователя по сессии
	$id = $mysql->query("SELECT `id` FROM `users` WHERE `email` = '$email' AND `pass` = '$pass'");
	$id = mysqli_fetch_assoc($id);
	if (count($id) == 0) {
		echo 'user_0';
		exit();
	}
	foreach ($id as $key) {
		$id = $key;
	}
	// Получаем кол-во денег пользователя
	$get_money = $mysql->query("SELECT `user_money` FROM `user_bank` WHERE `user_id` = '$id'");
	$get_money = mysqli_fetch_assoc($get_money);
	foreach ($get_money as $key) {
		$get_money = $key;
	}
	//	Проверяем, есть ли ID пользователя в банке
	$get_user_id = $mysql->query("SELECT `user_id` FROM `user_bank` WHERE `user_id` = '$id'");
	$get_user_id = mysqli_fetch_assoc($get_user_id);
	foreach ($get_user_id as $key) {
		$get_user_id = $key;
	}
	// Если он есть, то добавляем ему деньги к текущему счёту
	if ($get_user_id > 0) {
		$mysql->query("UPDATE `user_bank` SET `user_money` = '$money' + '$get_money' WHERE `user_id` = '$id'");
		echo '1';
	}
	// Если его нет в банке, то регистрируем и добавляем ему деньги
	else {
		$mysql->query("INSERT INTO `user_bank` (`user_id`, `user_money`) VALUES ('$id', '$money')");
		echo '2';
	}
}

// Выбираем товары из БД
function SelectItem() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$id = $_POST['iditem'];
	$item = $mysql->query("SELECT * FROM `items` WHERE `id` = '$id'");
	if (mysqli_num_rows($item) > 0) {
		$row = $item->fetch_assoc();
		echo json_encode($row);
	}
	else {
		echo "Не получены товары!";
	}
	$mysql->close();
	WriteJSON();
}

// Обновляем товар в БД
function UpdateItem() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$id = $_POST['id'];
	$name = $_POST['item_name'];
	$desc = $_POST['item_desc'];
	$price = $_POST['item_price'];
	$img = $_POST['item_img'];
	$update = $mysql->query("UPDATE `items` 
SET `name` = '$name', `description` = '$desc', `price` = '$price', `img` = '$img'  WHERE `id` = '$id'");
	$mysql->close();
	WriteJSON();
}

// Поиск товаров в БД
function SearchItem() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$name = $_POST['item_name'];
	$item = $mysql->query("SELECT * FROM `items` WHERE `name` = '$name'");
	$out = array();
	if (mysqli_num_rows($item) > 0) {
		while ($row = $item->fetch_assoc()) {
			$out[$row["name"]] = $row;
		}
		echo json_encode($out);
	}
	else {
		echo '0';
	}
	$mysql->close();
}

// Вывод товаров по категориям
function ShowCategory() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$category = $_POST['category'];
	$item = $mysql->query("SELECT * FROM `items` WHERE `category` = '$category'");
	$out = array();
	if (mysqli_num_rows($item) > 0) {
		while ($row = $item->fetch_assoc()) {
			$out[$row["id"]] = $row;
		}
		echo json_encode($out);
	}
	else {
		echo '0';
	}
	$mysql->close();
}

// Проверяем товар на наличие в корзине
function CheckItem() {
	$user_id = $_POST['user_id'];
	$item_id = $_POST['item_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$result = $mysql->query("SELECT `basket_id` FROM `user_basket` WHERE `user_id` = '$user_id' AND `item_id` = '$item_id'");
	$result = mysqli_fetch_assoc($result);
	foreach ($result as $key) {
		$result = $key;
	}
	if ($result == 0) {
		echo '0';
	}
	else {
		echo '1';
	}
	$mysql->close();
}

// Получаем все товары из корзины
function ShowBasket() {
	$user = $_POST['user_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$result = $mysql->query("SELECT * FROM myshop.items INNER JOIN myshop.user_basket ON items.id = user_basket.item_id
WHERE myshop.user_basket.user_id = '$user'");
	$out = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = $result->fetch_assoc()) {
			$out[$row["id"]] = $row;
		}
		echo json_encode($out);
	}
	else {
		echo '0';
	}
	$mysql->close();
}

// Удаляем товар из корзины
function DeleteItem() {
	$item = $_POST['item_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	// DELETE FROM myshop.basket WHERE myshop.basket.idItem = '$idItem
	$mysql->query("DELETE FROM myshop.user_basket WHERE item_id = '$item' ");
	$mysql->close;

}

// Счётчик Корзины
function CountBasket() {
	$user = $_POST['user_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$result = $mysql->query("SELECT myshop.user_basket.item_id FROM myshop.user_basket WHERE user_id = '$user' ");
	echo $result->num_rows;
}

// Получаем кол-во денег пользователя
function GetUserMoney() {
	$user = $_POST['user_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$result = $mysql->query("SELECT myshop.user_bank.user_money FROM myshop.user_bank WHERE user_id = '$user'");
	$count = $result->fetch_assoc();
	if(count($count) == 0) {
		echo '0';
		exit();
	}
	else {
		setcookie('user_money', $count['user_money'], time() + 3600, "/");
	}
}

// Списываем деньги у пользователя
function ChangeUserMoney() {
	$user = $_POST['user_id'];
	$count_money = $_POST['count_money'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$user_money = $mysql->query("SELECT user_money FROM myshop.user_bank WHERE user_id = '$user'");
	$user_money = mysqli_fetch_assoc($user_money);
	foreach ($user_money as $key) {
		$user_money = $key;
	}
	if ($user_money > $count_money) {
		$mysql->query("UPDATE myshop.user_bank SET myshop.user_bank.user_money = '$user_money' - '$count_money' WHERE user_id = '$user'");
		echo '1';
	}
	else {
		echo '0';
	}
	$mysql->close();
}

// Удаляем корзину в случае успешной оплаты
function DeleteBasket() {
	$user = $_POST['user_id'];
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$mysql->query("DELETE FROM myshop.user_basket WHERE user_id = '$user'");
	$mysql->close;
}

// Запись товаров в JSON файл
function WriteJSON() {
	$mysql = new mysqli('localhost', 'root', 'root', 'myshop');
	$item = $mysql->query("SELECT * FROM `items`");
	if (mysqli_num_rows($item) > 0) {
		$out = array();
		while ($row = $item->fetch_assoc()) {
			$out[$row["id"]] = $row;
		}
		file_put_contents('../item.json', json_encode($out));
	}
	else {
		echo "Не получены товары!";
	}
	$mysql->close();
}

