// Появление формы авторизации и регистрации
$(document).ready(function () {
  $('#sign_up').on('click', () => {
    $('.form-block').toggleClass('form-block_active');
  });
  $('#sign_in').on('click', () => {
    $('.form-block-auth').toggleClass('form-block-auth_active');
  });


  // Закрытие открытой формы
  $('.form__close').on('click', () => {
    $('.form-block').removeClass('form-block_active');
  });
  $('.form__close').on('click', () => {
    $('.form-block-auth').removeClass('form-block-auth_active');
  });

  //Появление корзины
  $('.basket').on('click', () => {
    $('.hidden').addClass('hidden_active');
  });
  $('#hidden_close').on('click', () => {
    $('#hidden').removeClass('hidden_active');
  });

  // Появление формы пользователя
  $('.login__title').on('click', () => {
    $('.hidden-login').toggleClass('hidden-login_active');
  });

  $('.hidden-login-button__btn').on('click', () => {
    $('.put-money').toggleClass('put-money_active');
  });
  $('.put-money-block__close').on('click', () => {
    $('.put-money').removeClass('put-money_active');
  });
});
