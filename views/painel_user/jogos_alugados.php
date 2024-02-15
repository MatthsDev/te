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

    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slicknav/1.0.10/slicknav.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
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
                <li class="active"><a href="user_panel">Home</a></li>
                <li><a href="contato.php">Contato</a></li>
                <li><a href="suporte.php">Suporte</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" id="dropdownConta">
                        <span class="glyphicon glyphicon-user"></span> Conta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownConta">
                        <li><a href="#">Minha Conta</a></li>
                        <li><a href="jogos_alugados.php">Jogos Alugados</a></li>
                        <li><a href="#">Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>



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
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript (popper.js is required for Bootstrap 4) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!--CHAMADA DA MODAL DELETAR -->
    <?php
    if (isset($_GET['funcao']) && $_GET['funcao'] == 'excluir') {
        $id = $_GET['id'];
        ?>

        <div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Registro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>Deseja realmente Excluir este Registro?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            id="btn-cancelar-excluir">Cancelar</button>
                        <form method="post">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>" required>

                            <button type="button" id="btn-deletar" name="btn-deletar"
                                class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <?php } ?>
    <script>$('#modal-deletar').modal("show");</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#btn-deletar').click(function (event) {
                event.preventDefault();

                $.ajax({
                    url: "/we/views/painel_user/locacao/excluir.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (mensagem) {
                        // Após o sucesso da exclusão, redireciona para outra página
                        window.location.href = "/we/views/painel_user/jogos_alugados.php";
                    }
                });
            });
        });
    </script>
    <script src="js/card.js"></script>
</body>

</html>