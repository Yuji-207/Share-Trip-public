<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/assets/stylesheets.php' ?>
    <title>Login</title>
  </head>
  <body class="bg-light">

    <?php include __DIR__ . '/assets/header.php' ?>
    <?php redirect('timeline.php', !empty($_SESSION['user'])) ?>

    <main class="col-lg-4 mx-auto p-5">
      <h1 class="text-info text-center mb-3">ログイン</h1>
      <form action="backend/login.php" method="POST">
        <h5>メールアドレス</h5>
        <input class="form-control mb-3" type="email" name="email" placeholder="メールアドレス" required>
        <h5>パスワード</h5>
        <input class="form-control mb-3" type="password" name="password" placeholder="パスワード" required>
        <input class="btn btn-info btn-lg btn-block mt-5" type="submit" value="ログイン">
      </form>

      <!-- ログインエラー -->
      <?php if(!empty($_GET['error'])): ?>
        <?php if($_GET['error'] == '1'): ?>
          <p class="alert alert-danger mt-3">メールアドレスまたはパスワードが正しくありません。</p>
        <?php else: ?>
          <p class="alert alert-danger mt-3">
            このメールアドレスは登録されていません。
            <a class="alert-link" href="signup.php">こちら</a>
            から登録してください。
          </p>
        <?php endif ?>
      <?php endif ?>

    </main>
    <?php include __DIR__ . '/assets/scripts.php' ?>
  </body>
</html>
