<?php

$host = 'localhost'; 
$db = 'cadastro_eventos'; 
$user = 'root'; 
$pass = 'Ma020204*'; 


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $nomeEvento = $_POST['nomeEvento'];
    $dataEvento = $_POST['dataEvento'];
    $localEvento = $_POST['localEvento'];
    $limiteInscricoes = $_POST['limiteInscricoes'];

    $sql = "INSERT INTO eventos (nome, data, local, limite_inscricoes) 
            VALUES ('$nomeEvento', '$dataEvento', '$localEvento', '$limiteInscricoes')";
    if ($conn->query($sql) === TRUE) {
        $mensagem = "Evento criado com sucesso!";
    } else {
        $mensagem = "Erro: " . $conn->error;
    }
}
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
    <title>Cadastro de Eventos</title>
    <link rel="stylesheet" href="/CADASTROEVENTOS/public/style/gerenciar_evento.css">
</head>
<body>
    <div class="container">
        <div class="options">
            <button id="criarEvento" class="ativar" onclick="showCriarEvento()">Criar Evento</button>
            <button id="gerenciarEvento" onclick="showGerenciarEvento()">Gerenciar Evento</button>
        </div>

        <div id="eventoForm">
            <h2>Criar Evento</h2>
            <form action="cadastro_evento.php" method="POST">
                <input type="hidden" name="id" id="eventoId">
                
                <label for="nomeEvento">Nome</label>
                <input type="text" name="nomeEvento" id="nomeEvento" required>
                
                <label for="dataEvento">Data</label>
                <input type="date" name="dataEvento" id="dataEvento" required>
                
                <label for="localEvento">Local</label>
                <input type="text" name="localEvento" id="localEvento" required>
                
                <label for="limiteInscricoes">Limite de Inscrições</label>
                <input type="number" name="limiteInscricoes" id="limiteInscricoes" required>

                <button type="submit">Salvar</button>
            </form>

            <?php if ($mensagem != ""): ?>
                <div class="mensagem"><?php echo $mensagem; ?></div>
            <?php endif; ?>
        </div>

        <div id="gerenciarForm" style="display: none;">
            <h2>Gerenciar Evento</h2>

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
            document.getElementById('eventoForm').style.display = 'block';
            document.getElementById('gerenciarForm').style.display = 'none';
            document.getElementById('criarEvento').classList.add('ativar');
            document.getElementById('gerenciarEvento').classList.remove('ativar');
        }

        function showGerenciarEvento() {
            document.getElementById('eventoForm').style.display = 'none';
            document.getElementById('gerenciarForm').style.display = 'block';
            document.getElementById('gerenciarEvento').classList.add('ativar');
            document.getElementById('criarEvento').classList.remove('ativar');
        }
    </script>
</body>
</html>