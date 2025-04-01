<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ověření, zda uživatel existuje
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user['id'];
        $_SESSION["user_email"] = $user['email'];

        // Flash zpráva o úspěšném přihlášení
        $_SESSION["message"] = "✅ Úspěšně jste se přihlásili!";
        $_SESSION["message_type"] = "success";

        header("Location: index.php");
        exit;
    } else {
        $_SESSION["message"] = "❌ Neplatné přihlašovací údaje.";
        $_SESSION["message_type"] = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
body {
    background: #dfdfdf;
}
.container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 90vh;
}
.box {
    background: #fdfdfd;
    display: flex;
    flex-direction: column;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
}
.form-box {
    width: 450px;
    margin: 10px;
}
.form-box header {
    font-size: 25px;
    font-weight: 600;
    padding-bottom: 10px;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 10px;
}
.form-box form .field {
    display: flex;
    margin-bottom: 10px;
    flex-direction: column;
}
.form-box form .input input {
    height: 40px;
    width: 100%;
    font-size: 16px;
    padding: 0 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}
.btn {
    height: 35px;
    background: #333;
    border: 0;
    border-radius: 5px;
    color: #fff;
    font-size: 15px;
    cursor: pointer;
    transition: all .3s;
    margin-top: 10px;
    padding: 10px;
}
.btn:hover {
    opacity: 0.82;
}
.submit {
    width: 100%;
}
.links {
    margin-bottom: 15px;
}
.message {
    text-align: center;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 10px;
    font-weight: bold;
}
.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}
.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
<body>
<nav><?php include 'header.php'; ?></nav>

<div class="container">
    <div class="box form-box">
        <header>Přihlášení</header>

        <?php if (isset($_SESSION["message"])): ?>
            <p class="message <?= $_SESSION["message_type"] ?>">
                <?= $_SESSION["message"] ?>
            </p>
            <?php unset($_SESSION["message"]); // Vymaže zprávu po zobrazení ?>
        <?php endif; ?>

        <form action="" method="post">
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>

            <div class="field input">
                <label for="password">Heslo</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn submit">Přihlásit se</button>
        </form>
    </div>
</div>

</body>
<?php include 'footer.php'; ?>
</html>
