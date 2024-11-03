<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Classement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    require 'config.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header('Location: ' . ($user['role'] === 'admin' ? 'index.php' : 'index.php'));
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    }
    ?>

    <main class="main-login">
        <img src="src\img\logo.svg" alt="">
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <p>Pas de compte ? <a href="register.php">Créer un compte</a></p>
    </main>

</body>
</html>