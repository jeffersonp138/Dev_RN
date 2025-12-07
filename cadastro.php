<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $mysqli->real_escape_string(trim($_POST['nome']));
    $email = $mysqli->real_escape_string(trim($_POST['email']));
    $cpf = $mysqli->real_escape_string(trim($_POST['cpf']));

    if (strlen($nome) == 0) {
        echo 'Preencha seu nome';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Preencha um e-mail válido';
    } else if (strlen($cpf) == 0) {
        echo 'Preencha seu cpf';
    } else {
        // Verificar se o e-mail já está cadastrado
        $stmt = $mysqli->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo 'E-mail já cadastrado, tente um email diferente!';
        } else {
            // Inserir novo usuário
            //$senha_cripto = password_hash($senha, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $mysqli->prepare("INSERT INTO usuarios (nome, email, cpf) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssss", $nome, $email, $cpf);
                if ($stmt->execute()) {
                    echo 'Cadastrado com sucesso!';
                } else {
                    echo 'Falha ao cadastrar: ' . $stmt->error;
                }
                $stmt->close();
            } else {
                echo 'Falha na preparação da query: ' . $mysqli->error;
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="cadastro">
        <h1>Cadastre-se no nosso site</h1>
        <input type="text" name="nome" placeholder="Seu nome completo">
        <input type="text" name="email" id="email" placeholder="Seu e-mail">
        <input type="text" name="cpf" id="cpf" placeholder="Digite o seu CPF">
        <input type="submit" value="Cadastre-se!">
        <a href="index.php"><strong>VOLTAR!</strong></a>
    </form>
</body>
</html>
