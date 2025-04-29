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
            $sqlstate = $pdo->prepare('SELECT * FROM produit WHERE id=?');
            $id = $_GET['id'];
            $sqlstate->execute([$id]);
            $prod = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if (isset($_POST['modifier'])) {
                $nm = $_POST['nom'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $desc = $_POST['description'];
                if (!empty($nm) && !empty($desc) && !empty($prix)) {
                    $sqlstate = $pdo->prepare('UPDATE produit SET nom=?, prix=?, discount=?, description=? WHERE id=?');
                    $sqlstate->execute([$nm, $prix, $discount, $desc, $id]);
                    header('Location: listePro.php');
                } else {
                    ?>
                    <div class="alert alert-danger" role="alert">Champs requis</div>
                    <?php
                }
            }
        ?>
        <h2>Modifier Produit</h2>
        <form method="POST">
            <input type="hidden" class="form-control" name="id" value="<?php echo $prod['id'] ?>">
            
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" value="<?php echo $prod['nom'] ?>" required>
            
            <label class="form-label">Prix</label>
            <input type="text" class="form-control" name="prix" value="<?php echo $prod['prix'] ?>" required>
            
            <label class="form-label">Discount</label>
            <input type="number" class="form-control" name="discount" min="0" max="100" value="<?php echo $prod['discount'] ?>" required>
            
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required><?php echo $prod['description'] ?></textarea>
            
            <input type="submit" value="Modifier Produit" class="btn btn-primary btn-lg my-3" name="modifier">
        </form>
    </div>
</body>
</html>
