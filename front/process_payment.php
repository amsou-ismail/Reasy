<?php
session_start();
require_once '../include/DataBase.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    // Check if user is logged in
    if (!isset($_SESSION['id_client'])) {
        throw new Exception('Vous devez être connecté pour effectuer une réservation.');
    }

    // Get POST data
    $idProduit = $_POST['reserver'] ?? null;
    $nbReservation = intval($_POST['nb_reservation'] ?? 1);
    $prixTotal = floatval($_POST['prix_total'] ?? 0);

    if (!$idProduit || $nbReservation <= 0 || $prixTotal <= 0) {
        throw new Exception('Données de réservation invalides.');
    }

    // Verify product exists and get price
    $sql_prod = $pdo->prepare('SELECT prix, discount FROM produit WHERE id = ? AND disponibilite = 1');
    $sql_prod->execute([$idProduit]);
    $produit = $sql_prod->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        throw new Exception('Produit non disponible ou introuvable.');
    }

    // Calculate expected price
    $prixFinal = $produit['prix'] - ($produit['prix'] * $produit['discount'] / 100);
    $expectedTotal = $prixFinal * $nbReservation;

    if (abs($prixTotal - $expectedTotal) > 0.01) {
        throw new Exception('Montant du paiement incorrect.');
    }

    // Update product availability
    $update = $pdo->prepare('UPDATE produit SET disponibilite = 0 WHERE id = ?');
    $update->execute([$idProduit]);

    // Insert reservation into demande
    $insertDemande = $pdo->prepare('INSERT INTO demande (id_client, id_produit, prix, nb_reservation) VALUES (?, ?, ?, ?)');
    $insertDemande->execute([$_SESSION['id_client'], $idProduit, $prixTotal, $nbReservation]);

    $response['success'] = true;
    $response['message'] = 'Réservation enregistrée avec succès.';
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
exit;