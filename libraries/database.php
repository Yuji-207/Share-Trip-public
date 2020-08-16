<?php


  class DataBase {


    public $pdo;

    
    function __construct() {

      $dsn = 'dsn';
      $user = 'user';
      $password = 'password';

      $this->pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    }


    // エスケープ処理

    function escape(string $string=NULL) {
      return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5, 'UTF-8');
    }


    // 画像圧縮

    function compress_img(string $file) {

      $rate = 5;  // 圧縮率

      list($width, $height) = getimagesize($file);  // 画像サイズの取得
      $image = file_get_contents($file);  // 画像データの読み込み

      // 拡張子を判別
      $handle = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_buffer($handle, $image);
      finfo_close($handle);

      // 拡張子で条件分岐
      if ($mime ==  'image/jpeg') $image = imagecreatefromjpeg($file);
      elseif ($mime == 'image/png') $image = imagecreatefrompng($file);
      elseif ($mime == 'image/gif') $image = imagecreatefromgif($file);
      else return NULL;

      $new_width = $width/$rate;  // 圧縮後の横幅
      $new_height = $height/$rate;  // 圧縮後の横幅

      $new_image = imagecreatetruecolor($new_width, $new_height);  // 新規画像作成
      imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);  // 元の画像を圧縮

      $file = 'image.jpeg';
      imagejpeg($new_image, $file);  

      return $file;

    }
  }
?>