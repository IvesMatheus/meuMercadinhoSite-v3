<?php

    include_once "../_dao/ProdutoDAO.php";

    $mercado_array = json_decode($_POST["mercado"], true);
    //$mercado_array = array('id'=>3);
    $mercado = new Mercado();
    $mercado->setId($mercado_array["id"]);

    $produtoDAO = new ProdutoDAO();
    $produtos = $produtoDAO->listarPorMercado($mercado);

    $produto = new Produto();
    $produto->setMercado(new Mercado());
    $imagem = new Imagem();
    $imagem->setCategoria(new Categoria());
    $produto->setImagem($imagem);
    $produto->setCategoria(new Categoria());

    $aux = array(0 => $produto->toArray());
    $i = 0;

    foreach ($produtos as $key => $value)
    {
        $aux[$i] = $value->toArray();
        $i++;
    }

    echo json_encode($aux);

?>
