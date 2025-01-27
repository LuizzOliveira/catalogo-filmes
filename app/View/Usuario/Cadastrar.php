<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Usuario.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nome"]) && isset($_POST["email"])) {

        $usuarioModel = new Usuario($conn);
        $usuarioModel->insert(
            $_POST["nome"],
            $_POST["email"]
        );

        return header("Location: Listar.php");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>usuario</title>

    <link rel="stylesheet" href="/catalogo-filmes/public/css/style.css">
</head>

<body>

    <section class="container">
        <h2>Cadastar Usuario</h2>

        <form class="form" action="Cadastrar.php" method="POST">
            <div class="form-content">
                <div class="input-group required">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" required>
                </div>

                <div class="input-group required">
                    <label for="email">Email</label>
                    <input type="text" name="email" required>
                </div>

                <div class="form-action acao">
                    <a href="Listar.php">
                        <button type="button">
                            <span class="material-symbols-outlined">
                                arrow_back
                            </span>
                            <span>Voltar</span>
                        </button>
                    </a>

                    <button>
                        <span>Salvar</span>
                        <span class="material-symbols-outlined">
                            save
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </section>

</body>

</html>