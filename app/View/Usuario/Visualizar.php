<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Usuario.php";

$usuarioModel = new Usuario($conn);

$id = $_GET["id"];

$usuario = $usuarioModel->findById($id);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <link rel="stylesheet" href="/catalogo-filmes/public/css/style.css">
</head>

<body>
    <section class="container">
        <h1>Detalhes do Usuário</h1>

        <h3>Nome: <?php echo $usuario->nome ?></h3>
        <p>E-mail: <?php echo $usuario->email ?></p>

        <div class="acao">
                <a href="Listar.php">
                    <button>
                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>
                        <span>Voltar</span>
                    </button>
                </a>
            </div>
    </section>
</body>
</html>