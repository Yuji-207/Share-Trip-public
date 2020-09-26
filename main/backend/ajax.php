<?php


  // インクルード
  include __DIR__ . '/../libraries/main.php';
  include __DIR__ . '/../libraries/maps.php';
  

  // リダイレクト
  redirect('timeline.php', empty($_SESSION['user'] || $_POST['origin'] || $_POST['destination'] || $_POST['waypoints']));


  // データの取得
  $origin = $_POST['origin'];
  $destination = $_POST['destination'];
  $waypoints = $_POST['waypoints'];


  // ルートの取得

  $routes = routes($origin, $destination, $waypoints);

  if ($routes['status'] > 0) {

    $json = [
      'status' => $routes['status'],
      'route' => $routes['route'],
      'copyrights' => $routes['copyrights']
    ];

  } else {

    $json = [
      'status' => $routes['status'],
      'log' => $routes['log']
    ];

  }


  // デコード
  echo json_encode($json); 

  
?>