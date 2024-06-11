<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fonction pour récupérer les articles
function getArticles($search = '') {
    global $conn;
    $sql = "SELECT id, title, image, date FROM articles";
    if (!empty($search)) {
        $search = "%" . $conn->real_escape_string($search) . "%";
        $sql .= " WHERE title LIKE '$search' OR image LIKE '$search'";
    }
    $sql .= " ORDER BY date DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Traitement de la recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';
$articles = getArticles($search);

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil - Mon Blog</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(./images/about-bg.jpg);
            
            background-repeat: no-repeat;
        }
        nav {
            background-color: #333;
            color: white;
            padding: 30px;
            text-align: center;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        .search-bar {
            text-align: center;
            margin: 20px 0;
            color: red;
        }
        .search-bar input[type="text"] {
            width: 50%;
            padding: 10px;
            font-size: 16px;

        }
        .articles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .article {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            width: 30%;
            box-sizing: border-box;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .article:hover {
            background-color: #f4f4f4;
        }
        .article h2 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .article p {
            margin: 0;
            color: #555;
        }
        nav button a {
            color: red;
        }
        
    </style>
    <script>
        function viewArticle(id) {
            window.location.href = 'creer_articles.php?id=' + id;
        }
    </script>
</head>
<body>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="articles.php">Articles</a>
        <a href="creer_articles.php">Créer articles</a>
        <button><a href="deconnecter.php" >se deconnecter</a></button>   
    </nav>
    <div class="container">
        <div class="search-bar">
            <form method="get" action="accueil.php">
                <input type="text" name="search" placeholder="Rechercher un article..." value="<?php echo htmlspecialchars($search); ?>">
                <input type="submit" value="Rechercher">
            </form>
        </div>
        <div class="articles">
            <?php if (count($articles) > 0): ?>
                <?php foreach($articles as $article): ?>
                    <div class="article" onclick="viewArticle(<?php echo $article['id']; ?>)">
                        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                        <p><?php echo htmlspecialchars(substr($article['image'], 0, 100)) . '...'; ?></p>
                        <small><?php echo htmlspecialchars($article['date']); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun article trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>