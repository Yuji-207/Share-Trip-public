<?php


  class Good extends DataBase {
    

    function add(int $user, int $plan) {

      $id = $this -> get($user, $plan);

      if ($id < 0) {

        $sql = 'INSERT INTO good (user_id, plan_id) VALUES(:user, :plan)';
        $stmt = $this->pdo -> prepare($sql);
        $stmt -> bindParam(':user', $user, PDO::PARAM_INT);
        $stmt -> bindParam(':plan', $plan, PDO::PARAM_INT);
        $stmt -> execute();

        return True;

      } else {
        return False;
      }

    }


    function delete(int $user, int $plan) {

      $id = $this -> get($user, $plan);

      if ($id >= 0) {

        $sql = 'DELETE FROM good WHERE good_id=:id';
        $stmt = $this->pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();

        return True;

      } else {
        return False;
      }

    }


    function get(int $user, int $plan) {

      $stmt = $this->pdo -> prepare('SELECT good_id FROM good WHERE user_id=:user AND plan_id=:plan');
      $stmt -> bindParam(':user', $user, PDO::PARAM_INT);
      $stmt -> bindParam(':plan', $plan, PDO::PARAM_INT);
      $stmt -> execute();
      
      $id = $stmt -> fetch();

      if (is_array($id)) return (int) $id['good_id'];
      else return -1;
    
    }


    function get_by_user(string $id, /*bool*/ $ascending=FALSE) {

      $id = (int) $this -> escape($id);

      if ($ascending) $sql ='SELECT * FROM good WHERE user_id=:id';
      else $sql = 'SELECT * FROM good WHERE user_id=:id ORDER BY good_id DESC';

      $stmt = $this->pdo -> prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetchAll();

    }


    function get_by_plan(string $id) {

      $id = (int) $this -> escape($id);

      $sql = 'SELECT * FROM good WHERE plan_id=:id';
      $stmt = $this->pdo -> prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetchAll();

    }


    function bookmarked(string $id) {

      $id = (int) $this -> escape($id);

      // ユーザーが作成したすべてのプランを取得

      $stmt = $this->pdo -> prepare('SELECT plan_id FROM plans WHERE user_id=:id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      $plans = $stmt -> fetchAll();

      // ブックマークされたプラン数をカウント

      $bookmarked = 0;
      
      foreach ($plans as $plan) {

        $id = $plan['plan_id'];

        $sql ='SELECT count(*) FROM good WHERE plan_id=:id';
        $stmt = $this->pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $num = $stmt -> fetch();
        $num = (int) $num['count(*)'];
        $bookmarked += $num;

      }

      return $bookmarked;

    }
  }
?>