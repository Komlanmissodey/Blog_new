<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();  // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifier si l'ID de l'article est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $article_id = $_GET['id'];

    // Vérifier si l'utilisateur a le droit de supprimer cet article
    $user_id = $_SESSION['user']['id'];
    $query = "SELECT * FROM articles WHERE id = $article_id AND user_id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        // Vérifier si l'utilisateur a confirmé la suppression
        if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
            // Supprimer l'article de la base de données
            $delete_query = "DELETE FROM articles WHERE id = $article_id";
            mysqli_query($conn, $delete_query);

            // Rediriger vers la page d'accueil avec un message de succès
            header('Location: index.php?success=Article supprimé avec succès');
            exit();
        } else {
            // Afficher une confirmation avant la suppression définitive
            echo 'Êtes-vous sûr de vouloir supprimer cet article ?';
            echo '<a href="supprimer_article.php?id='.$article_id.'&confirm=yes">Oui</a>';
            echo '<a href="index.php">Non</a>';
        }
    } else {
        // Rediriger vers la page d'accueil avec un message d'erreur
        header('Location: index.php?error=Vous n\'avez pas le droit de supprimer cet article');
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si l'ID de l'article n'est pas valide
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de suppression</title>
</head>
<body>
    <h1>Confirmation de suppression</h1>
    <p>Êtes-vous sûr de vouloir supprimer cet article ?</p>
    <a href="supprimer_article.php?id=<?php echo $article_id; ?>&confirm=yes">Oui</a>
    <a href="index.php">Non</a>
</body>
</html>
