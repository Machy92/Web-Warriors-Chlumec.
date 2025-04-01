<?php
session_start();
require 'db.php';

$stmt = $conn->query("SELECT a.id, a.title, a.content, u.email AS author, a.created_at 
                      FROM articles a 
                      JOIN users u ON a.author_id = u.id 
                      ORDER BY a.created_at DESC");

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Aktuality</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="chlumeclogo.png">

</head>
<body class="bg-light">

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Aktuality</h2>

    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="pridat-aktualitu.php" class="btn btn-primary mb-3">➕ Přidat článek</a>
    <?php endif; ?>

    <?php foreach ($articles as $article): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($article["title"]) ?></h3>
                <p class="card-text"><?= nl2br(htmlspecialchars($article["content"])) ?></p>
                <p class="text-muted">Autor: <?= htmlspecialchars($article["author"]) ?> | <?= $article["created_at"] ?></p>
                
                <?php if (isset($_SESSION["user_id"])): ?>
                    <a href="editovat-aktualitu.php?id=<?= $article['id'] ?>" class="btn btn-warning">✏️ Editovat</a>
                    <a href="smazat-aktualitu.php?id=<?= $article['id'] ?>" class="btn btn-danger">🗑️ Smazat</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
