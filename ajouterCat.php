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
          if(isset($_POST['ajouter'])){
            $nm=$_POST['nom'];
            $desc=$_POST['description'];
            if(!empty($nm) && !empty($desc)){
                require_once 'include/DataBase.php';
                $sqlstate = $pdo -> prepare('INSERT INTO categorie(nom,description) VALUES(?,?)');
                $sqlstate -> execute([$nm,$desc]);
                ?><div class="alert alert-success" role="alert"><?php echo $nm ; ?> est desormais dispo</div> <?php
            }else{
                ?>
                <div class="alert alert-danger" role="alert">required fields</div>
                <?php
            }
          }
        ?>
        <h2>Ajouter Categorie</h2>
        <form method="POST">
                <label class="form-label">nom</label>
                <input type="text" class="form-control" name="nom" required>
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" required></textarea>
                
                <input type="submit" value="Ajouter Categorie" class="btn btn-primary btn-lg my-3" name="ajouter">
        </form>
    </div>
</body>
</html>