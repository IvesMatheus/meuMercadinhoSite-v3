<?php
    include "../_dao/CategoriaDAO.php";
    include "../_model/Produto.php";
    include "../_model/Imagem.php";
    session_start();

    if(!isset($_SESSION["add_produtos"]))
    {
        $produtos = array(0 => null);
        $_SESSION["add_produtos"] = $produtos;
        $_SESSION["id_add_produtos"] = 0;
        $_SESSION["salvar_produto"] = true;
    }
    else
    {
        $id = $_SESSION["id_add_produtos"];
        $produtos = $_SESSION["add_produtos"];

        $produto = new Produto($_POST["txtNome"], $_POST["txtPeso"], $_POST["txtValidade"], $_POST["txtQuantidade"], $_POST["txtPreco"], new Imagem(), CategoriaDAO::listarPorId(new Categoria($_POST["sltCategoria"], "", "", "")), $_POST["txtDescricao"], $_SESSION["login"]);

        $produtos[$id] = $produto;
        $_SESSION["id_add_produtos"] = $id + 1;
        $_SESSION["add_produtos"] = $produtos;
    }

    header("Location: ../_telas/add_produto.php");
?>
