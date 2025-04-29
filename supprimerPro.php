<?php
require_once 'include/DataBase.php';
$id = $_GET['id'];

// Vérifier que l'ID est un entier pour éviter les injections
$id = intval($id);

$sqlstate = $pdo->prepare('DELETE FROM produit WHERE id = ?');
$supp = $sqlstate->execute([$id]);

header('Location: listePro.php');
exit;