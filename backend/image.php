<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  $plans = new Plans();


  // リダイレクト
  redirect('timeline.php', empty($_GET['id']));


  // データの取得

  $id = $_GET['id'];
  $plan = $plans -> get_plan($id);
  $image = $plan['image'];

  header("Content-Type: image/jpg");
  echo $image;


?>