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
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer et afficher tous les articles
$sql = "SELECT a.id, a.title, a.date, a.image, a.texte, u.Nom AS auteur 
        FROM articles a 
        JOIN users u ON a.user_id = u.id 
        ORDER BY a.date DESC";

// Supprimer l'article si l'ID est passé en paramètre
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $article_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM articles WHERE id = $article_id AND user_id = ".$_SESSION['user_id'];
    if(mysqli_query($conn, $delete_query)) {
        echo "Article supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'article: " . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image_path = null;

    // ... (le reste du code pour l'ajout d'un article)

}

// Récupérer et afficher tous les articles
$sql = "SELECT a.id, a.title, a.date, a.image, a.texte, u.Nom AS auteur 
        FROM articles a 
        JOIN users u ON a.user_id = u.id 
        ORDER BY a.date DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="./images/home-bg.jpg">
</head>
<body class="image">
    <h2></h2>
    <form method="POST" enctype="multipart/form-data">
        <!-- ... (formulaire pour ajouter un article) -->
    </form>

    <h2>Articles</h2>
    <?php if ($result->num_rows > 0): ?>
        <?php while($article = $result->fetch_assoc()): ?>
            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
            <p>Par: <?php echo htmlspecialchars($article['auteur']); ?></p>
            <p><?php echo htmlspecialchars($article['date']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($article['texte'])); ?></p>
            <?php if ($article['image']): ?>
                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Image" style="max-width: 300px;">
            <?php endif; ?>
            <a href="supprimer_article.php?id=<?php echo $article['id']; ?>">Supprimer</a>
            <hr>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
</body>
</html>

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
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Supprimer l'article si l'ID est passé en paramètre
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $article_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM articles WHERE id = $article_id AND user_id = ".$_SESSION['user_id'];
    if(mysqli_query($conn, $delete_query)) {
        echo "<p>Article supprimé avec succès.</p>";
    } else {
        echo "<p>Erreur lors de la suppression de l'article: " . mysqli_error($conn) . "</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image_path = null;

    // Code pour ajouter un article (à compléter)
    // ...

}

// Récupérer et afficher tous les articles
$sql = "SELECT a.id, a.title, a.date, a.image, a.texte, u.Nom AS auteur 
        FROM articles a 
        JOIN users u ON a.user_id = u.id 
        ORDER BY a.date DESC";

$result = $conn->query($sql);

$conn->close();
?>

