<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';

//TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
$res_todos = $pdo->query("SELECT * from jogos");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$num_total = count($dados_total);

echo '<div class="exjog">';
foreach ($dados_total as $jogo) {
    $nome = $jogo['nome'];
    $img = base64_encode($jogo['dados']);
    $tipo = $jogo['tipo'];

    echo '
    <div class="content_card">
        <div class="product-card">
            <div class="product-image">
                <img src="data:image/jpeg;base64,'.$img.'" alt="Imagem do jogo">
            </div>
            <div class="product-info">
                <h2 class="product-title">'.$nome.'</h2>
                <p class="product-location">'.$tipo.'</p>
                <p class="product-date">Hoje, 19:04</p>
                <div class="product-price">R$ 100</div>
                <button class="favorite-button">EDITAR INFORMAÇÕES</button>
            </div>
        </div>
    </div>';
}
echo '</div>';
?>
