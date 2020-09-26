<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $plans = new Plans();
  $money = new Money();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_POST['plan'] || $_GET['url']));


  // データを取得
  $user = $_SESSION['user'];
  $plan = $_POST['plan'];
  $url = $_POST['url'];


  // プランの登録
  $money -> add($plan, $user);


  // リダイレクト
  redirect($url);


?>
