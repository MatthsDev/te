<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/we/controller/bdconnect/conexao.php';


$txtbuscar = $_POST['txtbuscar'];

echo '

<table class="table table-sm mt-3">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Nivel</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>';


    //TOTALIZAR OS REGISTROS PARA PAGINAÇÃO
    $res_todos = $pdo->query("SELECT * from usuario");
    $dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
    $num_total = count($dados_total);

    for ($i=0; $i < count($dados_total); $i++) { 
        foreach ($dados_total[$i] as $key => $value) {
        }

        $id = $dados_total[$i]['id']; 
        $nome = $dados_total[$i]['nome'];
        $email = $dados_total[$i]['usuario'];
        $nivel = $dados_total[$i]['nivel'];

echo '
        <tr>
            <td>'.$nome.'</td>
            <td>'.$email.'</td>
            <td>'.$nivel.'</td>
            <td>
            <a href="/we/views/painel_adm/usuarios.php?funcao=editar&id='.$id.'"><i class="fas fa-edit text-info"></i></a>
            <a href="/we/views/painel_adm/usuarios.php?funcao=excluir&id='.$id.'"><i class="far fa-trash-alt text-danger"></i></a>
            </td>
        </tr>';
    }

echo '
    </tbody>
</table> ';
?>
