<?php

  $login = filter_var(trim($_POST['username']),
  FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']),
  FILTER_SANITIZE_STRING);
  $nicename = $login;
  $displayname = $login;
  $currentDateTime = date("Y-m-d H:i:s");

  if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "Недопустимая длина логина";
    exit();
  } else if (mb_strlen($password) < 4 || mb_strlen($password) > 40) {
    echo "Недопустимая длина пароля";
    exit();
  }

  $password = md5($password."dfghwqp4657");

  require "../blocks/connect.php";
  $mysql->query("INSERT INTO `ht_users`( `user_login`, `user_pass`,`user_nicename`,`display_name`, `user_registered`) VALUES ('$login','$password','$nicename','$displayname','$currentDateTime')");

  $mysql->close();

  header('Location: ../index.php');
?>
