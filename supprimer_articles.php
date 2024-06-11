<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['users'])) {
    header('Location: connexion.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID de l'article à supprimer
    $id_article = $_POST['id_article'];
    
    // Supprimer l'article dans la base de données en utilisant des requêtes préparées pour éviter les injections SQL
    include 'connexion.php'; // Fichier de connexion à la base de données
    
    $req = $bdd->prepare('DELETE FROM articles WHERE id = ? AND auteur = ?');
    $req->execute(array($id_article, $_SESSION['utilisateur']));
    
    echo "L'article a été supprimé avec succès!";
}
?>
