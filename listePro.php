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
    <?php include 'include/navadmin.php';
    require_once 'include/DataBase.php';
    ?>
    <div class="container">
        <h2>Liste des produits</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID_CATEGORIE</th>
                    <th>PRIX</th>
                    <th>NOM</th>
                    <th>DISCOUNT</th>
                    <th>PRIX APRES DISCOUNT</th>
                    <th>DATE DE CREATION</th>
                    <th>DESCRIPTION</th>
                    <th>OPERATION</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $categories = $pdo->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $produit){
                ?><tr>
                    <td><?php echo $produit['id'] ?></td>
                    <td><?php echo $produit['id_categorie'] ?></td>
                    <td><?php echo $produit['prix'] ?> $</td>
                    <td><?php echo $produit['nom'] ?></td>
                    <td><?php echo $produit['discount'] ?> % OFF</td>
                    <td><?=($produit['prix'] -($produit['prix']*$produit['discount'])/100 ) ?> $</td>
                    <td><?php echo $produit['date_creation'] ?></td>
                    <td><?php echo $produit['description'] ?></td>
                    <td>
                    <a href="modifierPro.php?id=<?php echo $produit['id']; ?>" class="btn btn-primary">modifier</a> <!--la modif et supp se fait par id-->
                    <a href="supprimerPro.php?id=<?= $produit['id'] ?>" class="btn btn-danger"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer le produit <?php echo $produit['nom'] ?> ?');">supprimer</a>
                    </td>
                </tr><?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>