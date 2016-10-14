<?php
    include "../_dao/ProdutoDAO.php";
    session_start();

    $id = $_GET["id"];
    $op = $_GET["op"];
    if($op == 0)
    {
        $produto = $_SESSION["add_produtos"][$id];
        $_SESSION["alt_produto"] = $produto;
        $_SESSION["id_alt"] = $id;
    }
    else
        $_SESSION["add_produtos"][$id] = null;

    header("Location: ../_telas/add_produtos.php");
?>
