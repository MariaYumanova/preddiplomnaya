<?php
  $comment_post_ID = filter_var(trim$_POST['comment_post_ID'];),
  FILTER_SANITIZE_STRING);
  $comment_author = $_POST['author'];
  $comment_author_email = $_POST['email'];
  $comment_date = date("Y-m-d H:i:s");
  $comment_date_gmt = date("Y-m-d H:i:s");
  $comment_content = $_POST['comment'];
  $comment_type = $_POST['comment_type'];
  $comment_parent = $_POST['comment_parent'];
  $user_id = $_COOKIE['user_id'];

  $meta_value = $_POST['rating'];
  $meta_key = $_POST['meta_key'];
  $comment_id = $_POST['comment_post_ID'];


  require "../my-account/blocks/connect.php";
  $mysql->query("INSERT INTO `ht_comments`( `comment_post_ID`, `comment_author`,`comment_author_email`,`comment_date`, `comment_date_gmt`,`comment_content`, `comment_type`,`comment_parent`, `user_id`) VALUES ('$comment_post_ID','$comment_author','$comment_author_email','$comment_date','$comment_date_gmt','$comment_content','$comment_type','$comment_parent','$user_id')");




  header('Location: index.php');
?>
