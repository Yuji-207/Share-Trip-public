<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  include __DIR__ . '/../libraries/maps.php';
  $plans = new Plans();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_POST['title'] || $_POST['origin'] || $_POST['destination'] || $_POST['waypoints']));


  // データを取得
  $user = $_SESSION['user'];
  $title = $_POST['title'];
  $origin = $_POST['origin'];
  $destination = $_POST['destination'];
  $waypoints = $_POST['waypoints'];
  $comment = $_POST['comment'];


  // スケジュールを作成

  $schedule = $origin;

  foreach ($waypoints as $waypoint) {
    $schedule .=  ' > ' . $waypoint;
  }

  $schedule .= ' > ' . $destination;


  // 画像の処理

  if (!empty($_GET['id'])) {

    $id = $_GET['id'];
    $plan = $plans -> get_plan($id);
    $image = $plan['image'];


  } elseif (!empty($_FILES['image']['tmp_name'])) {

    $file = $plans -> compress_img($_FILES['image']['tmp_name']);
    $image = file_get_contents($file);

  }

  if (!empty($_POST['img_del']))  $image = NULL;


  // プランの登録
  $id = $plans -> make($user, $title, $schedule, $comment, $image);

  
  // リダイレクト
  redirect("../plan.php?id=$id");


?>