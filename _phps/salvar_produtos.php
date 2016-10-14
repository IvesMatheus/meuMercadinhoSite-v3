<?php
    include "../_dao/ProdutoDAO.php";
    session_start();

    //pega os produtos que foram add
    $values = $_SESSION["add_produtos"];
    $produtos = null;
    $i = 0;

    foreach ($values as $key => $value)
    {
        //verifica se o produto não foi retirado da lista
        if($value != null)
        {
            //verifica se o produto está com todas as informações (verificar porque há produtos com a categoria null)
            if($value->getCategoria() != null)
            {
                //add o produto no array que será usado para salva no BD
                $produtos[$i] = $value;
                $produtos[$i]->setMercado($_SESSION["mercado"]);
                $i++;
            }
        }
    }

    //verifica se o array tem produto para add
    if(count($produtos) > 0)
    {
        $produtoDAO = new ProdutoDAO();
        $retorno = $produtoDAO->inserir($produtos);

        if($retorno)
        {
            // zera array de produtos
            $_SESSION["add_produtos"] = FALSE;

            header("Location: ../_telas/produtos.php");
        }
        else
            header("Location: ../_telas/add_produtos.php");
    }
    else
        header("Location: ../_telas/add_produtos.php");
?>
