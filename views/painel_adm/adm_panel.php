<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/autenticação/session.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="copyright" content>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>LOC - GAME</title>
    <link rel="stylesheet" href="css/painel.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="js">

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <header class="header shop">
        <div class="container">
            <ul class="nav main-menu menu navbar-nav">
                <li class="active"><a href="adm_panel">Home</a></li>
                <li><a href="usuarios.php">Operadores</a></li>
                <li><a href="cad_jogos.php">Jogos</a></li>
                <li><a href="#">Conta</a></li>
                <li><a href="logout.php" class="fas fa-sign-out-alt"></a></li>
            </ul>
        </div>
    </header>



    <div class="hero">

        <h1> PEDIDOS </h1>
        <?php
        echo '
<table class="table table-sm mt-3">
    <thead class="thead-light">
        <tr>
            <th scope="col"></th>
            <th scope="col">Nome do Jogo</th>
            <th scope="col">Usuário</th>
            <th scope="col">Data de Locação</th>
            <th scope="col">Data de Entrega</th>
            <th scope="col">Status</th> 
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>';

        // Recupera as informações de locação
        try {
            $stmt = $pdo->prepare("SELECT l.id, j.nome AS nome_jogo, j.dados AS dados, u.usuario AS usuario, l.date_locacao, l.prazo, l.status 
                           FROM locacao l 
                           INNER JOIN jogos j ON l.id_jogo = j.id 
                           INNER JOIN usuario u ON l.id_user = u.id");

            $stmt->execute();
            $locacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);


            foreach ($locacoes as $locacao) {

                $id = $locacao['id'];
                // Formata as datas de locação e prazo para o formato "d-m-Y H:i:s"
                $date_locacao_formatada = date("d-m-Y", strtotime($locacao['date_locacao'])) . "<br>" . date("H:i:s", strtotime($locacao['date_locacao']));
                $prazo_formatado = date("d-m-Y", strtotime($locacao['prazo'])) . "<br>" . date("H:i:s", strtotime($locacao['prazo']));

                echo '
            <tr>
                <td><img src="data:image/jpeg;base64,' . base64_encode($locacao['dados']) . '" style="max-width: 100px; height: auto;" alt="Imagem do Jogo"></td>
                <td>' . $locacao['nome_jogo'] . '</td>
                <td>' . $locacao['usuario'] . '</td>
                <td>' . $date_locacao_formatada . '</td>
                <td>' . $prazo_formatado . '</td>
                <td>' . $locacao['status'] . '</td>
                <td>
                    <a href="/we/views/painel_user/jogos_alugados.php?funcao=excluir&id=' . $id . '"><i class="far fa-trash-alt text-danger"></i></a>

                </td>
            </tr>';
            }

        } catch (PDOException $e) {
            // Se ocorrer algum erro durante a execução da consulta, exibe uma mensagem de erro
            echo "Erro ao recuperar informações de locação: " . $e->getMessage();
        }

        echo '
    </tbody>
</table>';



        ?>
    </div>
    <script src="js/card.js"></script>

</body>

</html>