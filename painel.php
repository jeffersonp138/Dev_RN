<?php 
include('protect.php');

//Consulta ao DB
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Painel</title>
</head>
<body>
    <h1>Bem-vindo ao Painel, <?php echo htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8'); ?>.</h1>
    
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Status</th>
            </tr>
        </thead>
        
        <tbody>
            <?php if(empty($produtos)): ?>
            <tr>
                <td colspan="5" class="text-center">
                    <div class="alert alert-warning">
                        Nenhum produto encontrado com os filtros aplicados.
                    </div>
                </td>
            </tr>
            <?php else: ?>
                <?php foreach($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td class="fw-bold">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                    <td><?php echo $produto['estoque']; ?></td>
                    <td>
                        <?php if($produto['estoque'] > 0): ?>
                            <span class="badge bg-success">Disponível</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Esgotado</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
         










    <p>
        <a href="logout.php">Sair</a>
    </p>
</body>
</html>
