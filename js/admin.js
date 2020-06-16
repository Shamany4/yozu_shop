// Инициализируем товары
let init = () => {
    $.post('/config/core.php', {'action': 'init'}, ShowItem);
}

// Получаем товары в <option>
let ShowItem = (data) => {
    data = JSON.parse(data);
    let out = '<select>';
    for (let key in data) {
        out += `<option data-id="${key}">${data[key].name}</option>`;
    }
    out += '</select>';
    $('.select-item').html(out);
    $('.select-item select').on('change', SelectItem);
}

// Добавляем значение полей в инпуты
let SelectItem = () => {
    let id = $('.select-item select option:selected').attr('data-id');
    $.post('/config/core.php', {'action': 'selectItem', 'iditem': id}, function (data) {
        data = JSON.parse(data);
        $('#item_name').val(data.name);
        $('#item_desc').val(data.description);
        $('#item_price').val(data.price);
        $('#item_img').val(data.img);
    });
}

// Обновляем значение товаров
let SaveItem = () => {
    let id = $('.select-item select option:selected').attr('data-id');
    if (id != undefined) {
        $.post('/config/core.php',
            {
            'action': 'updateItem',
            'id': id,
            'item_name': $('#item_name').val(),
            'item_desc': $('#item_desc').val(),
            'item_price': $('#item_price').val(),
            'item_img': $('#item_img').val()
        }, function (data) {});
    }
}

$(document).ready(function () {
    init();
    $('.edit__btn').on('click', SaveItem);
})
