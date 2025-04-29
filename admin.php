<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reasy Admin</title>
  <link rel="icon" type="image/png" href="favicon.ico">

  <link rel="stylesheet" href="assets/style.css"> <!-- Ton CSS glassmorphism -->
</head>
<body>
  <div class="wrapper">
    <?php
      if (isset($_POST['connexion'])) {
          $login = $_POST['login'];
          $pwd = $_POST['password'];

          if ($login === 'y4hy4' && $pwd === 'hhh123') {
              $_SESSION['user']['login'] = $login;
              header('Location: include/adminnav');
              exit();
          } else {
              echo '<div class="alert alert-danger" role="alert">Login ou mot de passe invalide</div>';
          }
      }
    ?>

    <form method="POST">
      <h2>ADMIN ??</h2>
      <div class="input-field">
        <input type="text" name="login" required>
        <label>Enter your login</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Enter your password</label>
      </div>
      <!-- <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
        </label>
        <a href="#">Forgot password?</a>
      </div> -->
      <button type="submit" name="connexion">Log In</button>
      <div class="register">
        <p><a href="connexion.php" style="color:rgb(0, 110, 145);" onmouseover="this.style.color='rgb(133, 0, 181)';" onmouseout="this.style.color='rgb(0, 110, 145)';">QUITER LE MODE DE ADMIN</a></p>
      </div>
    </form>
  </div>
</body>
</html>
