<?php
session_start();
$host = "postgres";
$dbname = "warriorschlumec";
$user = "postgres";
$password = "qwerty";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        die("Neplatné ID hráče.");
    }

    $id = $_GET['id'];

    $sql_hrac = "SELECT * FROM hraci WHERE id = :id";
    $stmt_hrac = $conn->prepare($sql_hrac);
    $stmt_hrac->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_hrac->execute();
    $hrac = $stmt_hrac->fetch(PDO::FETCH_ASSOC);

    if (!$hrac) {
        die("Hráč nenalezen.");
    }

    $je_brankar = ($hrac['pozice'] == 'Brankář');

} catch (PDOException $e) {
    echo "Chyba připojení: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($hrac['jmeno']) ?> - Profil hráče</title>
    <link rel="icon" type="image/x-icon" href="chlumeclogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            padding-top: 80px; /* Odsazení od horního okraje */
        }
        .container {
            padding-top: 20px; /* Odsazení obsahu od headeru */
        }
        .player-profile {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .player-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .player-name {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .player-info {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }
        .back-btn {
            margin-top: 20px;
            background-color: #000;
            color: #fff;
            border-color: #000;
        }
        .stat-table {
            width: 80%;
            margin: 20px auto;
        }
        .stat-table th, .stat-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <nav>
        <?php include 'header.php'; ?>
    </nav>

    <div class="container">
        <div class="player-profile">
            <img src="images/<?= htmlspecialchars($hrac['fotka'] ?? 'default.png') ?>" alt="<?= htmlspecialchars($hrac['jmeno']) ?>" class="player-img">
            <div class="player-name"><?= htmlspecialchars($hrac['jmeno']) ?></div>
            <div class="player-info"><strong>Pozice:</strong> <?= htmlspecialchars($hrac['pozice']) ?></div>
            <div class="player-info"><strong>Číslo dresu:</strong> <?= htmlspecialchars($hrac['cislo_dresu']) ?></div>
            <div class="player-info"><strong>Věk:</strong> <?= htmlspecialchars($hrac['vek']) ?></div>

            <table class="stat-table">
                <?php if ($je_brankar): ?>
                    <tr><th>Úspěšnost zákroku</th><td><?= htmlspecialchars($hrac['uspesnost_zakroku']) ?>%</td></tr>
                    <tr><th>Obdržené góly</th><td><?= htmlspecialchars($hrac['obdrzene_goly']) ?></td></tr>
                <?php else: ?>
                    <tr><th>Góly</th><td><?= htmlspecialchars($hrac['goly']) ?></td></tr>
                    <tr><th>Asistence</th><td><?= htmlspecialchars($hrac['asistence']) ?></td></tr>
                    <tr><th>Trestné minuty</th><td><?= htmlspecialchars($hrac['trestne_minuty']) ?></td></tr>
                <?php endif; ?>
            </table>

            <a href="soupisky.php" class="btn back-btn">Zpět na soupisku</a>
        </div>
    </div>

    <footer class="mt-5">
        <?php include 'footer.php'; ?>
    </footer

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>