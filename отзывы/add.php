<?php
  $taskName = $_POST['taskName'];
  $taskTelephone = $_POST['taskTelephone'];
  $taskEmail = $_POST['taskEmail'];
  $taskOcen = $_POST['taskOcen'];
  $taskKomm = $_POST['taskKomm'];

  if (mb_strlen($taskName) < 3 || mb_strlen($taskName) > 90) {
    echo "Недопустимая длина имени";
    exit();
  }else if (mb_strlen($taskTelephone) < 5 || mb_strlen($taskTelephone) > 13) {
    echo "Номер телефона введен неверно";
    exit();
  }else if (mb_strlen($taskEmail) < 0 || mb_strlen($taskEmail) > 20) {
    echo "Недопустимый Email";
    exit();
  }else if (mb_strlen($taskOcen) < 0 || mb_strlen($taskOcen) > 1) {
    echo "Недопустимая оценка";
    exit();
  }else if (mb_strlen($taskKomm) < 0 || mb_strlen($taskKomm) > 1500) {
    echo "Превышена максимальная длина отзыва(1500 символов)";
    exit();
  }

  require '../my-account/configDB.php';

  $sql = 'INSERT INTO ht_taskspol(taskName,taskTelephone,taskEmail,taskOcen,taskKomm) VALUES(:taskName,:taskTelephone,:taskEmail,:taskOcen,:taskKomm)';
  $query = $pdo->prepare($sql);
  $query->execute(['taskName'=> $taskName,'taskTelephone'=> $taskTelephone,'taskEmail'=> $taskEmail,'taskOcen'=> $taskOcen,'taskKomm'=> $taskKomm]);


  header('Location: index.php');
?>
