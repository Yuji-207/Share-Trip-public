<?php


  // インクルード

  include __DIR__ . '/../libraries/main.php';
  $users = new Users();


  // リダイレクト

  redirect('timeline.php', empty($_POST['name'] || $_POST['email_1'] || $_POST['email_2'] || $_POST['password_1'] || $_POST['password_2']));


  // フォームデータの取得

  $name = $_POST['name'];
  $email_1 = $_POST['email_1'];
  $email_2 = $_POST['email_2'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  
  
  // アカウントの登録
  if ($email_1 == $email_2) {

    if ($password_1 == $password_2) {
      $user = $users -> signup($name, $email_1, $password_1);
    
    } else {
      redirect('../signup.php?error=2');
    }

  } else {
    redirect('../signup.php?error=1');
  }
  
  
  // セッションの管理

  if ($user >= 0) {

    $_SESSION['user'] = $user;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email_1;
    $_SESSION['password'] = $password_1;

    redirect('../timeline.php');

  } else {

    redirect('../signup.php?error=3');

  }


?>