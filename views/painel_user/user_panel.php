<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/autenticação/session.php';

//TOTALIZAR OS REGISTROS
$res_todos = $pdo->query("SELECT * from jogos");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

$nome_usuario = $_SESSION['user_usuario'];

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
    <link rel="stylesheet" href="css/lib.css">
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



    <section class="hero-slider">
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- 2.1 | PARTE LATERAL CONTEUDO DOS MENUS -->
                <div class="col-md-3 col-sm-12 mb-4">
                    <div class="card">
                        <div class="htit">
                            <h3 class="cat-heading">CATEGORIAS</h3>
                        </div>
                        <div class="bodycard">
                            <div class="category-item">
                                <a href="#">JOGOS DE TABULEIRO</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Estratégia</a></div>
                                    <div class="subcategory-item"><a href="#">Party Games</a></div>
                                    <!-- Adicione mais subcategorias conforme necessário -->
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE CARTA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Uno</a></div>
                                    <div class="subcategory-item"><a href="#">Poker</a></div>
                                    <!-- Adicione mais subcategorias conforme necessário -->
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE AÇÃO</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">FPS (First-Person Shooter)</a></div>
                                    <div class="subcategory-item"><a href="#">Hack and Slash</a></div>
                                    <div class="subcategory-item"><a href="#">Beat 'em up</a></div>
                                    <div class="subcategory-item"><a href="#">Sandbox</a></div>
                                    <div class="subcategory-item"><a href="#">Survival Horror</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE CORRIDA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Simulação de Corrida</a></div>
                                    <div class="subcategory-item"><a href="#">Arcade de Corrida</a></div>
                                    <div class="subcategory-item"><a href="#">Kart Racing</a></div>
                                    <div class="subcategory-item"><a href="#">Rally</a></div>
                                    <div class="subcategory-item"><a href="#">Corrida Futurista</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE ESPORTE</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Futebol</a></div>
                                    <div class="subcategory-item"><a href="#">Basquete</a></div>
                                    <div class="subcategory-item"><a href="#">Tênis</a></div>
                                    <div class="subcategory-item"><a href="#">Golfe</a></div>
                                    <div class="subcategory-item"><a href="#">Esportes Radicais</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS EDUCATIVOS</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Matemática</a></div>
                                    <div class="subcategory-item"><a href="#">Linguagens</a></div>
                                    <div class="subcategory-item"><a href="#">Ciências</a></div>
                                    <div class="subcategory-item"><a href="#">História</a></div>
                                    <div class="subcategory-item"><a href="#">Geografia</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE MÚSICA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Ritmo</a></div>
                                    <div class="subcategory-item"><a href="#">Simulação de Instrumentos</a></div>
                                    <div class="subcategory-item"><a href="#">Karaokê</a></div>
                                    <div class="subcategory-item"><a href="#">Dança</a></div>
                                    <div class="subcategory-item"><a href="#">Composição</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE QUEBRA-CABEÇA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Jigsaw</a></div>
                                    <div class="subcategory-item"><a href="#">Lógica</a></div>
                                    <div class="subcategory-item"><a href="#">Match-3</a></div>
                                    <div class="subcategory-item"><a href="#">Escape Room</a></div>
                                    <div class="subcategory-item"><a href="#">Tetris</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE SIMULAÇÃO</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Vida</a></div>
                                    <div class="subcategory-item"><a href="#">Construção e Gerenciamento</a></div>
                                    <div class="subcategory-item"><a href="#">Veículos</a></div>
                                    <div class="subcategory-item"><a href="#">Voo</a></div>
                                    <div class="subcategory-item"><a href="#">Negócios</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE AVENTURA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Point and Click</a></div>
                                    <div class="subcategory-item"><a href="#">Survival</a></div>
                                    <div class="subcategory-item"><a href="#">Mundo Aberto</a></div>
                                    <div class="subcategory-item"><a href="#">Exploração</a></div>
                                    <div class="subcategory-item"><a href="#">Fantasia</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE RPG</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Ação RPG</a></div>
                                    <div class="subcategory-item"><a href="#">Tático</a></div>
                                    <div class="subcategory-item"><a href="#">MMORPG</a></div>
                                    <div class="subcategory-item"><a href="#">JRPG</a></div>
                                    <div class="subcategory-item"><a href="#">Sandbox</a></div>
                                </div>
                            </div>

                            <div class="category-item">
                                <a href="#">JOGOS DE PLATAFORMA</a>
                                <div class="subcategories">
                                    <div class="subcategory-item"><a href="#">Ação Plataforma</a></div>
                                    <div class="subcategory-item"><a href="#">Quebra-Cabeça</a></div>
                                    <div class="subcategory-item"><a href="#">Metroidvania</a></div>
                                    <div class="subcategory-item"><a href="#">Roguelike</a></div>
                                    <div class="subcategory-item"><a href="#">Construção de Plataforma</a></div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>




                <div class="col-md-9 col-sm-12"> <!-- DIV CONTEUDO DE PRODUTOS -->
                    <div class="content_card">
                        <div class="kadence-shop-top-row">
                            <div class="kadence-shop-top-item kadence-woo-results-count">
                                <p class="woocommerce-result-count">
                                    Exibindo
                                    <?php echo count($dados_total); ?> de
                                    <?php echo $num_total; ?> resultados
                                </p>
                            </div>
                            <div class="kadence-shop-top-item kadence-woo-ordering">
                                <form class="woocommerce-ordering" method="get">
                                    <select name="orderby" class="orderby" aria-label="Pedido da loja">
                                        <option value="popularity">Ordenar por popularidade</option>
                                        <option value="date" selected="selected">Ordenar por mais recente</option>
                                        <option value="price">Ordenar por preço: menor para maior</option>
                                        <option value="price-desc">Ordenar por preço: maior para menor</option>
                                    </select>
                                    <input type="hidden" name="paged" value="1">
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            //TOTALIZAR OS REGISTROS
                            $res_usuario = $pdo->query("SELECT * from usuario where usuario = '$nome_usuario'");
                            $dados_usuario = $res_usuario->fetchAll(PDO::FETCH_ASSOC);
                            $id_user = $dados_usuario[0]['id'];



                            foreach ($dados_total as $index => $jogo) {
                                $id_jogo = $jogo['id'];
                                $nome = $jogo['nome'];
                                $img = base64_encode($jogo['dados']);
                                $tipo = $jogo['tipo'];
                                $preco = $jogo['preco'];

                                echo '
                                <div class="col-md-3" id="card_ident">
                                    <form method="post" action="/we/views/painel_user/locacao/inserir.php">
                                        <input type="hidden" name="id_jogo" value="' . $id_jogo . '">
                                        <input type="hidden" name="id_user" value="' . $id_user . '">
                                        <div class="product-card" id="product-card1">
                                            <div class="main">
                                                <img src="data:image/jpeg;base64,' . $img . '" alt="Imagem do jogo" id="main-image1" />
                                                <div class="price" id="price1">R$' . $preco. '</div>
                                                <div class="desc_pro">
                                                    <h3>' . $tipo . '</h3>
                                                    <h2>' . $nome . '</h2>
                                                </div>
                                            </div>
                                            <div class="btn">
                                                <button type="submit" name="alugar" class="buy">ALUGAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>';
                            }
                            ?>
                        </div><!-- FINAL DIV ROW -->
                    </div><!-- FINAL DIV CONTENT_CARD -->
                </div><!-- FINAL DIV CONTEUDO DE PRODUTOS -->
            </div>
        </div>
    </section>
    <script src="js/card.js"></script>
</body>

</html>