<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 classement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = 'user'; // Par défaut, les nouveaux utilisateurs ont le rôle 'user'

        // Vérifier si l'utilisateur existe déjà
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            echo "Ce nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
        } else {
            // Hacher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insérer l'utilisateur dans la base de données
            $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :password, :email, :role)");
            $stmt->execute([
                'username' => $username,
                'password' => $hashedPassword,
                'email' => $email,
                'role' => $role
            ]);

            // Rediriger vers la page de connexion après l'inscription
            header('Location: login.php');
            exit;
        }
    }
    ?>
    <main class="main-register">

        <img src="src\img\logo.svg" alt="">
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Créer un compte</button>
        </form>

        <p>Déjà un compte ? <a href="login.php">Connecte-toi</a></p>
    </main>

</body>
</html>