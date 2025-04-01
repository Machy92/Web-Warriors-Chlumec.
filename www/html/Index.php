<?php
session_start();
require 'db.php';

// Načtení nejlepších hráčů a brankářů
$sql_best_players = "SELECT id, jmeno, goly FROM hraci WHERE goly IS NOT NULL ORDER BY goly DESC LIMIT 5";
$sql_best_goalies = "SELECT id, jmeno, uspesnost_zakroku FROM hraci WHERE pozice = 'Brankář' ORDER BY uspesnost_zakroku DESC LIMIT 5";

$stmt_players = $conn->prepare($sql_best_players);
$stmt_players->execute();
$best_players = $stmt_players->fetchAll(PDO::FETCH_ASSOC);
$stmt_goalies = $conn->prepare($sql_best_goalies);
$stmt_goalies->execute();
$best_goalies = $stmt_goalies->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warriors Chlumec</title>
    <link rel="icon" type="image/x-icon" href="chlumeclogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">

 <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }
        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 5px;
            width: 600px;
            text-align: center;
            left: 50%;
            transform: translateX(-50%);
        }

        body {
            font-family: 'Roboto Condensed', sans-serif;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animate {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
        .section-title:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
   <script>
        document.addEventListener("DOMContentLoaded", function() {
            const titles = document.querySelectorAll(".section-title");
            function checkScroll() {
                titles.forEach(title => {
                    const rect = title.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 100) {
                        title.classList.add("animate");
                    }
                });
            }
            window.addEventListener("scroll", checkScroll);
            checkScroll();
        });
    </script>
</head>
<body>

  <?php if (isset($_GET['login']) && $_GET['login'] == 'success'): ?>
        <div style="background: green; color: white; padding: 10px; text-align: center;">
            Úspěšně jste se přihlásili!
        </div>
    <?php endif; ?>

    <nav>
        <?php include 'header.php'; ?>
    </nav>

    <!-- Karusel -->
    <div id="articlesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#articlesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#articlesCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#articlesCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img1.jpg" class="d-block w-100" alt="Popis článku 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Sezóna začíná!</h5>
                    <p>První zápas nové sezóny se blíží. Přijďte podpořit tým Warriors Chlumec!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img2.jpg" class="d-block w-100" alt="Popis článku 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Turnaj mladých nadějí</h5>
                    <p>Warriors si vedli skvěle a přivezli domů pohár!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img3.jpg" class="d-block w-100" alt="Popis článku 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nová posila v týmu</h5>
                    <p>Zkušený hráč posílí naši obranu!</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#articlesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#articlesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <main class="container text-center">
    <h3 class="mt-4 section-title text-uppercase">Nejúspěšnější hráči</h3>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <?php foreach (array_slice($best_players, 0, 3) as $player): ?>
            <div class="card shadow-sm" style="width: 16rem; cursor:pointer;" onclick="window.location.href='profil_hrace.php?id=<?= $player['id'] ?>'">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase fw-semibold" style="font-size: 1.1rem;"> <?= htmlspecialchars($player['jmeno']) ?> </h6>
                    <p class="card-text" style="font-size: 1rem;">Góly: <strong><?= htmlspecialchars($player['goly']) ?></strong></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <h3 class="mt-4 section-title text-uppercase">Nejúspěšnější brankáři</h3>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <?php foreach (array_slice($best_goalies, 0, 3) as $goalie): ?>
            <div class="card shadow-sm" style="width: 16rem; cursor:pointer;" onclick="window.location.href='profil_hrace.php?id=<?= $goalie['id'] ?>'">
                <div class="card-body text-center">
                    <h6 class="card-title text-uppercase fw-semibold" style="font-size: 1.1rem;"> <?= htmlspecialchars($goalie['jmeno']) ?> </h6>
                    <p class="card-text" style="font-size: 1rem;">Úspěšnost zákroků: <strong><?= htmlspecialchars($goalie['uspesnost_zakroku']) ?>%</strong></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>


    <footer>
        <?php include 'footer.php'; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
