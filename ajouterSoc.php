<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reasy Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.ico">

</head>
<body>
    <?php include 'include/navadmin.php'; ?>
    <div class="container py-4">
        <h2>Ajouter une société</h2>
        <?php
        require_once 'include/DataBase.php';
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['ajouter'])) {
            $nom_societe = trim($_POST['nom']);
            $id_categorie = intval($_POST['categorie']);

            if ($nom_societe && $id_categorie) {
                $stmt = $pdo->prepare("INSERT INTO societes (nom, categorie) VALUES (?, ?)");
                $stmt->execute([$nom_societe, $id_categorie]);
                echo '<div class="alert alert-success">La société <strong>' . htmlspecialchars($nom_societe) . '</strong> a été ajoutée avec succès !</div>';
            } else {
                echo '<div class="alert alert-danger">Veuillez remplir tous les champs requis.</div>';
            }
        }

        // Charger les catégories
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nom de la société</label>
                <input type="text" name="nom" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Catégorie associée</label>
                <select name="categorie" class="form-select" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter la société</button>
        </form>
    </div>
</body>
</html>
