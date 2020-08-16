<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $calendars = new Calendars();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_GET['id']));


  // データの取得
  $user = $_SESSION['user'];
  $id = $_GET['id'];
  $calendar = $calendars -> get_calendar($id);
  $name_id = $calendar['user_id'];


  // プランの削除
  if ($user == $name_id) $calendars -> delete($id);


  // リダイレクト
  redirect('../timeline.php?from=deletecalendar');


?>
