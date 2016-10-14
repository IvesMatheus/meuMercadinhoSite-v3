<?php
    include_once "../_dao/ProdutoDAO.php";
    session_start();

    $produtoAnt = ProdutoDAO::listarPorId(new Produto($_SESSION["edt_prod"], '', '', '', '', '', '', '', '', ''))[0];
    $imagem = $_SESSION["imagens"][$_SESSION["imagem_atual"]];

    //echo $_GET["nome"];

    $dia = substr($_GET["validade"], 0, 2);
    $mes = substr($_GET["validade"], 3, 2);
    $ano = substr($_GET["validade"], 6, 4);

    $validade = mktime(23, 59, 58, $mes, $dia, $ano);

    $produto = new Produto($produtoAnt->getId(), $_GET["nome"], $_GET["peso"], $validade, $_GET["quantidade"], $_GET["preco"], $imagem, CategoriaDAO::listarPorId(new Categoria($_GET["categoria"], '', '', '')), $_GET["descricao"], $_SESSION["mercado"]);

    $produtoDAO = new ProdutoDAO();
    echo $produtoDAO->atualizar(array(0 => $produto));

    header("Location: ../_telas/produtos.php");
?>
