<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Filme.php";

$filmeModel = new Filme($conn);

$id = $_GET["id"];

$filme = $filmeModel->findById($id);

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

        <h1>Detalhes do Filme</h1>

        <div class="descricao">

            <h3> <?php echo $filme->titulo ?></h3>

            <p>Gênero: <?php echo $filme->genero ?></p>

            <p>Ano: <?php echo $filme->ano ?></p>

            <p>Descrição: <?php echo $filme->descricao ?></p>

            <div class="acao">
            <a href="Listar.php">
                <button class="voltar">
                    <span class="material-symbols-outlined">
                        arrow_back
                    </span>
                    <span>Voltar</span>
                </button>
            </a>
        </div>

        </div>
        
        <div class="trailer">
            <h1>Assista ao Trailer</h1>

            <?php 
                echo "<iframe  width='560' height='315' src='$filme->link_trailer' </iframe>"  
            ?>
        </div>
        
    </section>
    
</body>
</html>