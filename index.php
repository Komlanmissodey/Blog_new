<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url(./images/home-bg.jpg) no-repeat center center fixed;
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
        h1, h2 {
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
        <h1>Bienvenue sur Ebah Groupe blog !</h1>

        <!-- Formulaire de connexion -->
        <h2>Connexion</h2>
        <form action="connexion.php" method="POST">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="Nom" required>
            <label>Mot de passe:</label>
            <input type="password" name="Mot_de_passe" required>
            <button type="submit" name="login">Se connecter</button>
        </form>

        <p>Pas de compte ? <a href="inscription.php">S'inscrire ici</a></p>
    </div>
</body>
</html>