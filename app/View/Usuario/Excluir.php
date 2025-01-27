<?php

require __DIR__ . "\..\..\Config\Database.php";
require __DIR__ . "\..\..\Model\Usuario.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    return header("Location: Listar.php");
}

$id = (int) $_POST["id"];

$usuarioModel = new Usuario($conn);
$sucesso = $usuarioModel->delete($id);

if ($sucesso === TRUE) {
    return header("Location: Listar.php?mensagem=sucesso");
} else {
    return header("Location: Listar.php?mensagem=erro");
}
