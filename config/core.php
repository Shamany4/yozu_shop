<?php

require_once 'function.php';
$action = $_POST['action'];

switch ($action) {
	case 'init':
		init();
		break;
  case 'user_auth':
    UserAuth();
    break;
	case 'selectItem':
		SelectItem();
		break;
	case 'updateItem':
		UpdateItem();
		break;
	case 'searches':
		SearchItem();
		break;
	case 'show_category':
		ShowCategory();
		break;
  case 'add_money':
    AddMoney();
    break;
	case 'update_money':
		UpdateMoney();
		break;
	case 'user_basket':
		UserBasket();
		break;
	case 'check_item':
		CheckItem();
		break;
	case 'show_basket':
		ShowBasket();
		break;
	case 'delete_item':
		DeleteItem();
		break;
	case 'count_basket':
		CountBasket();
		break;
	case 'get_user_money':
		GetUserMoney();
		break;
	case 'change_money':
		ChangeUserMoney();
		break;
	case 'delete_basket':
		DeleteBasket();
		break;
}

