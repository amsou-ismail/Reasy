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
        <h2>Liste des categories</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOM</th>
                    <th>DESCRIPTION</th>
                    <th>DATE DE CREATION</th>
                    <th>OPERATION</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $categorie){
                ?><tr>
                    <td><?php echo $categorie['id'] ?></td>
                    <td><?php echo $categorie['nom'] ?></td>
                    <td><?php echo $categorie['description'] ?></td>
                    <td><?php echo $categorie['date_creation'] ?></td>
                    <td>
                    <a href="modifierCat.php?id=<?= $categorie['id'];?>" class="btn btn-primary">modifier</a>
                    <a href="supprimerCat.php?id=<?= $categorie['id'];?>" class="btn btn-danger"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer la catégorie <?php echo $categorie['nom'] ?> ?');">supprimer</a>
                </tr><?php
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>