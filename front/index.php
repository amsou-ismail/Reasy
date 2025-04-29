<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <title>Reasy</title>
</head>
<body>
    <?php include '../include/navuser.php' ?>
 <div class="container d-flex align-items-center gap-2"><i class="fa fa-light fa-list"></i><h2>Liste des categories</h2></div>

    <div class="container py-2">
        <?php 
            require_once '../include/DataBase.php';
            $cat = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
        ?>
        <ul class="list-group list-group-flush w-25">
            <?php
                foreach($cat as $categorie){
                    ?><li class="list-group-item">
                    <a class="btn btn-light" href="categorie.php?id=<?php echo $categorie->id?>">
                        <?php echo $categorie->nom ?>
                    </a>
                    </li>
                    <?php
                }
            ?>
        </ul>
    </div>
</body>
</html>