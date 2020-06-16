<?php 
setcookie('user', $user['firstname'], time() - 3600, "/");
setcookie('id', $user['id'], time() - 3600, "/");
setcookie('money', $res_money['user_money'], time() - 3600, "/");
header("Location: /index.php");
