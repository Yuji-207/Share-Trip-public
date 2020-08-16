<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $calendars = new Calendars();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_GET['id'] || $_POST['from'] || $_POST['to']));


  // データの取得
  $user = $_SESSION['user'];
  $plan = $_GET['plan'];
  $from = $_POST['from'];
  $to = $_POST['to'];


  // データの登録
  $id = $calendars -> add($user, $plan, $from, $to);


  // リダイレクト
  redirect('../mycalendar.php');


?>
