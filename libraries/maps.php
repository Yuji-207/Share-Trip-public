<?php


function get_places(array $places) {


  foreach ($places as $index => $place) {


    // $place = escape($place);  // databaseクラスをインスタンス化しないと使えない

    $key = 'key';  // 環境変数やアプリケーションのソースツリー外部に保存
    $url = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?key=$key&input=$place&inputtype=textquery&fields=name,place_id";


    // $json = file_get_contents($url);

    // サーバー上で file_get_contents の allow_url_fopen が0になっているため、cURLで代替
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $json = curl_exec($ch);
    curl_close($ch);

    // $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');  // 文字化け防止
    $place = json_decode($json, true);


    if (!empty($place['candidates'])) {

      $name[] = $place['candidates'][0]['name'];  // nameを配列に追加
      $place_id[] = $place['candidates'][0]['place_id'];  // place_idを配列に追加

    } else {
      return ['status' => FALSE, 'log' => $json];
    }

  }

  return ['status' => TRUE, 'name' => $name, 'place_id' => $place_id];

}


function routes(string $origin, string $destination, array $waypoints) {


    // $origin = escape($origin);  // databaseクラスをインスタンス化しないと使えない
    // $destination = escape($destination);
    
    $key = 'key';
    $url = "https://maps.googleapis.com/maps/api/directions/json?key=$key";


    $origin = get_places([$origin]);
    $destination = get_places([$destination]);
    $waypoints = get_places($waypoints);

    foreach ([$origin, $destination, $waypoints] as $place) {
      if (!$place['status']) return ['status' => -1, 'log' => $place['log']];
    }

    $url .= '&origin=place_id:' . $origin['place_id'][0];
    $url .= '&destination=place_id:' . $destination['place_id'][0];
    $url .= '&waypoints=optimize:true';

    foreach ($waypoints['place_id'] as $waypoint) {
      $url .= '|place_id:' . $waypoint;
    }


    // $json = file_get_contents($url);

    // サーバー上で file_get_contents の allow_url_fopen が0になっているため、cURLで代替
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $json = curl_exec($ch);
    curl_close($ch);

    // $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');  // 文字化け防止
    $direction = json_decode($json, true);


    if (!empty($direction['routes'])) {

      $copyrights = $direction['routes'][0]['copyrights'];
      $order = $direction['routes'][0]['waypoint_order'];
      // $routes = $direction['routes'][0]['legs'];

      $route[] = $origin['name'][0];

      // orderに従ってwaypointsをソート
      foreach ($order as $place) {
        $route[] = $waypoints['name'][$place];
      }

      $route[] = $destination['name'][0];

      return ['status' => 1, 'route' => $route, 'copyrights' => $copyrights];

    } else {
      return ['status' => -2, 'log' => $json];
    }
  
  
  }
?>