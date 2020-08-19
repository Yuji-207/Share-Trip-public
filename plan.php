<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/assets/stylesheets.php' ?>
    <title>Plan</title>
  </head>
  <body class="bg-light">
    <header>
    </header>

    <?php


      // インクルード
      include __DIR__ . '/assets/header.php';
      $users = new Users();
      $plans = new Plans();


      // リダイレクト
      redirect('timeline.php', empty($_GET['id']));


      // データの取得
      $id = $_GET['id'];
      $plan = $plans -> get_plan($id);
      $title = $plan['title'];
      $schedule = $plan['schedule'];
      $comment = $plan['comment'];
      $image = $plan['image'];
      $date = $plan['created_at'];
      $name_id = $plan['user_id'];
      $name = $users -> get_user($name_id);


      // sheduleを配列に分割
      $split = $plans -> escape(' > ');
      $schedule = explode($split, $schedule);


    ?>

    <main class="card bg-light border-0 p-3">
      <div class="row no-gutters">
        <?php if(!empty($image)): ?>
          <img class="card-img-top col-md-6" src="backend/image.php?id=<?= $id ?>" alt="image">
        <?php endif ?>
            <div class="col-md-6 mx-md-auto">
              <div class="card-body">

              <!-- form -->
                <form>
                  <h5>タイトル</h5>
                  <div class="input-group mb-2">
                    <input class="form-control bg-light" type="text" value="<?= $title ?>" readonly>
                    <div class="input-group-append">
                      <span class="input-group-text">への旅行</span>
                    </div>
                  </div>
                  <p class="small text-right mb-3">created at <?= $date ?> by <?= $name ?></p>
                  <h5>スケジュール</h5>
                  <?php foreach ($schedule as $index => $place): ?>
                    <?php if ($index == 0): ?>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">出発</span>
                        </div>
                        <input class="form-control bg-light" type="text" value="<?= $place ?>" readonly>
                      </div>
                    <?php elseif ($index < count($schedule) - 1): ?>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text">></span>
                        </div>
                        <input class="form-control bg-light" type="text" value="<?= $place ?>" readonly>
                      </div>
                    <?php else: ?>
                      <div class="input-group mb-5">
                        <div class="input-group-prepend">
                          <span class="input-group-text">到着</span>
                        </div>
                        <input class="form-control bg-light" type="text" value="<?= $place ?>" readonly>
                      </div>
                    <?php endif ?>
                  <?php endforeach ?>

                  <!-- ルート最適化実装前の投稿への対応 -->
                  <?php if (count($schedule) < 3): ?>
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">></span>
                      </div>
                      <input class="form-control bg-light" type="text" value="<?= $place ?>" readonly>
                    </div>
                    <div class="input-group mb-5">
                      <div class="input-group-prepend">
                        <span class="input-group-text">到着</span>
                      </div>
                      <input class="form-control bg-light" type="text" value="<?= $place ?>" readonly>
                    </div>
                  <?php endif ?>
                  
                  <h5>コメント</h5>
                  <textarea class="form-control bg-light mb-5" cols="30" rows="10" readonly><?= $comment ?></textarea>
                </form>

                <?php if(!empty($_SESSION['user'])): ?>

                  <button type="button" class="btn btn-info btn-lg btn-block mt-4 mb-2" data-toggle="modal" data-target="#testModal">カレンダー登録</button>

                  <!-- ボタン・リンククリック後に表示される画面の内容 -->
                  <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">出発日・帰宅日登録</h4>
                      </div>
                      <div class="modal-body">
                        <form action="backend/calendar.php?plan=<?= $id ?>" method="POST">
                          <label>出発日</label>
                          <input class="mb-2" id="departure" type="date" name="from" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" required>
                          <br>
                          <br>
                          <label>帰宅日</label>
                          <input id='arrival' type="date" name="to" value="<?php echo date('Y-m-d');  ?>" required>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                          <button type="submit" class="btn btn-info" >登録</button>
                        </form>
                      </div>
                    </div>
                    </div>
                  </div>

                  <?php if($_SESSION['user'] == $name_id): ?>
                    <a class="btn btn-info btn-lg btn-block" href="edit.php?id=<?= $id ?>">プランを変更</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-lg btn-block border-info text-info" data-toggle="modal" data-target="#exampleModal">削除</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header border-0">
                            <h5 class="modal-title" id="exampleModalLabel">本当に削除しますか？</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                              一度削除したプランは復元できません。
                            </div>
                            <div class="modal-footer border-0">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            <a class="btn btn-danger" href="backend/delete.php?id=<?= $id ?>">削除</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <a class="btn btn-info btn-lg btn-block" href="edit.php?id=<?= $id ?>">カスタマイズする</a>
                  <?php endif ?>
                <?php endif ?>

                 <!-- <a class="btn btn-lg btn-block border-info text-info mt-4" href="timeline.php">登録する</a> -->
                <a class="btn btn-lg btn-block border-info text-info mt-4" href="timeline.php">戻る</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>
    </footer>
    <?php include __DIR__ . '/assets/scripts.php' ?>
    <script src="/assets/scripts/calendar_modal.js">
    </script>
  </body>
</html>
