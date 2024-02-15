<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos id_jogo e id_user estão definidos no POST
    if (isset($_POST["id_jogo"]) && isset($_POST["id_user"])) {
        // Conecta-se ao banco de dados (você já deve ter incluído isso em algum lugar)
        include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

        // Recebe os valores dos campos do formulário
        $id_jogo = $_POST["id_jogo"];
        $id_user = $_POST["id_user"];
        $status = 'PENDENTE';

        // Obtém a data e hora atual
        $data_locacao = date("Y-m-d H:i:s");

        // Calcula o prazo da locação como 3 dias a partir da data atual
        $prazo = date("Y-m-d H:i:s", strtotime("+3 days"));

        // Formata a data inicial para o formato "d-m-Y"
        $data_inicial_formatada = date("d-m-Y", strtotime($data_locacao));
        $prazo_formatado = date("d-m-Y", strtotime($prazo));
        
        try {
            // Prepara a consulta SQL de inserção
            $stmt = $pdo->prepare("INSERT INTO locacao (id_user, id_jogo, date_locacao, prazo, status) VALUES (:id_user, :id_jogo, :data_locacao, :prazo, :status)");

            // Associa os parâmetros da consulta aos valores recebidos do formulário
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":id_jogo", $id_jogo);
            $stmt->bindParam(":data_locacao", $data_locacao);
            $stmt->bindParam(":prazo", $prazo);
            $stmt->bindParam(":status", $status);

            // Executa a consulta
            $stmt->execute();

            // Redireciona o usuário para alguma página de sucesso
            header("Location: /we/views/painel_user/jogos_alugados.php");
            exit();
        } catch (PDOException $e) {
            // Se ocorrer algum erro durante a execução da consulta, exibe uma mensagem de erro
            echo "Erro ao inserir locação: " . $e->getMessage();
        }

    } else {
        // Se os campos id_jogo e id_user não estiverem definidos no POST, exibe uma mensagem de erro
        echo "ID do jogo ou ID do usuário não foram recebidos.";
    }
} else {
    // Se o método de requisição não for POST, exibe uma mensagem de erro
    echo "Método de requisição inválido.";
}
?>