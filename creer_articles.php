
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
    if (mysqli_query($conn, $delete_query)) {
        echo "Article supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'article: " . mysqli_error($conn);
    }
}

// Ajouter un article
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];
    $image_path = null;

    // Gérer le téléchargement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . basename($image_name);
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            // Image téléchargée avec succès
        } else {
            $image_path = null;
            echo "Erreur lors du téléchargement de l'image.";
        }
    }

    

    // Préparer et exécuter la requête d'insertion
    $insert_query = $conn->prepare("INSERT INTO articles (title, texte, image, user_id) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("sssi", $title, $content, $image_path, $user_id);

    if ($insert_query->execute()) {
        echo "Article ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'article: " . $insert_query->error;
    }

    $insert_query->close();
}

$date = date('Y-m-d H:i:s'); // Date actuelle

    $stmt = $conn->prepare("INSERT INTO articles (title, texte, user_id, image, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $title, $content, $user_id, $image_path, $date);

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
    <link rel="stylesheet" href="./images/home-bg.jpg" >
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url(./images/home-bg.jpg);
background-size: 100%;
background-repeat: no-repeat;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            margin-bottom: 16px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #66afe9;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }


</style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un article</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Contenu :</label>
            <textarea id="content" name="content" rows="4" cols="50" required></textarea>
            
            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <input type="submit" value="Ajouter l'article">
        </form>
    </div>

    <h2>Articles</h2>
    <?php if ($result->num_rows > 0): ?>
        <?php while($article = $result->fetch_assoc()): ?>
            <div class="article">
                <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                <p>Par: <?php echo htmlspecialchars($article['auteur']); ?></p>
                <p><?php echo htmlspecialchars($article['date']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($article['texte'])); ?></p>
                <?php if ($article['image']): ?>
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Image" style="max-width: 300px;">
                <?php endif; ?>
                <a href="creer_articles.php?delete_id=<?php echo $article['id']; ?>"><button>Supprimer</button></a>
                <hr>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
</body>
</html>