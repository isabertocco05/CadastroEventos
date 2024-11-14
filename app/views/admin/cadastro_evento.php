<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Eventos</title>
    <link rel="stylesheet" href="/CADASTROEVENTOS/public/style/cadastro_evento.css">
</head>

<body>
    <div class="container">
        <div class="options">
            <button id="criarEvento" class="ativar" onclick="showCriarEvento()">Criar Evento</button>
            <button id="gerenciarEvento" onclick="showGerenciarEvento()">Gerenciar Evento</button>
        </div>

        <!-- Formulário para criar evento -->
        <div id="eventoForm">
            <h2>Criar Evento</h2>
            <form action="evento_action.php" method="POST">
                <input type="hidden" name="id" id="eventoId">
                
                <label for="nomeEvento">Nome</label>
                <input type="text" name="nomeEvento" id="nomeEvento" required>
                
                <label for="dataEvento">Data</label>
                <input type="date" name="dataEvento" id="dataEvento" required>
                
                <label for="localEvento">Local</label>
                <input type="text" name="localEvento" id="localEvento" required>
                
                <label for="limiteInscricoes">Limite de Inscrições</label>
                <input type="number" name="limiteInscricoes" id="limiteInscricoes" required min="1">

                <button type="submit">Salvar</button>
            </form>
        </div>

        <!-- Gerenciamento (sem conteúdo no momento) -->
        <div id="gerenciarForm" style="display: none;">
            <h2>Gerenciar Evento</h2>
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
