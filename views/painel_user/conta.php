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




    <section class="hero-slider">

        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-md-12 col-sm-12"> 
                    <div class="content_card">
                        <div class="row">
                        </div><!-- FINAL DIV ROW -->
                    </div><!-- FINAL DIV CONTENT_CARD -->
                </div><!-- FINAL DIV CONTEUDO DE PRODUTOS -->
            </div>
        </div>

    </section>

    <script src="js/card.js"></script>

</body>

</html>