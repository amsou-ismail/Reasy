<?php
$message = '';

if (isset($_POST['ajouter'])) {
    $login = $_POST['login'];
    $pwd = $_POST['password'];

    if (!empty($login) && !empty($pwd)) {
        // Hashage SHA-256
        $pwd_hashed = hash('sha256', $pwd);

        require_once 'include/DataBase.php';
        $date = date('Y-m-d H:i:s');
        $sql_state = $pdo->prepare('INSERT INTO user VALUES (NULL, ?, ?, ?)');
        $sql_state->execute([$login, $pwd_hashed, $date]);

        // Rediriger vers la même page avec un paramètre ?success=1
        header('Location: inscreption.php?success=1');
        exit;
    } else {
        $message = "Tous les champs sont requis.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reasy</title>
  <link rel="stylesheet" href="assets/style.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="favicon.ico">

</head>
<body>

  <div class="wrapper">
    <form method="POST">
      <h2 style="color: white; font-weight: bold;" >Inscription</h2>

      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success">Inscription réussie ! Vous pouvez maintenant vous <a href="connexion.php" style="color: #0d6efd;">connecter</a>.</div>
      <?php elseif (!empty($message)): ?>
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
      <button type="submit" name="ajouter">Créer un compte</button>

      <div class="register">
        <p>Déjà inscrit ? <a href="connexion.php" style="color: #0d6efd;">Connectez-vous</a></p><br>
        <p><a href="index.php" style="color: #0d6efd;">HOME</a></p>
      </div>
    </form>
  </div>
  <?php include 'chatbot_component.php'; ?>

</body>
</html>
