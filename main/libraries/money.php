<?php


  class Money extends DataBase {
    

    function add(string $plan, string $user) {

      $plan = (int) $this -> escape($plan);
      $user = (int) $this -> escape($user);

      $sql = 'INSERT INTO money (plan_id, user_id) VALUES(:plan, :user)';
      $stmt = $this->pdo -> prepare($sql);
      $stmt -> bindParam(':plan', $plan, PDO::PARAM_INT);
      $stmt -> bindParam(':user', $user, PDO::PARAM_INT);
      $stmt -> execute();

      return (int) $this->pdo -> lastInsertId();;

    }


    function reserved(string $id) {

      $id = (int) $this -> escape($id);

      // ユーザーが作成したすべてのプランを取得

      $stmt = $this->pdo -> prepare('SELECT plan_id FROM plans WHERE user_id=:id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      $plans = $stmt -> fetchAll();

      // 購入されたプラン数をカウント

      $reserved = 0;
      
      foreach ($plans as $plan) {

        $id = $plan['plan_id'];

        $sql ='SELECT count(*) FROM money WHERE plan_id=:id';
        $stmt = $this->pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $num = $stmt -> fetch();
        $num = (int) $num['count(*)'];
        $reserved += $num;

      }

      return $reserved;

    }


    function profit(string $id) {

      $id = (int) $this -> escape($id);

      // ユーザーが作成したすべてのプランを取得

      $stmt = $this->pdo -> prepare('SELECT * FROM plans WHERE user_id=:id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      $plans = $stmt -> fetchAll();

      // 購入されたプラン数をカウント

      $reserved = 0;
      $profit = 0;
      
      foreach ($plans as $plan) {

        $id = $plan['plan_id'];
        $price = $plan['profit'];

        $sql ='SELECT count(*) FROM money WHERE plan_id=:id';
        $stmt = $this->pdo -> prepare($sql);
        $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $num = $stmt -> fetch();
        $num = (int) $num['count(*)'];

        $reserved += $num;
        $profit += $price * $num;

      }

      return $profit;

    }
  }
?>