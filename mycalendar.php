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
      $calendars = new Calendars();
      $plans = new Plans();


      $user = $_SESSION['user'];

      // リダイレクト
      redirect('timeline.php', empty($_SESSION['user'] ));

    ?>

    <main class="py-3">
      <div class="col-lg-10 mx-lg-auto m-3">


        <?php $mycalendars = $calendars -> get_all($user) ?>





        <?php foreach ($mycalendars as $mycalendar): ?>

          <?php $plan_id = $mycalendar['plan_id']?>
          <?php $myplans = $plans -> get_plan($plan_id) ?>






          <a class="card border-0 text-reset shadow-sm my-4 " href="mycalendar_plan.php?id=<?= $mycalendar["calendar_id"] ?> " >


            <div class="card bg-dark text-white ">
              <img class="card-img" src="backend/image.php?id=<?= $plan_id ?>" onerror="this.src = 'https://cdn.pixabay.com/photo/2015/07/11/23/02/plane-841441_960_720.jpg';"　alt="Card image"
              style="width: 100%;
              height: 270px;
              object-fit: cover;
              margin-right: 3%;
              filter: brightness(80%)saturate(170%);
              ">

              <div class="card-img-overlay">
                <h5 class="card-title"><?= $mycalendar['from_date'] ?> - <?= $mycalendar['to_date'] ?></h5>
                <p class="card-text"><?= $myplans['title'] ?> への旅行 </p>
                <!-- <p class="card-text">Last updated 3 mins ago</p> -->
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
