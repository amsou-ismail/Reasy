<?php
session_start();
$message = '';

if (isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];

    if (!empty($login) && !empty($pwd)) {
        // Hachage du mot de passe saisi pour comparaison
        $pwd_hashed = hash('sha256', $pwd);

        require_once 'include/DataBase.php';
        $sql_state = $pdo->prepare('SELECT * FROM user WHERE login=? AND password=?');
        $sql_state->execute([$login, $pwd_hashed]);

        if ($sql_state->rowCount() >= 1) {
            $_SESSION['user'] = $sql_state->fetch();
            header('Location: index.php#pricing');
            exit;
        } else {
            $message = "Login ou mot de passe invalide.";
        }
    } else {
        $message = "Tous les champs sont requis.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reasy</title>
  <link rel="icon" type="image/png" href="favicon.ico">
  <link rel="stylesheet" href="assets/style.css"/>
</head>
<body>
  <div class="wrapper">
    <form method="POST">
      <h2>Connexion</h2>
      <?php if ($message): ?>
        <div class="alert alert-danger"><?= $message ?></div>
      <?php endif; ?>
      <div class="input-field">
        <input type="text" name="login" required>
        <label>Entrez votre login</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Entrez votre mot de passe</label>
      </div>
      <button type="submit" name="connexion">Se connecter</button>
      <div class="register">
        <p>Pas de compte ? <a href="inscreption.php" style="color: #0d6efd;">Inscrivez-vous</a></p><br>
        <p><a href="index.php" style="color: #0d6efd;">HOME</a></p>
      </div>
    </form>
  </div>
</body>
</html>
