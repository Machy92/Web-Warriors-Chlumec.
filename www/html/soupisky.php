<?php
session_start();

$host = "postgres";
$dbname = "warriorschlumec";
$user = "postgres";
$password = "qwerty";

try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_hraci = "SELECT id, jmeno, pozice, cislo_dresu, datum_narozeni, 
                         EXTRACT(YEAR FROM AGE(NOW(), datum_narozeni)) AS vek
                  FROM hraci
                  ORDER BY pozice, cislo_dresu";
    $stmt_hraci = $conn->prepare($sql_hraci);
    $stmt_hraci->execute();
    $hraci = $stmt_hraci->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Chyba připojení: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soupiska - Warriors Chlumec</title>
    <link rel="icon" type="image/x-icon" href="chlumeclogo.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vlastní styl -->
    <style>
        body {
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding-top: 50px;
        }
        .team-header {
            font-size: 24px;
            font-weight: bold;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }
        .player-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background-color: white;
            transition: 0.3s;
        }
        .player-card:hover {
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }
        .player-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .player-name {
            font-size: 18px;
            font-weight: bold;
            color: #222;
        }
        .player-info {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <nav>
        <?php include 'header.php'; ?>
    </nav>

    <div class="container">
        <h1 class="text-center">Soupiska týmu Warriors Chlumec</h1>

        <?php if (!empty($hraci)): ?>
            <?php 
                $pozice = ["Brankář" => "Brankáři", "Obránce" => "Obránci", "Útočník" => "Útočníci"];
                foreach ($pozice as $pozice_db => $pozice_nazev): 
            ?>
                <div class="team-header"> <?= $pozice_nazev ?> </div>
                <div class="row g-3">
                    <?php foreach ($hraci as $hrac): ?>
                        <?php if ($hrac['pozice'] === $pozice_db): ?>
                            <div class="col-md-6">
                                <div class="player-card" onclick="window.location.href='profil_hrace.php?id=<?= $hrac['id'] ?>'">
                                    <img src="images/<?= htmlspecialchars($hrac['fotka'] ?? 'default.png') ?>" alt="<?= htmlspecialchars($hrac['jmeno']) ?>">
                                    <div class="player-name"> <?= htmlspecialchars($hrac['jmeno']) ?> </div>
                                    <div class="player-info"> Číslo: <?= htmlspecialchars($hrac['cislo_dresu']) ?> | Věk: <?= $hrac['vek'] ?> </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning text-center">Žádní hráči nenalezeni</div>
        <?php endif; ?>
    </div>

    <footer class="mt-5">
        <?php include 'footer.php'; ?>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
