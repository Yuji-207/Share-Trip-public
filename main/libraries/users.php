<?php


  class Users extends DataBase {


    function signup(string $name, string $email, string $password) {

      $name = $this -> escape($name);
      $email = $this -> escape($email);
      $password = $this -> escape($password);


      // パスワードの暗号化

      $password .= $email;
      $password = hash('sha256', hash('sha256', $password));



      $stmt = $this->pdo -> prepare('SELECT user_id FROM users WHERE email=:email');
      $stmt -> bindParam(':email', $email);
      $stmt -> execute();
      $result = $stmt -> fetch();
      
      if (empty($result['user_id'])) {

        $stmt = $this->pdo -> prepare('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
        $stmt -> bindParam(':name', $name);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':password', $password);
        $stmt -> execute();  // 実行が失敗した場合のエラー処理
        // 既に登録されているアカウントに対するエラー処理
      
        return (int) $this->pdo -> lastInsertId();

      } else {
        return -1;
      }

    }
    
    
    function login(string $email, string $password) {

      $email = $this -> escape($email);
      $password = $this -> escape($password);


      // パスワードの暗号化

      $password .= $email;
      $password = hash('sha256', hash('sha256', $password));

      
      $stmt = $this->pdo -> prepare('SELECT * FROM users WHERE email=:email');
      $stmt -> bindParam(':email', $email);
      $stmt -> execute();
      $result = $stmt -> fetch();

      if (!empty($result['password'])) {

        if ($password == $result['password']) {
          return array((int) $result['user_id'], $result['name']);

        } else {
          return array(-1, NULL);  // パスワードが一致しない場合
        }

      } else {
        return array(-2, NULL);  // アカウントが存在しない場合
      }


      if ($password == $result['password']) return array((int) $result['user_id'], $result['name']);
      else return array((int) $result['user_id'], NULL);
    
    }


    function get_user(int $id) {

      $stmt = $this->pdo -> prepare('SELECT name FROM users WHERE user_id=:id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      $result = $stmt -> fetch();
    
      return $result['name'];
    
    }
  }
?>