<?php
session_start();
include('../config/conexao.php');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /');
    exit();
}

// Recupera todos os eventos disponíveis do banco de dados
$sql = "SELECT * FROM eventos WHERE inscricoes < limite_inscricoes";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o formulário de inscrição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['evento_id'])) {
    $evento_id = $_POST['evento_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Insere o usuário na tabela de inscrições (precisamos criar essa tabela)
    $sql = "INSERT INTO inscricoes (evento_id, usuario_id) VALUES (:evento_id, :usuario_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':evento_id', $evento_id);
    $stmt->bindParam(':usuario_id', $usuario_id);

    if ($stmt->execute()) {
        // Atualiza o número de inscrições no evento
        $sql = "UPDATE eventos SET inscricoes = inscricoes + 1 WHERE id = :evento_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':evento_id', $evento_id);
        $stmt->execute();

        echo "<script>alert('Você se inscreveu com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao se inscrever no evento.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Disponíveis</title>
    <link rel="stylesheet" href="../public/style/style.css">
</head>
<body>
    <div class="container">
        <h2>Eventos Disponíveis</h2>
        
        <!-- Tabela de eventos -->
        <table border="1">
            <thead>
                <tr>
                    <th>Nome do Evento</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th>Inscrições</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventos as $evento): ?>
                <tr>
                    <td><?php echo htmlspecialchars($evento['nome']); ?></td>
                    <td><?php echo htmlspecialchars($evento['descricao']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($evento['data_evento'])); ?></td>
        
