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

// Valider les entrées utilisateur et traiter l'inscription
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['Nom'];
    $email = $_POST['Email'];
    $password = $_POST['Mot_de_passe'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!isEmailExists($email, $conn)) {
                if (!isPasswordExists($password, $conn)) {
                    // Enregistrer l'utilisateur dans la base de données
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users (Nom, Email, Mot_de_passe) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $username, $email, $hashed_password);
                    if ($stmt->execute()) {
                        echo "<p>Inscription réussie !</p>";
                        header("Location: accueil.php"); // Rediriger vers la page d'accueil
                    } else {
                        echo "<p>Une erreur est survenue lors de l'inscription.</p>";
                    }
                    $stmt->close();
                } else {
                    echo "<p>Le mot de passe est déjà utilisé par un autre utilisateur.</p>";
                }
            } else {
                echo "<p>L'adresse email est déjà utilisée par un autre utilisateur.</p>";
            }
        } else {
            echo "<p>Adresse email invalide.</p>";
        }
    } else {
        echo "<p>Veuillez remplir tous les champs.</p>";
    }
}

// Fonction pour vérifier si une adresse e-mail existe déjà dans la base de données
function isEmailExists($email, $conn) {
    $query = "SELECT * FROM users WHERE Email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();
    return $num_rows > 0;
}

// Fonction pour vérifier si un mot de passe existe déjà dans la base de données
function isPasswordExists($password, $conn) {
    $query = "SELECT * FROM users WHERE Mot_de_passe = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $password);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();
    return $num_rows > 0;
}



$conn->close();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
            color: #333;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
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
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,


input[type="password"]:focus {
            border-color: #66afe9;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
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
            transition: background-color 0.3s;
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
        <h2>Inscription</h2>
        <form method="POST">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="Nom" required><br>
            <label for="email">Adresse email:</label>
            <input type="email" id="email" name="Email" required><br>
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="Mot_de_passe" required><br>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>