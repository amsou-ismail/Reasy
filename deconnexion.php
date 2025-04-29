<?php
// Démarrer ou reprendre une session existante
session_start();

// Détruire toutes les données de session
session_unset();
session_destroy();

// Rediriger l'utilisateur vers la page de connexion
header('Location: index.php');
exit();
?>
