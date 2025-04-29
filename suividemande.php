<?php
// Démarrer la session pour récupérer les informations de l'utilisateur connecté
session_start();

// Vérifier si l'utilisateur est connecté, sinon rediriger
if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données
require_once 'include/DataBase.php';

// Variables des produits demandés
$client_id = $_SESSION['id']; // ID du client connecté
$produit_id = $_POST['produit_id']; // ID du produit demandé
$quantite = $_POST['quantite']; // Quantité demandée

// Insertion d'une demande
$sql = "INSERT INTO demandes (id_clien, id_produit, prix) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$client_id, $produit_id, $prix]);
