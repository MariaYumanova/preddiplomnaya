<?php
  setcookie('user', $user['user_nicename'], time() - 3600, "/");
  header('Location: /');
?>
