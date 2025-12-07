<?php 
include('protect.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /protect.php'); // 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anuidade</title>
</head>
<body>
    <h1>Bem-vindo ao Painel, <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'); ?>.</h1>
    
    <p>
        <a href="logout.php">Sair</a>
    </p>
</body>
</html>
