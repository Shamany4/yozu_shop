<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админка - работа с базой данных</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header class="header">
    <div class="container">
        <div class="main-form">
            <img src="img/admin.svg" alt="" class="main-form__img">

          <?php if($_COOKIE['user'] == ''): ?>
              <form action="config/auth-admin.php" class="form" method="post">
                  <h2 class="form__title">Войдите как администратор</h2>
                  <input type="email" class="form__input" name="email" placeholder="Введите email" required>
                  <input type="password" class="form__input" name="pass" placeholder="Введите пароль" required>
                  <button type="submit" class="form__btn">Войти</button>
              </form>


          <?php else: ?>
            <div class="admin-login">
                <h2 class="admin__title">Привет, <?=$_COOKIE['user']?></h2>
                <a href="config/exit-admin.php" class="admin__exit">Сменить пользователя</a>
            </div>

              <div class="wrap-form">

                  <form action="config/additem.php" class="admin" method="post">
                      <h2 class="admin__header">Добавить новый товар</h2>
                      <input type="text" class="admin__input" name="name" placeholder="Введите название" required>
                      <textarea name="description" class="admin__textarea" placeholder="Введите описание"></textarea>
                      <input type="text" class="admin__input" name="price" placeholder="Введите цену" required>
                      <input type="text" class="admin__input" name="images" placeholder="Введите путь" required>
                      <input type="text" class="admin__input" name="category" placeholder="Введите категорию" required>
                      <button type="submit" class="admin__btn">Добавить</button>
                  </form>

                  <div class="edit">
                      <h2 class="edit__title">Изменение товара</h2>
                      <div class="select-item"></div>
                      <span class="edit__label">Название товара:</span>
                      <input type="text" class="edit__input" id="item_name">
                      <span class="edit__label">Описание товара:</span>
                      <textarea name="" id="item_desc" class="edit__textarea"></textarea>
                      <span class="edit__label">Цена товара:</span>
                      <input type="text" class="edit__input" id="item_price">
                      <span class="edit__label">Укажите путь картинки:</span>
                      <input type="text" class="edit__input" id="item_img">
                      <button type="submit" class="edit__btn">Изменить</button>
                  </div>

              </div>
          <?php endif;?>


        </div>
    </div>
</header>
<script src="js/jQuery.js"></script>
<script src="js/admin.js"></script>
</body>
</html>