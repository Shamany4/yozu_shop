let span = $('#user_Id').text(); // Получаем ID пользователя при авторизации
let span_get_money = $('#user_money').text(); // Получаем сразу кол-во денег пользователя
let CountItem = 0; // Отслеживание кол-ва товара конкретного товара
let span_money = document.querySelector('#user_money');
let CountMoney = 0;

function ShowUserBasket() {
    let user_id = span;
    $.post('/config/core.php', {
        'action': 'show_basket',
        'user_id': user_id,
    }, ShowBasketUser);
}

function ShowBasketUser(data) {
    data = JSON.parse(data);
    let out = '';
    let checksum = 0;
    for (let key in data) {
        let cost = data[key].price;
        CountItem = data[key].count_item
        let summa = cost * CountItem;
        checksum += summa;
        CountMoney = checksum;
        out += '<div class="basket-card">';
        out += '<div class="basket-desc">';
        out += `<img src="img/card/${data[key].img}" alt="" class="basket-desc__img">`;
        out += `<h3 class="basket-desc__title">${data[key].name}</h3>`;
        out += '</div>';
        out += '<div class="basket-counter">';
        out += '<h4 class="basket-counter__title">Количество: </h4>';
        out += `<span class="basket-counter__count">${CountItem}</span>`;
        out += '</div>';
        //out += '<div class="basket-button">';
        //out += '<span class="basket-button__plus" id="btn_plus">+</span>';
        //out += '<span class="basket-button__minus" id="btn_minus">-</span>';
        //out += '</div>';
        out += `<span class="basket-counter__price">${summa}</span>`;
        out += `<a href="#" class="basket__close" data-id="${key}">&times;</a>`;
        out += '</div>';
    }
    out += '<div class="basket-check">';
    out += '<span class="basket-check__stars">****************************************************************************************</span>';
    out += '<div class="basket-total">';
    out += '<h3 class="basket-total__title">Итого: </h3>';
    out += `<span class="basket-total__count">${checksum}</span>`;
    out += '</div>';
    out += '<span class="basket-check__stars">****************************************************************************************</span>';
    out += '</div>';
    let check_money = span_get_money;
    if (data != 0 && check_money != 0) {
        out += '<a class="basket__btn_buy" id="oplata__btn">Оформить</a>';
    } else {
        out += '<a href="index.php" class="basket__btn_buy">На главную</a>';
    }
    $('.basket-block').html(out);
    $('.basket__close').on('click', DelBasket);
    $('#oplata__btn').on('click', ChangeUserMoney);
}

let ChangeUserMoney = () => {
    let user_id = span;
    let count_money = CountMoney;
    $.post('/config/core.php', {'action': 'change_money', 'user_id': user_id, 'count_money': count_money}, CheckOplata);
}

let CheckOplata = (data) => {
    if (data == '0') {
        alert('Недостаточно денег!');
    }
    else {
        alert('Успешная оплата');
        let user_id = span;
        $.post('/config/core.php', {'action': 'delete_basket', 'user_id': user_id}, function () {
            window.location.reload();
        });
    }

}

let ShowBasket = () => {
    $.getJSON('item.json', (data) => {
        let item = data;
        let out = '';
        let checksum = 0;
        for (let key in basket) {
            CountItem = basket[key];
            let cost = item[key].price;
            let summa = cost * CountItem;
            checksum += summa;
            out += '<div class="basket-card">';
            out += '<div class="basket-desc">';
            out += `<img src="img/card/${item[key].img}" alt="" class="basket-desc__img">`;
            out += `<h3 class="basket-desc__title">${item[key].name}</h3>`;
            out += '</div>';
            out += '<div class="basket-counter">';
            out += '<h4 class="basket-counter__title">Количество: </h4>';
            out += `<span class="basket-counter__count">${CountItem}</span>`;
            out += '</div>';
            //out += '<div class="basket-button">';
            //out += '<span class="basket-button__plus" id="btn_plus">+</span>';
            //out += '<span class="basket-button__minus" id="btn_minus">-</span>';
            //out += '</div>';
            out += `<span class="basket-counter__price">${summa}</span>`;
            out += `<a href="#" class="basket__close" data-id="${key}">&times;</a>`;
            out += '</div>';
        }
        out += '<div class="basket-check">';
        out += '<span class="basket-check__stars">****************************************************************************************</span>';
        out += '<div class="basket-total">';
        out += '<h3 class="basket-total__title">Итого: </h3>';
        out += `<span class="basket-total__count">${checksum}</span>`;
        out += '</div>';
        out += '<span class="basket-check__stars">****************************************************************************************</span>';
        out += '</div>';
        out += '<a class="basket__btn_buy">Оформить</a>'
        $('.basket-block').html(out);
        $('.basket__close').on('click', DelBasket);
    })
}

function DelBasket() {
    let id = $(this).attr('data-id');
    $.post('/config/core.php', {'action': 'delete_item', 'item_id': id}, function() {
        window.location.reload();
    });
}


let GetUserMoney = () => {
    let user_id = span;
    $.post('/config/core.php', {'action': 'get_user_money', 'user_id': user_id}, function (data) {
        if (data == '0' ) {
            span_money.textContent = '0';
        }
    });
}

$(document).ready( () => {
    ShowUserBasket();
    GetUserMoney();
});