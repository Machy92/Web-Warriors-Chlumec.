<?php if (isset($_SESSION["message"])): ?>
    <div class="alert <?= $_SESSION["message_type"]; ?>">
        <?= $_SESSION["message"]; ?>
    </div>
    <?php unset($_SESSION["message"]); // Vymaže zprávu po zobrazení ?>
<?php endif; ?>


<header class="header">
    <div class="logo">
        <a href="index.php">
            <img src="chlumeclogo.png" alt="Warriors Logo">
        </a>
    </div>
    <nav class="menu-container">
        <ul class="menu">
            <li><a href="soupisky.php">Soupiska</a></li>
            <li><a href="zapasy.php">Zápasy</a></li>
            <li><a href="aktuality.php">Aktuality</a></li>
            <li><a href="multimedia.php">Multimédia</a></li>
            <li><a href="klubova-historie.php">Klub</a></li>

            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="logout.php">Odhlásit</a></li>
            <?php else: ?>
                <li><a href="login.php">Přihlášení</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="menu-toggle" onclick="toggleMenu()">&#9776;</div>
</header>

<style>

.alert {
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    padding: 15px 20px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    z-index: 9999;
    animation: fadeOut 5s forwards;
}

.alert.success {
    background-color: #4CAF50;
    color: white;
}

.alert.error {
    background-color: #f44336;
    color: white;
}

@keyframes fadeOut {
    0% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; display: none; }
}

/* Resetování základního stylu */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

/* Hlavní styl headeru */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background: linear-gradient(90deg, #d32f2f, #ff6e6e);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    color: white;
}

/* Logo */
.logo img {
    max-width: 130px;
    height: auto;
}

/* Menu */
.menu-container {
    display: flex;
    flex-grow: 1;
    justify-content: flex-end;
}

.menu {
    list-style: none;
    display: flex;
    gap: 25px;
    margin: 0;
    padding: 0;
}

.menu li a {
    text-decoration: none;
    color: white;
    font-weight: 500;
    font-size: 16px;
    padding: 8px 15px;
    border-radius: 20px;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.menu li a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: scale(1.1);
}

/* Mobile menu toggle */
.menu-toggle {
    display: none;
    font-size: 24px;
    cursor: pointer;
    color: white;
}

/* Responsivita */
@media (max-width: 768px) {
    .menu-container {
        display: none;
        flex-direction: column;
        gap: 10px;
        background-color: rgba(211, 47, 47, 0.9);
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        padding: 10px 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .menu-container.active {
        display: flex;
    }

    .menu {
        flex-direction: column;
        gap: 10px;
    }

    .menu li a {
        text-align: center;
    }

    .menu-toggle {
        display: block;
    }
}
</style>

<script>
function toggleMenu() {
    const menuContainer = document.querySelector('.menu-container');
    menuContainer.classList.toggle('active');
}
</script>