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
      
    ?>

    <main class="py-3">
      <div class="col-lg-10 mx-lg-auto m-3">


        <?php $plans = $plans_inst -> get_by_user($user) ?>


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
    </main>
    <footer>
    </footer>
    <?php include __DIR__ . '/assets/scripts.php' ?>
  </body>
</html>