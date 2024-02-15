<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/autenticação/session.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

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

    <style>
        .content_card {
            flex-flow: column;
        }

        .product-card {
            border: 1px solid #ddd;
            display: flex;
            margin: 10px;
            width: 100%;
        }

        .product-image {
            flex: 1;
            height: 300px;
            /* Defina a altura desejada para o contêiner da imagem */
            overflow: hidden;
            /* Garante que qualquer imagem maior seja cortada */
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 2;
            padding: 10px;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
        }

        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
        }

        .product-location,
        .product-date {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        .favorite-button {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
    </style>

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



    <section class="hero-slider">

        <div class="container-fluid mt-4">
            <div class="col-md-12 col-sm-12">
                <div class="row mt-8">
                    <div class="cont_top">
                        <div class="col-md-6 col-sm-12">

                            <form id="frm" class="form-inline my-2 my-lg-0" method="post">
                                <input type="hidden" id="pag" name="pag"
                                    value="<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : ''; ?>">
                                <input type="hidden" id="itens" name="itens"
                                    value="<?php echo isset($itens_por_pagina) ? $itens_por_pagina : ''; ?>">
                                <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="NOME"
                                    aria-label="Search" name="txtbuscar" id="txtbuscar">

                                <button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar"
                                    id="btn-buscar"><i class="fas fa-search"></i></button>

                            </form>
                        </div>

                        <div class="col-md-6">
                            <div class="float-right">
                                <button id="openModalBtn" class="btn btn-secondary">CADASTRAR JOGO</button>
                            </div>
                        </div>
                    </div>
                </div><!-- FINAL DIV ROW -->



                <div class="exjog">
                    <div class="content_card">
                        <div id="listarJog"></div>

                    </div>
                </div>

                <div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">CADASTRAR JOGO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="product-form" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="nomePro" name="nomePro"
                                                    placeholder="NOME DO JOGO...">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="gen" name="gen"
                                                    placeholder="GENERO DO JOGO...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="marca" name="marca"
                                                    placeholder="MARCA DO JOGO...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="tipo" name="tipo"
                                                    placeholder="TIPO DO JOGO...">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" id="preco" class="form-control" name="preco"
                                                    placeholder="PREÇO DO JOGO...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea type="text" class="form-control" id="descricao"
                                                    name="descricao" placeholder="DESCRICÃO DO PRODUTO"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="file" name="fileToUpload" id="fileToUpload">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" name="Salvar1"
                                    id="Salvar1">Salvar</button>
                                <button type="button" class="btn btn-secondary" onclick="limparParametrosURL()"
                                    id="closeModalBtn" data-dismiss="modal">Fechar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!--  /GRID  -->
        </div><!--  /CONT-GRID  -->
    </section>


    <script src="js/modal.js"></script>
    <script src="js/card.js"></script>

    <script src="js/ajax/request.js"></script>















</body>

</html>