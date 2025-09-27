<?php
  require '../configDB.php';

  $id = $_GET['id'];

  $sql = 'DELETE FROM `ht_taskspol` WHERE `id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$id]);


  header('Location: ../../отзывы/index.php');
?>
