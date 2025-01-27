<?php

require __DIR__ . "/../../Config/Database.php";
require __DIR__ . "/../../Model/Filme.php";

$filmeModel = new Filme($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!empty($_POST["id"])) {

        if (!empty($_POST["titulo"]) && !empty($_POST["ano"])) {
            

            $sucesso = $filmeModel->update(
                $_POST["id"],
                $_POST["genero"],
                $_POST["titulo"],
                $_POST["ano"],
                $_POST["descricao"],
                $_POST["link_img"],
                $_POST["link_trailer"]
            );

            if ($sucesso === TRUE) {
                return header("location: Listar.php?mensagem=sucesso");
            } else {
                return header("location: Listar.php?mensagem=erro");
            }
        }
    } else {

        if (!empty($_POST["titulo"]) && !empty($_POST["ano"])) {

            $sucesso = $filmeModel->insert(
                $_POST["genero"],
                $_POST["titulo"],
                $_POST["ano"],
                $_POST["descricao"],
                $_POST["link_img"],
                $_POST["link_trailer"]
            );

            if ($sucesso === TRUE) {
                return header("location: Listar.php?mensagem=sucesso");
            } else {
                return header("location: Listar.php?mensagem=erro");
            }
        }
    }

} else {
    
    if(!empty($_GET["id"])) {
        $id = $_GET["id"];
        $filmes = $filmeModel->findById($id);
    } else {
        
        $filmes = new Filme();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>filmes</title>

    <link rel="stylesheet" href="..\..\..\public\css\style.css">

</head>

<body>

    <section class="container descricao">

        <?php 
            if (empty($_GET["id"])){

                print_r("<h2>Cadastro de Filme</h2>");

            } else{

                print_r("<h2>Editar de Filme</h2>");
                
            }
        ?>
        <!-- <h2>Cadastro de Filme</h2> -->

        <form class="form" action="Cadastrar.php" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $filmes->id ?>">
                

                <div class="input-group required">

                    <label for="genero"> </label>

                    <input type="text" placeholder="Gênero:" 
                    name="genero" required value="<?php echo $filmes->genero ?>">

                </div>

                <div class="input-group required">

                    <label for="titulo"> </label>

                    <input type="text" placeholder="Titulo:" name="titulo" required value="<?php echo $filmes->titulo ?>">

                </div>

                <div class="input-group required">

                    <label for="ano"> </label>

                    <input type="number" placeholder="Ano:" name="ano" required value="<?php echo $filmes->ano ?>">

                </div>

                <div class="input-group">

                    <label for="descricao"> </label>

                    <textarea name="descricao" placeholder="Descrição:" rows="5"><?php echo $filmes->descricao ?></textarea>

                </div>

                <div class="input-group required">

                    <label for="link_img"> </label>

                    <input type="text" placeholder="Link_imagem:" name="link_img" required value="<?php echo $filmes->link_img ?>">

                </div>

                <div class="input-group required">

                    <label for="link_trailer"></label>

                    <input type="text" placeholder="Link_trailer:" name="link_trailer" required value="<?php echo $filmes->link_trailer ?>">

                </div>

                <div class="form-action acao">

                    <button class="salvar">

                        <span>Salvar</span>

                        <span class="material-symbols-outlined">
                            save
                        </span>

                    </button>

                </div>

                
                
        </form>

        <div class="form-action acao">

            <a href="Listar.php">

                <button class="voltar" >

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