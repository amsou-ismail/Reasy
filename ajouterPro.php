<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Reasy Admin</title>
    <link rel="icon" type="image/png" href="favicon.ico">

</head>
<body>
<?php include 'include/navadmin.php'; ?>
<div class="container">
<?php 
require_once 'include/DataBase.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['ajouter'])) {
    $nom = trim($_POST['nom']);
    $prix = trim($_POST['prix']);
    $discount = trim($_POST['discount']);
    $categorie = intval($_POST['categorie']);
    $societe = intval($_POST['societe']);
    $description = trim($_POST['description']);
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $filename = uniqid() . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], 'upload/' . $filename);
    }

    if ($nom && $prix && $categorie && $societe && $description) {
        $sqlstate = $pdo->prepare('
            INSERT INTO produit (id_categorie, id_soc, prix, nom, discount, description, image)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ');
        $sqlstate->execute([$categorie, $societe, $prix, $nom, $discount, $description, $filename ?? '']);

        echo '<div class="alert alert-success" role="alert">'
           . htmlspecialchars($nom) . ' a été ajouté avec succès !
           </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
              Tous les champs sont requis !
              </div>';
    }
}
?>

<h2>Ajouter Produit</h2>

<form method="POST" enctype="multipart/form-data">
    <label class="form-label">Nom du produit</label>
    <input type="text" class="form-control" name="nom" required>

    <label class="form-label">Image</label>
    <input type="file" class="form-control" name="image">

    <?php 
    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
    $societes = $pdo->query('SELECT * FROM societes')->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <label class="form-label">Catégorie</label>
    <select name="categorie" class="form-select" required>
        <option value="">-- Sélectionnez une catégorie --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nom']); ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Société</label>
    <select name="societe" class="form-select" required>
        <option value="">-- Sélectionnez une société --</option>
        <?php foreach ($societes as $soc): ?>
            <option value="<?php echo $soc['id_societe']; ?>"><?php echo htmlspecialchars($soc['nom']); ?></option>
        <?php endforeach; ?>
    </select>

    <label class="form-label">Description</label>
    <textarea class="form-control" name="description" required></textarea>

    <label class="form-label">Discount (%)</label>
    <input type="number" class="form-control" name="discount" value="0" min="0" max="100" required>

    <label class="form-label">Prix</label>
    <input type="number" class="form-control" name="prix" step="0.1" min="0" required>

    <input type="submit" value="Ajouter Produit" class="btn btn-primary btn-lg my-3" name="ajouter">
</form>
</div>
</body>
</html>
