<?php


  // インクルード

  include __DIR__ . '/../libraries/main.php';
  include __DIR__ . '/../libraries/maps.php';
  $plans = new Plans();


  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_GET['id'] ||$_POST['title'] || $_POST['origin'] || $_POST['destination'] || $_POST['waypoints']));


  // データの取得
  
  $user = $_SESSION['user'];
  $id = $_GET['id'];
  $title = $_POST['title'];
  $origin = $_POST['origin'];
  $destination = $_POST['destination'];
  $waypoints = $_POST['waypoints'];
  $comment = $_POST['comment'];

  
  if (!empty($_FILES['image']['tmp_name'])) {

    $file = $plans -> compress_img($_FILES['image']['tmp_name']);
    $image = file_get_contents($file);

  } else {

    $plan = $plans -> get_plan($id);
    $image = $plan['image'];

  }
  
  if (!empty($_POST['img_del']))  $image = NULL;



  // プランの編集
  if ($user == $name_id) $plans -> edit_plan($id, $title, $schedule, $comment, $image);


  //リダイレクト
  redirect("../plan.php?id=$id");


?>