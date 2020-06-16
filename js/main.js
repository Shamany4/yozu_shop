let span = $('#user_Id').text(); // Получаем ID пользователя при авторизации
let span_money = document.querySelector('#user_money');
let CountItem = 0; // Отслеживание кол-ва товара конкретного товара
// Изменение счётчика корзины
let basketval = document.querySelector('#basket_value'); // Получаем span
let countBasket = 0; // Присваиваем значение span

// Инициализация поиска
let searchInit = () => {
  $('.search__btn').on('click', () => {
    let search_input = $('#search__input').val();
    if (search_input == '')
      alert('Заполните поле!');
    else {
      $.post('/config/core.php', { 'action': 'searches', 'item_name': search_input }, SearchItem);
    }
  });
}

// Инициализация функции поиска товаров по категории
function ShowCategoryInit() {
  let id;
  $('.menu__btn').each(function () {
    $(this).on('click', () => {
      id = $(this).attr('name');
      $.post('/config/core.php', { 'action': 'show_category', 'category': id }, ShowCategory);
    });
  });
}

// Поиск по категориям
let ShowCategory = (data) => {
  if (data == '0') {
    let error = '<div class="empty">' +
      '<img src="../img/empty_item.svg" alt="Картинка ошибки" class="empty__img" ' +
      '<h2 class="empty__title">Упс, товары не найдены :(</h2>' +
      '</div>';
    $('.card-block').html(error);
  } else {
    data = JSON.parse(data);
    let out = '';
    for (let key in data) {
      out += '<div class="card">';
      out += `<img src="img/card/${data[key].img}" alt="Изображение телефона" class="card__img">`;
      out += '<div class="card-desc">';
      out += `<h2 class="card__title" name="name">${data[key].name}</h2>`;
      out += `<span class="card__article">Код товара: ${data[key].id}</span>`;
      out += `<p class="card__text">${data[key].description}</p>`;
      out += '</div>';
      out += '<div class="card-cost">';
      out += `<span class="card__price" name="price">${data[key].price}</span>`;
      out += `<a href="#" class="card__btn" data-id="${data[key].id}">В корзину</a>`;
      out += '</div>';
      out += '</div>';
    }
    $('.card-block').html(out);
    $('.card__btn').on('click', CheckItemBasket());
  }
}

// Поиск товаров
let SearchItem = (data) => {
  if (data == '0') {
    let error = '<div class="empty">' +
      '<img src="../img/empty_item.svg" alt="Картинка ошибки" class="empty__img" ' +
      '<h2 class="empty__title">Упс, товары не найдены :(</h2>' +
      '</div>';
    $('.card-block').html(error);
  } else {
    data = JSON.parse(data);
    let out = '';
    for (let key in data) {
      out += '<div class="card">';
      out += `<img src="img/card/${data[key].img}" alt="Изображение телефона" class="card__img">`;
      out += '<div class="card-desc">';
      out += `<h2 class="card__title" name="name">${data[key].name}</h2>`;
      out += `<span class="card__article">Код товара: ${data[key].id}</span>`;
      out += `<p class="card__text">${data[key].description}</p>`;
      out += '</div>';
      out += '<div class="card-cost">';
      out += `<span class="card__price" name="price">${data[key].price}</span>`;
      out += `<a href="#" class="card__btn" data-id="${data[key].id}">В корзину</a>`;
      out += '</div>';
      out += '</div>';
    }
    $('.card-block').html(out);
    $('.card__btn').on('click', CheckItemBasket());
  }
}

// Инициализация авторизации пользователя
let userauthInit = () => {
  $('#user_login__btn').on('click', () => {
    let email = $('#user_email').val();
    let pass = $('#user_pass').val();
    $.post('/config/core.php', {
      'action': 'user_auth',
      'user_email': email,
      'user_pass': pass
    }, CheckAuth);
  });
}

// Авторизация пользователя
let CheckAuth = (data) => {
  if (data == '0') {
    alert('Пользователь не найден!');
    window.location.reload();
  }
  else {
    window.location.reload();
  }
}

// Инициализация добавления денег
let updatemoneyInit = () => {
  $('#put-money__btn').on('click', () => {
    let email = $('#user_email_add').val();
    let pass = $('#user_pass_add').val();
    let money = $('#user_money_add').val();
    if (email == '' || pass == '') {
      alert('Поле пустое!');
    }
    else if (money > 200000) {
      alert('Куда ёпт, в России живём. Максимум — 200 000 руб.');
    }
    else {
      $.post('/config/core.php', {
        'action': 'update_money',
        'email': email,
        'pass': pass,
        'money': money
      }, UpdateMoney);
    }
  });
}

// Добавление денег
let UpdateMoney = (data) => {
  if (data == '1') {
    alert('Счёт успешно пополнен!');
    window.location.reload();
  } else if (data == 'user_0') {
    alert('Неверный логин или пароль!');
    window.location.reload();
  }
  else {
    alert('Счёт успешно пополнен!');
    window.location.reload();
  }
}

