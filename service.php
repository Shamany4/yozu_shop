<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>YoZu - магазин цифровой техники</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
  <!-- <script src="https://kit.fontawesome.com/dde264833b.js" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <div class="top-bar">
      <div class="container">
        <div class="top-bar-row">
          <div class="city">
            <p class="city__name">Новосибирск</p>
          </div>

          <?php if($_COOKIE['user'] == ''): ?>
          <div class="login">
            <div class="login__icon"><i class="fa fa-user-o" aria-hidden="true"></i>
            </div>
            <a href="#" class="login__btn" id="sign_in">Войти</a>
            <div class="login__icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <a href="#" class="login__btn" id="sign_up">Регистрация</a>
          </div>
          <?php else: ?>
          <div class="login">
            <h2 class="login__title"><?=$_COOKIE['user']?></h2>
              <div class="hidden-login">
                <div class="wrap-login">
                    <h4 class="hidden-login__title">Имя: <span style="font-weight: 700;"><?=$_COOKIE['user']?></span></h4>
                    <h4 class="hidden-login__title">Ваш ID: <span  id="user_Id" style="font-weight: 700;"><?=$_COOKIE['id']?></span></h4>
                    <h4 class="hidden-login__title">Счёт: <span id="user_money" style="font-weight: 700;"><?=$_COOKIE['user_money']?></span></h4>
                    <div class="hidden-login-button">
                        <a href="#" class="hidden-login-button__btn">Пополнить</a>
                        <a href="/config/exit.php" class="hidden-login-button__btn">Выход</a>
                    </div>
                </div>
              </div>
          </div>
          <div class="put-money">
              <div class="put-money-block">
                  <a href="#" class="put-money-block__close">&times;</a>
                  <h3 class="put-money__title">Форма пополнения счёта</h3>
                  <h4 class="put-money__desc">Нам нужно убедиться, что это Вы</h4>
                  <input type="text" name="user_email_add" class="put-money__input" placeholder="Ваш email*" id="user_email_add">
                  <input type="password" name="user_pass_add" class="put-money__input" placeholder="Ваш пароль*" id="user_pass_add">
                  <input type="text" name="user_money" class="put-money__input" id="user_money_add" placeholder="Кол-во денег">
                  <button type="submit" class="put-money__btn" id="put-money__btn">Пополнить</button>
              </div>
          </div>
          <?php endif;?>

          <div class="form-block">

            <form action="/config/reg.php" class="form" method="post">
              <a href="#" class="form__close" id="form_close">&times;</a>
              <div class="logo">
                <p class="logo__text">YoZu</p>
              </div>
              <input type="text" class="form__input field" name="firstname" placeholder="Ваше имя" required>
              <input type="email" class="form__input field" name="email" placeholder="Email" required>
              <input type="password" class="form__input field" name="pass" placeholder="Пароль" required>
              <button type="submit" class="form__btn">Регистрация</button>
            </form>

          </div>

          <div class="form-block form-block-auth">

<!--            <form action="/config/auth.php" class="form" method="post" id="form_auth">-->
            <div class="form">
              <a href="#" class="form__close" id="form_close">&times;</a>
              <div class="logo">
                <p class="logo__text">YoZu</p>
              </div>
              <input type="email" class="form__input" name="email" id="user_email" placeholder="Email">
              <input type="password" class="form__input" name="pass" id="user_pass" placeholder="Пароль">
              <button type="submit" class="form__btn" id="user_login__btn">Войти</button>
            </div>
<!--            </form>-->

          </div>

        </div>
      </div>
    </div>
    <div class="navigation">
      <div class="container">

        <div class="navigation-block">
          <div class="logo">
            <a href="index.php" class="logo__text">YoZu</a>
          </div>
          <div class="search">
              <input type="text" class="search__input" id="search__input" placeholder="Введите название товара">
              <a href="#" class="search__btn" id="search__btn">Найти</a>
          </div>
          <div class="contacts">
            <a href="contacts.php" class="contacts__btn basket__name">Контакты</a>
          </div>
          <div class="service">
            <a href="service.php" class="service__btn basket__name">Сервис</a>
          </div>
          <div class="basket">
            <a href="#" class="basket__name" id="basket__btn">Корзина —
              <span class="basket__name_count" id="basket_value">0</span>
            </a>
          </div>

            <div class="hidden" id="hidden">
              <a href="#" class="hidden_close" id="hidden_close">&times;</a>

              <div class="hidden-block"></div>

            </div>
        </div>


        <div class="main">
            <div class="main-wrap">
              <h2 class="main__title">Сервис:</h2>
                <div class="service-block">
                  <div class="service-card">
                    <h3 class="service-card__title">Быстро</h3>
                    <p class="service-card__desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse fugit pariatur eaque ullam nostrum, autem ipsa nam facilis qui odit.</p>
                  </div>
                  <div class="service-card">
                    <h3 class="service-card__title">Качественно</h3>
                    <p class="service-card__desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora ratione neque adipisci soluta quasi ea aperiam voluptate aspernatur deleniti nisi.</p>
                  </div>
                  <div class="service-card">
                    <h3 class="service-card__title">Возврат денег</h3>
                    <p class="service-card__desc">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit ipsam eaque numquam excepturi perspiciatis qui deleniti temporibus, unde est vitae?</p>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>

  </header>


  <script src="js/jQuery.js"></script>
  <script src="js/style.js"></script>
  <script src="js/main.js"></script>
</body>

</html>