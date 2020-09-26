<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $calendars = new Calendars();
  $Cost_Calendars = new Cost_Calendars();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_GET['id'] || $_POST['from'] || $_POST['to']));


  // データの取得
  $user = $_SESSION['user'];
  $plan = $_GET['plan'];
  $from = $_POST['from'];
  $to = $_POST['to'];
  $budget = $_POST['budget'];
  $hotel = $_POST['hotel'];
  $food = $_POST['food'];
  $tour = $_POST['tour'];
  $others = $_POST['others'];

  // データの登録
  $calendar_id = $calendars -> add($user, $plan, $from, $to);
  $Cost_id = $Cost_Calendars -> add($calendar_id, $budget, $hotel, $food, $tour, $others);


  // リダイレクト
  redirect('../mycalendar.php');


?>
