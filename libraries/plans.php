<?php


  class Plans extends DataBase {

    
    function make(string $user, string $title, string $schedule, string $comment=NULL, string $image=NULL) {

      $user = (int) $this -> escape($user);
      $title = $this -> escape($title);
      $schedule = $this -> escape($schedule);
      $comment = $this -> escape($comment);
      // $image = $this -> escape($image);  XSSはどうする？

      $stmt = $this->pdo -> prepare('INSERT INTO plans (title, schedule, comment, image, user_id) VALUES(:title, :schedule, :comment, :image, :user)');
      $stmt -> bindParam(':title', $title);
      $stmt -> bindParam(':schedule', $schedule);
      $stmt -> bindParam(':comment', $comment);
      $stmt -> bindParam(':image', $image);
      $stmt -> bindParam(':user', $user, PDO::PARAM_INT);
      $stmt -> execute();  // 実行が失敗した場合のエラー処理
    
      return (int) $this->pdo -> lastInsertId();
    
    }


    function edit_plan(string $id, string $title, string $schedule, string $comment=NULL, string $image=NULL) {

      $id = (int) $this -> escape($id);
      $title = $this -> escape($title);
      $schedule = $this -> escape($schedule);
      $comment = $this -> escape($comment);
      // $image = $this -> escape($image);

      $stmt = $this->pdo -> prepare('UPDATE plans SET title=:title, schedule=:schedule, comment=:comment, image=:image WHERE plan_id = :id');
      $stmt -> bindParam(':title', $title);
      $stmt -> bindParam(':schedule', $schedule);
      $stmt -> bindParam(':comment', $comment);
      $stmt -> bindParam(':image', $image);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();  // 実行が失敗した場合のエラー処理

    }


    function delete(string $id) {

      $id = (int) $this -> escape($id);

      $sql = 'DELETE FROM plans WHERE plan_id=:id';
      $stmt = $this->pdo -> prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      
    }


    function get_plan(string $id) {

      $id = (int) $this -> escape($id);    
      $stmt = $this->pdo -> prepare('SELECT * FROM plans WHERE plan_id = :id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      // エラー処理
    
      return $stmt -> fetch();
    
    }
    
    
    function get_all() {
    
      $sql = 'SELECT * FROM plans ORDER BY plan_id DESC';
      $stmt = $this->pdo -> query($sql);
      
      return $stmt -> fetchAll();

    }


    function get_by_user(string $id, /*bool*/ $ascending=FALSE) {

      $id = (int) $this -> escape($id);

      if ($ascending) $stmt = $this->pdo -> prepare('SELECT * FROM plans WHERE user_id = :id');
      else $stmt = $this->pdo -> prepare('SELECT * FROM plans WHERE user_id = :id ORDER BY plan_id DESC');
      
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
    
      return $stmt -> fetchAll();

    }


    function get_by_title(string $search) {

      $search = $this -> escape($search);
      $search = '%' . $search . '%';

      $stmt = $this->pdo -> prepare(
        'SELECT * FROM plans WHERE title LIKE :search OR schedule LIKE :search OR comment LIKE :search ORDER BY plan_id DESC'
      );
      $stmt -> bindParam(':search', $search);
      $stmt -> execute();
    
      return $stmt -> fetchAll();

    }
  }
?>