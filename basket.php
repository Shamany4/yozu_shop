<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YoZu - оплата товаров</title>
    <link rel="stylesheet" href="css/basket.css">
</head>
<body>
<header class="header">
    <div class="container">
        <div class="basket">
            <div class="basket-info">
            <img src="img/basket.svg" alt="Картинка корзины" class="basket__img">
            <div class="basket-info_user">
                <h2 class="basket__title">Корзина</h2>
                <h2 class="basket__info">Имя: <span style="font-weight: 700;"><?=$_COOKIE['user']?></span></h2>
                <h2 class="basket__info">ID: <span  id="user_Id" style="font-weight: 700;"><?=$_COOKIE['id']?></span></h2>
                <h2 class="basket__info">Счёт: <span id="user_money" style="font-weight: 700;"><?=$_COOKIE['user_money']?></span></h2>
            </div>
            </div>
            <div class="basket-block"></div>
        </div>
    </div>
</header>

<script src="js/jQuery.js"></script>
<script src="js/basket.js"></script>
</body>
</html>