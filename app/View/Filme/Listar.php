<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";

$filmeModel = new Filme($conn);
$filmes = $filmeModel->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes</title>

    <link rel="stylesheet" href="..\..\..\public\css\style.css">
</head>

<body>
    <section class="container">
        <h1>Grade de Filmes</h1>

        <div class="acao">
            <a href="Cadastrar.php">
                <button class="add" title="Adicionar filme">
                    
                    <span class="material-symbols-outlined">
                        add
                    </span>
                    <span>Filme</span>
                </button>
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Capa</th>

                    <th>Titulo</th>

                    <th>Gênero</th>

                    <th>Ano</th>
                    <th></th>

                </tr>

            </thead>

            <tbody>

                <!-- percorre a lista de resultados -->
                <?php foreach ($filmes as $filme) { ?>

                    <tr>
                        <!-- Informações da tabela -->

                        <!-- Capa -->
                        <td>
                            <?php echo "<a href='$filme->link_img' target='_blank'><img class='img'  src='$filme->link_img'></a>"?>
                        </td>

                        <!-- Titulo -->
                        <td>
                            <?php echo $filme->titulo ?>
                        </td>

                        <!-- Gênero -->
                        <td>
                            <?php echo $filme->genero ?>
                        </td>
                        
                        <!-- Ano -->
                        <td>
                            <?php echo $filme->ano ?>
                        </td>

                        <!-- Botões de Ação -->
                        <td>

                            <form class="acao" action="Visualizar.php" method="GET">

                                <input  type="hidden" name="id" value="<?php echo $filme->id ?>">

                                <button title="Ver descrição">

                                    <span class="material-symbols-outlined">
                                        info
                                    </span>

                                </button>

                            </form>

                            <form class="acao" action="Excluir.php" method="POST">

                                <input type="hidden" name="id" value="<?php echo $filme->id ?>">

                                <button title="Excluir">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>

                            </form>

                            <form class="acao" action="Cadastrar.php" method="GET">

                                <input type="hidden" name="id" value="<?php echo $filme->id ?>">

                                <button>

                                    <span class="material-symbols-outlined" title="Editar">
                                        edit
                                    </span>

                                </button>

                            </form>

                        </td>

                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </section>


    <script defer>
        /*
            se o PHP retornar mensagem=erro -> Erro ao excluir filme.
            se o PHP retornar mensagem=sucesso -> O filme foi excluído com sucesso.
        */
        const parametros = new URLSearchParams(window.location.search)

        const tipoMensagem = parametros.get("mensagem")

        if (tipoMensagem === "sucesso") {

            const notificacao = document.createElement("div")

            notificacao.className = "notificacao sucesso"

            notificacao.innerHTML = "Operação realizada com sucesso!"

            document.body.appendChild(notificacao)

            setTimeout(function () {

                document.body.removeChild(notificacao)

                parametros.delete("mensagem")

                const novaUrl = window.location.pathname

                window.history.replaceState(null, "", novaUrl)

            }, 2000)

        } else if (tipoMensagem === "erro") {

            const notificacao = document.createElement("div")

            notificacao.className = "notificacao erro"

            notificacao.innerHTML = "Erro ao realizar operação!"

            document.body.appendChild(notificacao)

            setTimeout(function () {

                document.body.removeChild(notificacao)

                parametros.delete("mensagem")

                const novaUrl = window.location.pathname

                window.history.replaceState(null, "", novaUrl)

            }, 2000)
        }

    </script>
    
</body>

</html>