<?php
include('../config/Conexao.php');

$sql = "SELECT * FROM eventos";
$result = $conn->query($sql);
$eventos = [];
while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Eventos</title>
    <link rel="stylesheet" href="/CADASTROEVENTOS/public/style/gerenciar_evento.css">
</head>
<body>
    <div class="container">
        <div class="options">
            <button id="criarEvento" onclick="showCriarEvento()">Criar Evento</button>
            <button id="gerenciarEvento" class="ativar" onclick="showGerenciarEvento()">Gerenciar Evento</button>
        </div>

        <!-- Gerenciamento de eventos -->
        <div id="gerenciarForm">
            <h2>Gerenciar Evento</h2>

            <!-- Tabela para exibir os eventos cadastrados -->
            <table id="eventosTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Limite de Inscrições</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td><?php echo $evento['nome']; ?></td>
                            <td><?php echo $evento['data']; ?></td>
                            <td><?php echo $evento['local']; ?></td>
                            <td><?php echo $evento['limite_inscricoes']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function showCriarEvento() {
            window.location.href = 'cadastro_evento.php';
        }

        function showGerenciarEvento() {
            document.getElementById('gerenciarForm').style.display = 'block';
            document.getElementById('criarEvento').classList.remove('ativar');
            document.getElementById('gerenciarEvento').classList.add('ativar');
        }
    </script>
</body>
</html>
