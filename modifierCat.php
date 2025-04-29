<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Reasy Admin</title>
    <link rel="icon" type="image/png" href="favicon.ico">

</head>
<body>
    <?php include 'include/navadmin.php' ?>
    <div class="container">
        <?php 
            require_once 'include/DataBase.php';
            $sqlstate = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
            $id = $_GET['id'];
            $sqlstate->execute([$id]);
            $cat = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if (isset($_POST['modifier'])) {
                $nm = $_POST['nom'];
                $desc = $_POST['description'];
                if (!empty($nm) && !empty($desc)) {
                    require_once 'include/DataBase.php';
                    $sqlstate = $pdo->prepare('UPDATE categorie SET nom=?, description=? WHERE id=?');
                    $sqlstate->execute([$nm, $desc, $id]);
                    header('Location: listeCat.php');
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">Champs requis</div>
                    <?php
                }
            }
        ?>
        <h2>Modifier catégorie</h2>
        <form method="POST">
            <input type="hidden" class="form-control" name="id" value="<?php echo $cat['id'] ?>">
            
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" value="<?php echo $cat['nom'] ?>" required>
            
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required><?php echo $cat['description'] ?></textarea>
            
            <input type="submit" value="Modifier catégorie" class="btn btn-primary btn-lg my-3" name="modifier">
        </form>
    </div>
</body>
</html>
