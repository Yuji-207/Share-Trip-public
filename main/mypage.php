<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/assets/stylesheets.php' ?>
    <title>Mypage</title>
  </head>
  <body class="bg-light">
    <header>
    </header>

    <?php

      include __DIR__ . '/assets/header.php';

      $plans_inst = new Plans();

      $user = $_SESSION['user'];

      $good = new Good();
      $money = new Money();
      $countplan = $plans_inst -> get_by_user($user);
      $bookmarked = $good -> bookmarked($user);
      $reserved = $money -> reserved($user);
      $profit_inst = $money -> profit($user);



    ?>

    <main class="py-3">
      <div class="col-lg-10 mx-lg-auto m-3">


        <?php $plans = $plans_inst -> get_by_user($user);
              $mybookmarks = $good -> get_by_user($user);
         ?>

        <table class="table">
          <thead>
            <tr>
              <th scope="col"><h5 class="text-center">投稿したプラン数</h5></th>
              <th scope="col"><h5 class="text-center">ブックマークされたプラン数</h5></th>
              <th scope="col"><h5 class="text-center">予約された件数</h5></th>
              <th scope="col"><h5 class="text-center">収益</h5></th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row"><h2 class="text-center"><?=count($countplan)?>件</h2></th>
              <td><h2 class="text-center"><?= $bookmarked?>件</h2></td>
              <td><h2 class="text-center"><?= $reserved ?>件</h2></td>
              <td><h2 class="text-center"><?= $profit_inst ?>円</h2></td>

            </tr>
          </tbody>
        </table>

        <div class="p-3">
<!-- タブボタン部分 -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a href="#tab1" class="nav-link" data-toggle="tab">作成したプラン</a>
  </li>
  <li class="nav-item">
    <a href="#tab2" class="nav-link active" data-toggle="tab">ブックマーク</a>
  </li>

</ul>

<!--タブのコンテンツ部分-->
<div class="tab-content">
  <div id="tab1" class="tab-pane">

    <?php foreach ($plans as $plan): ?>
              <a class="card border-0 text-reset shadow-sm my-4" href="plan.php?id=<?= $plan['plan_id'] ?>">
                <div class="row no-gutters justify-content-end">

                  <?php if(!empty($plan['image'])): ?>
                    <img class="card-img-top col-md-6" src="backend/image.php?id=<?= $plan['plan_id'] ?>" alt="image">
                  <?php endif ?>

                  <div class="col-md-6">
                    <div class="card-body">
                      <h2 class="card-title text-body"><?= $plan['title'] ?>への旅行</h2>
                      <p class="card-text text-secondary"><?= $plan['schedule'] ?></p>
                      <p class="card-text text-secondary"><?= $plan['comment'] ?></p>
                      <small class="card-text"><?= $plan['created_at'] ?></small>
                    </div>
                  </div>
                </div>
              </a>
            <?php endforeach ?>
  </div>
  <div id="tab2" class="tab-pane active">

    <?php foreach ($mybookmarks as $mybookmark): ?>
              <a class="card border-0 text-reset shadow-sm my-4" href="plan.php?id=<?= $mybookmark['plan_id']?>">
                <div class="row no-gutters justify-content-end">

                  <?php if(!empty($plan['image'])): ?>
                    <img class="card-img-top col-md-6" src="backend/image.php?id=<?= $mybookmark['plan_id']?>" alt="image">
                  <?php endif ?>
                  <?php $mytitle = $plans_inst -> get_plan($mybookmark['plan_id']); ?>
                  <div class="col-md-6">
                    <div class="card-body">
                      <h2 class="card-title text-body"><?= $mytitle['title'] ?>への旅行</h2>
                      <p class="card-text text-secondary"><?= $mytitle['schedule'] ?></p>
                      <p class="card-text text-secondary"><?= $mytitle['comment'] ?></p>
                      <small class="card-text"><?= $mytitle['created_at'] ?></small>
                    </div>
                  </div>
                </div>
              </a>
            <?php endforeach ?>

    </div>
  </div>

</div>

</div>
      </div>
    </main>
    <footer>
    </footer>
    <?php include __DIR__ . '/assets/scripts.php' ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
