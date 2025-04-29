<?php 
    $id = $_GET['id'];
    require_once '../include/DataBase.php';
    $sqlstate = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
    $sqlstate -> execute([$id]);
    $categorie = $sqlstate->fetch(PDO::FETCH_ASSOC);
    $sqlstate = $pdo->prepare('SELECT * FROM produit WHERE id_categorie=?');
    $sqlstate ->execute([$id]);
    $prods=$sqlstate->fetchAll(PDO::FETCH_OBJ);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Reasy | <?php echo $categorie['nom'] ?></title>
</head>
<body>
<?php include '../include/nav_front.php' ?>
<div class="container py-2">
    <h2>
        <?php echo $categorie['nom']; ?>
    </h2>
        <div class="container">
            <div class="row">
                <?php 
                foreach($prods as $produit){
                    ?>
                    <div class="card mb-3">
                        <img class="card-img-top" src="../upload/<?php echo $produit->image ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produit->nom ?></h5>
                            <p class="card-text"><?php echo $produit->description ?></p>
                            <p class="card-text"><?php echo ($produit->prix -($produit->prix * $produit->discount)/100) ?> $</p>
                            <p class="card-text"><?php echo $produit->discount ?> % OFF</p>
                            <p class="card-text" style="text-decoration: line-through;"><?php echo $produit->prix ?> $</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>



<?php 
    // Récupérer l'ID de la catégorie depuis l'URL
    $id = $_GET['id'] ?? null;

    // Connexion à la base de données
    require_once '../include/DataBase.php';

    // Requête pour récupérer les produits de cette catégorie
    $sql = $pdo->prepare('SELECT * FROM produit WHERE id_categorie = ?');
    $sql->execute([$id]);
    $prods = $sql->fetchAll(PDO::FETCH_OBJ);

    // Récupérer les informations de la catégorie
    $sql_cat = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
    $sql_cat->execute([$id]);
    $categorie = $sql_cat->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Produits de la catégorie | <?php echo $categorie['nom']; ?></title>
</head>
<body>
    <div class="container py-3">
        <h2>Produits de la catégorie : <?php echo $categorie['nom']; ?></h2>

        <div class="row">
            <?php 
                foreach($prods as $produit) {
            ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="../upload/<?php echo $produit->image ?>" alt="Image du produit">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $produit->nom; ?></h5>
                            <p class="card-text"><?php echo $produit->description; ?></p>
                            <p class="card-text">
                                <?php 
                                    $prixFinal = $produit->prix - ($produit->prix * $produit->discount) / 100;
                                    echo $prixFinal . " $"; 
                                ?>
                            </p>
                            <p class="card-text">
                                <span class="text-muted">Avant : <s><?php echo $produit->prix . " $"; ?></s></span>
                                <span class="badge bg-success"><?php echo $produit->discount ?>% OFF</span>
                            </p>

                            <!-- Affichage de la disponibilité -->
                            <p class="card-text">
                                <?php if ($produit->disponibilite == 0): ?>
                                    <span class="text-danger">Indisponible</span>
                                <?php else: ?>
                                    <a href="reserver.php?id=<?php echo $produit->id; ?>" class="btn btn-success">Réserver</a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>
