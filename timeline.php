<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/assets/stylesheets.php' ?>
    <title>Timeline</title>
  </head>
  <body class="bg-light">

    <?php include __DIR__ . '/assets/header.php' ?>
    <?php $plans_inst = new Plans() ?>

    <main class="container-fluid py-3">

      <!-- delete alert -->
      <?php if(!empty($_GET['from'])): ?>
        <?php if($_GET['from'] == 'delete'): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            プランを削除しました。
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php elseif($_GET['from'] == 'deletecalendar'): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            プランをカレンダーから削除しました。
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif ?>
      <?php endif ?>

      <!-- from backend/deletecalendar.php -->
      <?php if(!empty($_GET['from'])): ?>
      <?php if($_GET['from'] == 'delete'): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          プランを削除しました。
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif ?>
    <?php endif ?>
    

      <!-- Cards -->

      <?php

        if (empty($_GET['search'])) $plans = $plans_inst -> get_all();
        else $plans = $plans_inst -> get_by_title($_GET['search']);

      ?>

      <?php if (!empty($plans)): ?>
        <div class="card-columns">
          <?php foreach ($plans as $plan): ?>
            <a class="card border-0 text-reset shadow-sm" href="plan.php?id=<?= $plan['plan_id'] ?>">
              <?php if(!empty($plan['image'])): ?>
                <img class="card-img-top" src="backend/image.php?id=<?= $plan['plan_id'] ?>" alt="image">
              <?php endif ?>
              <div class="card-body">
                <h2 class="card-title text-body"><?= $plan['title'] ?>への旅行</h2>
                <p class="card-text text-secondary"><?= $plan['schedule'] ?></p>
              </div>
            </a>
          <?php endforeach ?>
        </div>
      <?php else: ?>
        <p class="alert alert-warning mt-3">プランがありません。</p>
      <?php endif ?>


      </div>
    </main>
    <footer>
    </footer>
    <?php include __DIR__ . '/assets/scripts.php' ?>
  </body>
</html>