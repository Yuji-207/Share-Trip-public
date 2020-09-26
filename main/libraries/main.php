<?php


  // インクルード

  include __DIR__ . '/database.php';
  include __DIR__ . '/users.php';
  include __DIR__ . '/plans.php';
  include __DIR__ . '/calendars.php';
  include __DIR__ . '/others.php';
  include __DIR__ . '/money.php';


  // セッション管理

  function redirect(string $location, /*bool*/ $condition=TRUE) {

    if ($condition) {
      header("Location: $location");
      exit;
    }

  }


  // 自動実行
  session_start();


?>
