<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Usuario.php";

$usuarioModel = new Usuario($conn);
$usuarios = $usuarioModel->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <link rel="stylesheet" href="/catalogo-filmes/public/css/style.css">
</head>

<tbody>
    <section class="container">
        <h2>Lista de Usuarios</h2>

        <div class="acao">
            <a href="Cadastrar.php">
                <button>
                    <span>Add Usuario</span>
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </button>
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- percorre a lista de resultados -->
                <?php foreach ($usuarios as $usuario) { ?>
                    <tr>
                        <!-- escreve na tabela cada item retornado -->
                        <td><?php echo $usuario->id ?></td>
                        <td><?php echo $usuario->nome ?></td>
                        <td><?php echo $usuario->email ?></td>
                        <td>
                            <form action="Visualizar.php" method="GET">
                                <input type="hidden" name="id" value="<?php echo $usuario->id ?>">
                                <button><span class="material-symbols-outlined">
                                        info
                                    </span>
                                </button>
                            </form>
                            
                            <form action="Excluir.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $usuario->id ?>">
                                <button><span class="material-symbols-outlined">
                                        delete
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