<?php


  // インクルード
  
  include __DIR__ . '/../libraries/main.php';
  $plans = new Plans();
  

  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_GET['id']));


  // データの取得
  $user = $_SESSION['user'];
  $id = $_GET['id'];

  $plan = $plans -> get_plan($id);
  $name_id = $plan['user_id'];


  // プランの削除
  if ($user == $name_id) $plans -> delete($id);

  
  // リダイレクト
  redirect('../timeline.php?from=delete');

  
?>