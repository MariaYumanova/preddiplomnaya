<?php
  $login = $_POST['username'];
  $pass = filter_var(trim($_POST['password']),
  FILTER_SANITIZE_STRING);
  $usernicename = $_POST['usernicename'];
  $useremail = $_POST['useremail'];
  $current_user = $_POST['userpol'];

  $pass = md5($pass."dfghwqp4657");

  if (mb_strlen($login) < 3 || mb_strlen($login) > 90) {
    echo "Недопустимая длина имени";
    exit();
  }else if (mb_strlen($usernicename) < 3 || mb_strlen($usernicename) > 90) {
    echo "Недопустимая длина никнейма";
    exit();
  }else if (mb_strlen($useremail) < 0 || mb_strlen($useremail) > 20) {
    echo "Недопустимый Email";
    exit();
  }

  require '../configDB.php';

  // SQL запрос для UPDATE с использованием логина из куки
  $sql = 'UPDATE ht_users SET
          user_login = :username,
          user_pass = :password,
          user_nicename = :usernicename,
          user_email = :useremail
          WHERE user_login = :userpol';

  $query = $pdo->prepare($sql);
  $query->execute([
      'username' => $login,
      'password' => $pass,
      'usernicename' => $usernicename,
      'useremail' => $useremail,
      'userpol' => $current_user // Используем логин из куки
  ]);

  // Обновляем куки, если пользователь изменил свой логин
  if($current_user != $login) {
      setcookie('user', $login, time() + 3600, "/");
  }

  header('Location: ../index.php');
?>
