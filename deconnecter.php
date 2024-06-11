<?php
// deconnexion.php : Page de déconnexion des utilisateurs
session_start();  // Démarrer la session
session_destroy();  // Détruire toutes les données de la session
header("Location: index.php");  // Rediriger vers la page de connexion
exit();
?>