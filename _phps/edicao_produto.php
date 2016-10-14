<?php
    include_once "../_dao/ProdutoDAO.php";
    session_start();

    $id_produto = $_GET["produto"];

    if($_GET["op"] == 1)
    {
        $_SESSION["edt_prod"] = $id_produto;
        header("Location: ../_telas/editar_produto.php");
    }
    else
    {
        $produtoDAO = new ProdutoDAO();
        $aux = array(0 => new Produto($id_produto, '', '', '', '', '', '', '', '', ''));
        $produtoDAO->excluir($aux);

        header("Location: ../_telas/produtos.php");
    }
?>
