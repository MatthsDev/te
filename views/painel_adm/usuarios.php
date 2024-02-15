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
								<input class="form-control form-control-sm mr-sm-2" type="search"
									placeholder="NOME OU EMAIL" aria-label="Search" name="txtbuscar" id="txtbuscar">

								<button class="btn btn-outline-secondary btn-sm my-2 my-sm-0" name="btn-buscar"
									id="btn-buscar"><i class="fas fa-search"></i></button>

							</form>
						</div>

						<div class="col-md-6">
							<div class="float-right">
								<button id="openModalBtn" class="btn btn-secondary">NOVO USUARIO</button>
							</div>
						</div>
					</div>
				</div><!-- FINAL DIV ROW -->

				<div id="listar"></div>

				<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">



								<?php
								if (isset($_GET['funcao']) && $_GET['funcao'] == 'editar') {
									$nome_botao = 'Editar';
									$id_reg = $_GET['id'];


									$res = $pdo->query("SELECT * FROM usuario where id = '$id_reg'");
									$dados = $res->fetchAll(PDO::FETCH_ASSOC);
									$nome = $dados[0]['nome'];
									$email = $dados[0]['usuario'];
									$senha_original = $dados[0]['senha_original'];
									$nivel = $dados[0]['nivel'];
									$nomeTit = 'EDITAR DADOS';


								} else {
									$nome_botao = 'Salvar';
									// Definir valores padrão para as variáveis em caso de criação de novo registro
									$id_reg = '';
									$nome = '';
									$email = '';
									$senha_original = '';
									$nivel = '';
									$nomeTit = 'NOVO USUARIO';
								}
								?>

								<h5 class="modal-title" id="modalLabel">
									<?php echo $nomeTit ?>
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<form id="formNovoUsuario">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlInput1">NOME *</label>
												<input type="text" class="form-control" id="nome"
													placeholder="INFORME O NOME... " name="nome" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlInput1">EMAIL *</label>
												<input type="email" class="form-control" id="email"
													placeholder="INFORME O EMAIL.." name="email" required>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="exampleFormControlInput1">SENHA *</label>
												<input type="password" class="form-control" id="senha"
													placeholder="INFORME A SENHA... " maxlength="8" name="senha"
													required>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="exampleFormControlInput1">TELEFONE *</label>
												<input type="text" class="form-control" id="tel"
													placeholder="INFORME O TELEFONE.." maxlength="14" name="tel"
													required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="exampleFormControlInput1">NIVEL DE ACESSO
													*</label>
												<select name="nivel" class="form-control" id="nivel">
													<option value="ADMINISTRADOR">ADMINISTRADOR</option>
													<option value="OPERADOR">OPERADOR</option>
													<option value="USUARIO_COMUM">USUARIO_COMUM</option>
												</select>
											</div>
										</div>
									</div>
									<div id="mensagem" class=""></div>

							</div> <!-- /ModalBody -->
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" name="<?php echo $nome_botao ?>"
									id="<?php echo $nome_botao ?>">
									<?php echo $nome_botao ?>
								</button>
								<button type="button" class="btn btn-secondary" onclick="limparParametrosURL()"
									id="closeModalBtn" data-dismiss="modal">Fechar</button>
							</div>
							</form>
						</div>
					</div>
				</div><!--  /myMODAL  -->
			</div><!--  /GRID  -->
		</div><!--  /CONT-GRID  -->
	</section>

	<script src="js/modal.js"></script>

	<?php if (isset($_GET['funcao']) && $_GET['funcao'] == 'editar'): ?>
		<script>
			$(document).ready(function () {
				$('#openModalBtn').click();

				// Preencher os campos da modal com os valores obtidos do banco de dados
				document.getElementById('nome').value = '<?php echo $nome; ?>';
				document.getElementById('email').value = '<?php echo $email; ?>';
				document.getElementById('senha').value = '<?php echo $senha_original; ?>';
				document.getElementById('nivel').value = '<?php echo $nivel; ?>';

			});
		</script>
	<?php endif; ?>

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

	<script src="js/card.js"></script>
	<script src="js/ajax/request.js"></script>

</body>

</html>