// Вывод товара из JSON
let initJSON = () => {
  $.getJSON("item.json", goodItem);
}
let goodItem = (data) => {
  let out = '';
  for (let key in data) {
    out += '<div class="card">';
    out += `<img src="img/card/${data[key].img}" alt="Изображение телефона" class="card__img">`;
    out += '<div class="card-desc">';
    out += `<h2 class="card__title" name="name">${data[key].name}</h2>`;
    out += `<span class="card__article">Код товара: ${key}</span>`;
    out += `<p class="card__text">${data[key].description}</p>`;
    out += '</div>';
    out += '<div class="card-cost">';
    out += `<span class="card__price" name="price">${data[key].price}</span>`;
    out += `<a href="#" class="card__btn" data-id="${key}">В корзину</a>`;
    out += '</div>';
    out += '</div>';
  }
  $('.card-block').html(out);
  CheckItemBasket();
  // Отменяем перезагрузку страницы при добавлении товара в корзину
  $('.card__btn').on('click', (event) => {
    event.preventDefault();
  });
}

// Проверяем товар на налие в БД (Если есть, запрещаем добавление)
function CheckItemBasket() {
  $('.card__btn').on('click', function () {
    let id = $(this).attr('data-id');
    let user_id = span;
    $.post('/config/core.php', {
      'action': 'check_item',
      'user_id': user_id,
      'item_id': id
    }, function (data) {
      if (data == '1') {
        alert('Товар уже есть в корзине!');
      }
      else {
        addtoBasket(id);
      }
    });
  });
}

// Показываем корзину при обновлении страницы
function ShowBasketForOnly() {
  $('#basket__btn').on('click', addtoBasket());
}

// Добавление в корзину
function addtoBasket(id) {
  if (span == '') {
    alert('Авторизуйтесь, чтобы добавить в корзину!');
  }
  else {
    let user_id = span;
    let item_id = id;
    let count = 1;
    $.post('/config/core.php', {
      'action': 'user_basket',
      'user_id': user_id,
      'item_id': item_id,
      'count_item': count
    }, ShowUserBasket);
  }
}

// Получаем корзину из БД
function ShowUserBasket() {
  let user_id = span;
  $.post('/config/core.php', {
    'action': 'show_basket',
    'user_id': user_id,
  }, ShowBasketUser);
}

// Распарсиваем корзину из БД
function ShowBasketUser(data) {
  data = JSON.parse(data);
  out = '';
  let checksum = 0;
  for (let key in data) {
    let cost = data[key].price;
    CountItem = data[key].count_item
    let summa = cost * CountItem;
    checksum += summa;
    out += '<div class="hidden-card">';
    out += '<div class="hidden-card-desc">';
    out += `<img src="img/card/${data[key].img}" alt="Image phone" class="hidden-card__img">`;
    out += `<h3 class="hidden-card__title">${data[key].name}</h3>`;
    out += '</div>';
    out += '<div class="hidden-desc">';
    out += `<p class="hidden-desc__text">${data[key].description}</p>`;
    out += `<span class="hidden-card__price">${data[key].price}</span>`;
    out += '</div>';
    out += `<a href="#" class="hidden-card__close" data-id="${key}">&times;</a>`;
    out += '</div>';
  }
  if (data != 0)
    out += '<a href="basket.php" class="hidden-card__oform">Оформить заказ</a>';
  out += '<div class="hidden-check">';
  out += '<span class="hidden-check__stars">**********************************************************************</span>';
  out += '<div class="total">';
  out += '<h3 class="total__title">Итого: </h3>';
  out += `<span class="total__count">${checksum}</span>`;
  out += '</div>';
  out += '<span class="hidden-check__stars">**********************************************************************</span>';
  out += '</div>';
  $('.hidden-block').html(out);
  $('.hidden-card__close').on('click', DelBasket);
}

// Удаление из корзины
function DelBasket() {
  let id = $(this).attr('data-id');
  $.post('/config/core.php', { 'action': 'delete_item', 'item_id': id }, function () {
    window.location.reload();
  });
  CountBasket();
}

// Счётчик корзины
let CountBasket = () => {
  let user_id = span;
  $.post('/config/core.php', { 'action': 'count_basket', 'user_id': user_id }, function (data) {
    countBasket = data;
    basketval.textContent = countBasket;
  })
}

// Получаем кол-во денег
let GetUserMoney = () => {
  let user_id = span;
  $.post('/config/core.php', { 'action': 'get_user_money', 'user_id': user_id }, function (data) {
    if (data == '0') {
      span_money.textContent = '0';
    }
  });
}

// Когда документ полностью загружен
$(document).ready(() => {

  // Вызов главных функций
  ShowBasketForOnly;
  userauthInit();
  ShowCategoryInit();
  CountBasket();
  searchInit();
  updatemoneyInit();
  GetUserMoney();
  initJSON(); // Вызов JSON при загрузке
});

