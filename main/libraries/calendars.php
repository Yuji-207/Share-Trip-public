<?php

  class Cost_Calendars extends DataBase {


    function add(string $calendar_id, string $budget, string $hotel, string $food, string $tour, string $others) {

      $calendar_id = $this -> escape($calendar_id);
      $budget = (int) $this -> escape($budget);
      $hotel = (int) $this -> escape($hotel);
      $food = $this -> escape($food);
      $tour = $this -> escape($tour);
      $others = $this -> escape($others);

      $stmt = $this->pdo -> prepare('INSERT INTO cost_calendars (calendar_id, total, hotel, food, tour, others) VALUES(:calendar_id, :total, :hotel, :food, :tour, :others)');
      $stmt -> bindParam(':calendar_id', $calendar_id);
      $stmt -> bindParam(':total', $budget);
      $stmt -> bindParam(':hotel', $hotel);
      $stmt -> bindParam(':food', $food);
      $stmt -> bindParam(':tour', $tour);
      $stmt -> bindParam(':others', $others);
      $stmt -> execute();  // 実行が失敗した場合のエラー処理

      return (int) $this->pdo -> lastInsertId();

    }

    function get(string $id) {

      $id = (int) $this -> escape($id);
      $stmt = $this->pdo -> prepare('SELECT * FROM cost_calendars WHERE calendar_id = :id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      // エラー処理

      return $stmt -> fetch();

    }
  }


  class Calendars extends DataBase {


    function add(string $user, string $plan, string $from, string $to) {

      $user = (int) $this -> escape($user);
      $plan = (int) $this -> escape($plan);
      $from = $this -> escape($from);
      $to = $this -> escape($to);

      $stmt = $this->pdo -> prepare('INSERT INTO calendars (user_id, plan_id, from_date, to_date) VALUES(:user, :plan, :from, :to)');
      $stmt -> bindParam(':user', $user);
      $stmt -> bindParam(':plan', $plan);
      $stmt -> bindParam(':from', $from);
      $stmt -> bindParam(':to', $to);
      $stmt -> execute();  // 実行が失敗した場合のエラー処理

      return (int) $this->pdo -> lastInsertId();

    }


    /*
    function get(string $id) {
      //登録したプランの表示用
      //get_plan()を参考
    }
    */


    function get_calendar(string $id) {

      $id = (int) $this -> escape($id);
      $stmt = $this->pdo -> prepare('SELECT * FROM calendars WHERE calendar_id = :id');
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();
      // エラー処理

      return $stmt -> fetch();

    }


    function get_all(string $user, /*bool*/ $ascending=FALSE) {

      $user = (int) $this -> escape($user);

      if ($ascending) $stmt = $this->pdo -> prepare('SELECT * FROM calendars WHERE user_id = :user');
      else $stmt = $this->pdo -> prepare('SELECT * FROM calendars WHERE user_id = :user ORDER BY calendar_id DESC');

      $stmt -> bindParam(':user', $user, PDO::PARAM_INT);
      $stmt -> execute();

      return $stmt -> fetchAll();

    }


    function delete(string $id) {

      $id = (int) $this -> escape($id);

      $sql = 'DELETE FROM calendars WHERE calendar_id=:id';
      $stmt = $this->pdo -> prepare($sql);
      $stmt -> bindParam(':id', $id, PDO::PARAM_INT);
      $stmt -> execute();

    }
  }


?>
