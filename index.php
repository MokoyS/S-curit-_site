<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 classement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header-index">
        <?php
        session_start();
        require 'config.php';

        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']['username'];
            $role = $_SESSION['user']['role'];

            echo "<p>Bienvenue, $username ! Votre rôle : $role</p>";
            echo '<a href="logout.php">Se déconnecter</a>';
        } else {
            echo "<p>Vous n'êtes pas connecté. <a href='login.php'>Connexion</a></p>";
        }
        ?>
    </header>
    <main class="main-index">
        <div class="f1-todo-container">
            <?php if (isset($role) && $role === 'admin'): ?>
                <button class="f1-button" id="openModalButton">Ajouter Pilote</button>

            <?php endif; ?>
            <ul id="pilotList" class="f1-pilot-list"></ul>
        </div>

        <div id="pilotModal" class="f1-modal">
            <div class="f1-modal-content">
                <span class="f1-close" id="closeModalButton">&times;</span>
                <h2>Ajouter un Pilote</h2>
                <form id="pilotForm" class="f1-todo-form">
                    <input type="text" id="firstName" class="f1-input" placeholder="Prénom" required>
                    <input type="text" id="lastName" class="f1-input" placeholder="Nom" required>
                    <input type="text" id="team" class="f1-input" placeholder="Écurie" required>
                    <input type="number" id="points" class="f1-input" placeholder="Points" required>
                    <button type="submit" class="f1-button">Ajouter Pilote</button>
                </form>
            </div>
        </div>
    </main>
    <script src="src/js/index.js"></script>
</body>
</html>
