// CODIGO DE REQUEST PARA INSERIR DADOS USER 

$(document).ready(function () {
    $('#btn-buscar').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/we/views/painel_adm/user/listar.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "html",
            success: function (result) {
                $('#listar').html(result)
                $('#Salvar').click();

            },
        })
    });

    $.ajax({
        url: "/we/views/painel_adm/user/listar.php",
        method: "post",
        data: $('#frm').serialize(),
        dataType: "html",
        success: function (result) {
            $('#listar').html(result)

        },
    })


    //INSERIR USER BD
    $('#Salvar').click(function (event) {
        event.preventDefault();

        // Exibir caixa de diálogo de confirmação usando SweetAlert2
        Swal.fire({
            title: 'Confirmar Cadastro',
            text: 'Deseja realmente cadastrar este Usuario?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {

                // O usuário confirmou, então prosseguir com o cadastro

                $.ajax({
                    url: "/we/views/painel_adm/user/inserir.php",
                    method: "post",
                    data: $('form').serialize(),
                    dataType: "text",
                    success: function (mensagem) {
                        $('#mensagem').removeClass();

                        if (mensagem == 'Cadastrado com Sucesso!!') {
                            $('#mensagem').addClass('mensagem-sucesso');
                            $('#nome').val('');
                            $('#email').val('');
                            $('#senha').val('');
                            $('#nivel').val('');
                            $('#Salvar').click();

                            // Exibir caixa de diálogo personalizada
                            Swal.fire({
                                title: 'Usuario cadastrado com sucesso!',
                                text: 'Deseja adicionar mais algum usuario?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Sim',
                                cancelButtonText: 'Não'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirecionar para a página de cadastro
                                    window.location.href = '/we/views/painel_adm/usuarios.php';
                                } else {
                                    window.location.href = '/we/views/painel_adm/adm_panel.php';
                                }
                            });
                        } else {
                            $('#mensagem').addClass('mensagem-erro');
                            // Exibir mensagem de erro do servidor no SweetAlert2
                            Swal.fire({
                                title: 'Erro!',
                                text: mensagem, // A mensagem de erro do servidor
                                icon: 'error'
                            });
                        }
                    },
                });
            }
        });
    });
});

//EDITAR
$(document).ready(function () {
    $('#Editar').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/we/views/painel_adm/user/editar.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {
                if (mensagem.trim() === 'Cadastrado com Sucesso!!') { // Verifica se a mensagem é de sucesso
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        text: mensagem
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#txtbuscar').val('');
                            $('#btn-buscar').click();
                            $('#btn-fechar').click();
                        }
                    });
                } else { // Se não for sucesso, assume-se que é um erro
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: mensagem
                    });
                }
            }
        });
    });
});





// ================================================ CAD_JOGO

//ENVIAR E RECERBER INFORMAÇÕES NA HORA DO CADASTRO DO JOGO
$(document).ready(function () {
    $('#Salvar1').click(function (event) {
        event.preventDefault();

        // Crie um objeto FormData para enviar dados do formulário, incluindo arquivos
        var formData = new FormData($('#product-form')[0]);

        // Exibir caixa de diálogo de confirmação usando SweetAlert2
        Swal.fire({
            title: 'Confirmar Cadastro',
            text: 'Deseja realmente cadastrar este Jogo?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/we/views/painel_adm/cad_jogos/inserir.php",
                    method: "post",
                    data: formData, // Envie o objeto FormData em vez de serializar o formulário
                    contentType: false, // Não defina o tipo de conteúdo
                    processData: false, // Não processe os dados
                    dataType: "text",
                    success: function (mensagem) {
                        console.log(mensagem); // Exibe a resposta do PHP no console do navegador

                        if (mensagem.toLowerCase().includes('sucesso')) {
                            // Exibir caixa de diálogo de sucesso com a opção de adicionar mais jogos
                            Swal.fire({
                                title: 'Jogo cadastrado com sucesso!',
                                text: 'Deseja adicionar mais algum jogo?',
                                icon: 'success', // Defina explicitamente o ícone de sucesso
                                showCancelButton: true,
                                confirmButtonText: 'Sim',
                                cancelButtonText: 'Não'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirecionar para a página de cadastro
                                    window.location.href = '/we/views/painel_adm/adm_panel.php';
                                } else {
                                    window.location.href = '/we/views/painel_adm/cad_jogos.php';
                                }
                            });
                        } else {
                            // Exibir mensagem de erro do servidor
                            Swal.fire({
                                title: 'Erro!',
                                text: mensagem,
                                icon: 'error'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Exibir mensagem de erro genérica caso o AJAX falhe
                        Swal.fire({
                            title: 'Erro!',
                            text: 'Ocorreu um erro durante o envio dos dados. Por favor, tente novamente mais tarde.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});

$(document).ready(function () {

    $.ajax({
        url: "/we/views/painel_adm/cad_jogos/listar.php",
        method: "post",
        data: $('#frm').serialize(),
        dataType: "html",
        success: function (result) {
            $('#listarJog').html(result)

        },


    })

    $.ajax({
        url: "/we/views/painel_adm/cad_jogos/listar.php",
        method: "post",
        data: $('#frm').serialize(),
        dataType: "html",
        success: function (result) {
            $('#listarJog').html(result)

        },


    })
});

$(document).ready(function () {
    $('#btn-deletar').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/we/views/painel_adm/user/excluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function (mensagem) {
                // Após o sucesso da exclusão, redireciona para outra página
                window.location.href = "/we/views/painel_adm/usuarios.php";
            }
        });
    });
});




