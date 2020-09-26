<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/assets/stylesheets.php' ?>
    <title>Signup</title>
  </head>
  <body class="bg-light">
  
    <?php include __DIR__ . '/assets/header.php' ?>
    <?php redirect('timeline.php', !empty($_SESSION['user'])) ?>

    <main class="col-lg-4 mx-auto p-5">
      <h1 class="text-info text-center mb-3">新規登録</h1>
      <form action="backend/signup.php" method="POST">
        <h5>氏名</h5>
        <input class="form-control mb-3" type="text" name="name" placeholder="氏名" required>
        <h5>メールアドレス</h5>
        <input class="form-control mb-2" type="email" name="email_1" placeholder="メールアドレス" required>
        <input class="form-control mb-3" type="email" name="email_2" placeholder="メールアドレス（確認用）" required>
        <h5>パスワード</h5>
        <input class="form-control mb-2" type="password" name="password_1" placeholder="パスワード" required>
        <input class="form-control mb-3" type="password" name="password_2" placeholder="パスワード（確認用）" required>
        <input class="btn btn-info btn-lg btn-block mb-2" type="submit" value="登録">
      </form>

      <!-- サインアップエラー -->
      <?php if(!empty($_GET['error'])): ?>
        <?php if($_GET['error'] == 1): ?>
          <p class="alert alert-danger mt-3">確認用のメールアドレスが一致しません。</p>
        <?php elseif($_GET['error'] == 2): ?>
          <p class="alert alert-danger mt-3">確認用のパスワードが一致しません。</p>
        <?php else: ?>
          <p class="alert alert-danger mt-3">
            このメールアドレスは既に登録されています。
            <a class="alert-link" href="login.php">こちら</a>
            からログインしてください。
          </p>
        <?php endif ?>
      <?php endif ?>

    </main>
    <footer>
    </footer>
    <?php include __DIR__ . '/assets/scripts.php' ?>
  </body>
</html>