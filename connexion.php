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

// Fonction de connexion
function loginUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE Nom = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Mot_de_passe'])) {
            return $user['id'];
        }
    }
    return false;
}

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['Nom'];
    $password = $_POST['Mot_de_passe'];
    $user_id = loginUser($username, $password);

    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        header("Location: accueil.php"); // Rediriger vers la page des articles après la connexion
        exit;
    } else {
        echo "<p>Identifiants incorrects.</p>";
    }
}



// Connexion à la base de données (même code que dans inscription.php)

// Récupération des données du formulaire
$username = $_POST['Nom'];
$$password = $_POST['Mot_de_passe'];

// Vérification dans la table users
$sql = 'SELECT * FROM users WHERE Nom = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$nom]);
$utilisateur = $stmt->fetch();

if ($utilisateur && password_verify($motDePasse, $utilisateur['Mot_de_passe'])) {
    // Authentification réussie, redirigez vers la page d'accueil
    header('Location: accueil.php');
    exit;
} else {
    echo 'Nom d\'utilisateur ou mot de passe incorrect.';
}




?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('path/to/your/background-image.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin-top: 20px;
            color: #333;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Nom d'utilisateur:</label><br>
            <input type="text" id="username" name="Nom" required><br>
            <label for="password">Mot de passe:</label><br>
            <input type="password" id="password" name="Mot_de_passe" required><br>
            <button type="submit" name="login">Se connecter</button>
        </form>
        <p>Pas de compte ? <a href="inscription.php">S'inscrire ici</a></p>
    </div>
</body>
</html>