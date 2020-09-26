<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $good_inst = new Good();
  

  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user']));


  // データの取得
  $user = (int) $_POST['user'];
  $plan = (int) $_POST['plan'];
  $good = (bool) $_POST['good'];


  // いいねの登録

  if (!$good) {
    if ($good_inst -> add($user, $plan)) {
      $json = ['status' => true, 'log' => 'added'];
    } else {
      $json = ['status' => false, 'log' => 'added'];
    }
  }
  
  else {
    if ($good_inst -> delete($user, $plan)) {
      $json = ['status' => true, 'log' => 'deleted'];
    } else {
      $json = ['status' => false, 'log' => 'deleted'];
    }
  }


  // デコード
  echo json_encode($json); 

  
?>