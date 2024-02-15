<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extrai os dados do formulário
    $nome = $_POST['nomePro'];
    $genero = $_POST['gen'];
    $marca = $_POST['marca'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    // Verifica se o arquivo foi enviado sem erros
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        // Conecta ao banco de dados
        $conn = new mysqli('localhost', 'root', '', 'we');

        if ($conn->connect_error) {
            die("Erro na conexão: " . $conn->connect_error);
        }

        // Prepara os dados para inserção no banco de dados
        $file_name = $_FILES["fileToUpload"]["name"];
        $file_type = $_FILES["fileToUpload"]["type"];
        $file_size = $_FILES["fileToUpload"]["size"];
        $file_data = addslashes(file_get_contents($_FILES["fileToUpload"]["tmp_name"]));

        // Inserir os dados no banco de dados
        $sql = "INSERT INTO jogos (nome, tipo, genero, marca, descr, preco,  nomeJog, tipoJog, dados, tamanho) 
        VALUES ('$nome',  '$tipo', '$genero',  '$marca', '$descricao', '$preco',  '$file_name', '$file_type', '$file_data', $file_size)";
        if ($conn->query($sql) === TRUE) {
            echo "Jogo cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar o jogo: " . $conn->error;
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Erro ao fazer o upload da imagem.";
    }
}
?>
