<?php 
session_start();

// Connexion à la base de données
require_once '../include/DataBase.php';

// Récupérer l'ID de la catégorie depuis l'URL
$id = $_GET['id'] ?? null;
$societeFiltre = $_GET['societe'] ?? null;

// Si l'utilisateur a cliqué sur "Annuler"
if (isset($_GET['annuler'])) {
    $idProduit = $_GET['annuler'];
    $update = $pdo->prepare('UPDATE produit SET disponibilite = 1 WHERE id = ?');
    $update->execute([$idProduit]);
    header("Location: categorie.php?id=$id");
    exit;
}

// Récupérer la catégorie
$sql_cat = $pdo->prepare('SELECT * FROM categorie WHERE id = ?');
$sql_cat->execute([$id]);
$categorie = $sql_cat->fetch(PDO::FETCH_ASSOC);

// Déterminer l'unité du prix selon la catégorie
$unitePrix = 'MAD';
$nomCategorie = strtolower($categorie['nom'] ?? '');
if (strpos($nomCategorie, 'hotel') !== false) {
    $unitePrix = 'Mad/nuit';
} elseif (strpos($nomCategorie, 'voiture') !== false) {
    $unitePrix = 'Mad/jour';
}

// Requête pour récupérer les sociétés (pour le filtre)
$societeQuery = $pdo->prepare('
    SELECT DISTINCT s.id_societe, s.nom
    FROM societes s
    INNER JOIN produit p ON p.id_soc = s.id_societe
    WHERE p.id_categorie = ?
');
$societeQuery->execute([$id]);
$societes = $societeQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les produits selon le filtre
if ($societeFiltre) {
    $sql = $pdo->prepare('SELECT * FROM produit WHERE id_categorie = ? AND id_soc = ?');
    $sql->execute([$id, $societeFiltre]);
} else {
    $sql = $pdo->prepare('SELECT * FROM produit WHERE id_categorie = ?');
    $sql->execute([$id]);
}
$prods = $sql->fetchAll(PDO::FETCH_OBJ);

$produit_name = $categorie['nom'] ?? 'Catégorie';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reasy | <?php echo htmlspecialchars($produit_name); ?></title>
    <link rel="icon" type="image/png" href="../favicon.ico">

    <!-- Load Bootstrap CSS once -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../include/navuser.php'; ?>
    <div class="container py-4">
        <h2 class="mb-4">Produits de la catégorie : <?php echo htmlspecialchars($produit_name); ?></h2>

        <!-- FILTRE PAR SOCIÉTÉ -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <label for="societe">Filtrer par société :</label>
            <select name="societe" id="societe" class="form-select w-25 d-inline-block">
                <option value="">-- Toutes les sociétés --</option>
                <?php foreach ($societes as $s): ?>
                    <option value="<?php echo $s['id_societe']; ?>" <?php echo ($societeFiltre == $s['id_societe']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($s['nom']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary ms-2">Filtrer</button>
        </form>

        <div class="row">
            <?php if (count($prods) > 0): ?>
                <?php foreach($prods as $produit): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="../upload/<?php echo htmlspecialchars($produit->image); ?>" alt="Image du produit">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($produit->nom); ?></h5>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($produit->description)); ?></p>
                                <?php 
                                    $prixFinal = $produit->prix - ($produit->prix * $produit->discount / 100);
                                ?>
                                <p class="card-text fw-bold"><?php echo number_format($prixFinal, 2) . " " . $unitePrix; ?></p>
                                <?php if ($produit->discount > 0): ?>
                                    <p class="card-text">
                                        <small class="text-muted">Avant : <s><?php echo number_format($produit->prix, 2) . " " . $unitePrix; ?></s></small>
                                        <span class="badge bg-success"><?php echo $produit->discount; ?>% OFF</span>
                                    </p>
                                <?php endif; ?>
                                <p class="card-text">
                                    <?php if ($produit->disponibilite == 0): ?>
                                        <span class="text-danger">Indisponible</span>
                                        <a href="categorie.php?id=<?php echo $id; ?>&annuler=<?php echo $produit->id; ?>" class="btn btn-danger mt-2">Annuler</a>
                                    <?php else: ?>
                                            <form class="reservation-form mt-2" data-produit-id="<?php echo $produit->id; ?>" data-prix-final="<?php echo $prixFinal; ?>">
                                                <input type="hidden" name="reserver" value="<?php echo $produit->id; ?>">
                                                <?php if ($produit_name != "Vols"): ?>
                                                    <label for="nb_reservation_<?php echo $produit->id; ?>">Nombre de jours :</label>
                                                <?php else: ?>
                                                    <label for="nb_reservation_<?php echo $produit->id; ?>">Nombre de tickets :</label>
                                                <?php endif; ?>
                                                    <input type="number" id="nb_reservation_<?php echo $produit->id; ?>" name="nb_reservation" value="1" min="1" class="form-control mb-2" style="width: 100px;">
                                                
                                                <button type="submit" class="btn btn-success">Réserver</button>
                                            </form>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Aucun produit trouvé pour cette société.</p>
            <?php endif; ?>
        </div>

        <!-- Bootstrap Modal for PayPal Payment -->
        <div class="modal fade" id="paypalModal" tabindex="-1" aria-labelledby="paypalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paypalModalLabel">Payer votre réservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Total à payer : <span id="totalPrice">0.00 MAD</span></p>
                        <div id="paypal-button-container"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AZzt7GHZugOAAtW7oeTH1GmhlsperlIfroJRn98eqyLOW44JuN5am9K0F31mSEwqn676uCpP7xlXaxe0&components=buttons"></script>
    <!-- Bootstrap JS (load once) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.querySelectorAll('.reservation-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const produitId = this.dataset.produitId;
            const prixFinal = parseFloat(this.dataset.prixFinal);
            const nbReservation = parseInt(this.querySelector('input[name="nb_reservation"]').value);

            // Validate number of days
            if (nbReservation <= 0) {
                alert('Veuillez entrer un nombre de jours valide.');
                return;
            }

            // Calculate total price in MAD
            const totalPrice = (prixFinal * nbReservation).toFixed(2);

            // Update modal with total price
            document.getElementById('totalPrice').textContent = `${totalPrice} MAD`;

            // Show the modal
            const paypalModal = new bootstrap.Modal(document.getElementById('paypalModal'));
            paypalModal.show();

            // Clear any existing PayPal buttons
            document.getElementById('paypal-button-container').innerHTML = '';

            // Render PayPal buttons
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: totalPrice // Let PayPal default to the buyer's currency (likely USD in Sandbox)
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Payment successful, submit reservation to server
                        const formData = new FormData();
                        formData.append('reserver', produitId);
                        formData.append('nb_reservation', nbReservation);
                        formData.append('prix_total', totalPrice); // Store price in MAD in the database

                        fetch('process_payment.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Paiement et réservation effectués avec succès !');
                                paypalModal.hide();
                                window.location.href = `categorie.php?id=<?php echo $id; ?>`;
                            } else {
                                alert('Erreur lors de la réservation : ' + data.message);
                            }
                        })
                        .catch(error => {
                            alert('Une erreur est survenue : ' + error);
                        });
                    });
                },
                onError: function(err) {
                    console.error('PayPal Error:', err);
                    alert('Une erreur est survenue lors du paiement. Consultez la console pour plus de détails.');
                }
            }).render('#paypal-button-container');
        });
    });
    </script>
    <?php include '../chatbot_component.php'; ?>

</body>
</html>