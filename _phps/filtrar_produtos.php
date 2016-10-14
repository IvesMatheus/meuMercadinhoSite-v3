<?php
    include_once "../_dao/ProdutoDAO.php";
    session_start();

    if(isset($_POST["categoria"]))
    {
        $id = $_POST["categoria"];

        $produtoDAO = new ProdutoDAO();
        $categoria = new Categoria($id, "", "", "");
        $produtos = $produtoDAO->listarPorCategoria($categoria, $_SESSION["mercado"]);
        $msg = "Não há produtos da categoria selecionada";
    }
    else
    {
        $nome = $_POST["nome"];

        if($nome != "")
        {
            $produtos = ProdutoDAO::listarPorNome(new Produto($nome, '', '', '', '', '', '', '', $_SESSION["mercado"]));
            $msg = "Não há produtos com esse nome";
        }
        else
        {
            $produtoDAO = new ProdutoDAO();
            $produtos = $produtoDAO->listarPorMercado($_SESSION["mercado"]);
        }
    }

    if($produtos[0] != null)
    {
        foreach ($produtos as $key => $value)
        {
            echo "<div class='item_produto'>";
            echo "<img src='../".$value->getImagem()->getCaminho()."'/>";
            echo "<p>".$value->getNome().", ".$value->getPeso().", Quantidade em estoque: ".$value->getQuantidade().", ".$value->getCategoria()->getNome()."</p>";
            echo "<div class='dado_preco'>R$".$value->getPreco()."</div>";
            echo "<div class='dado_validade'>".date('d/m/Y', $value->getValidade())."</div>";
            echo "<div class='dado_descricao'>".$value->getDescricao()."</div>";
            echo "<input type='button' value='Editar' class='btn' onclick='editarProduto(".$value->getId().")'/><br><br>";
            echo "<input type='button' value='Excluir' class='btn' onclick='excluirProduto(".$value->getId().")'/>";
            echo "</div>";
        }
    }
    else
    {
        echo "<p id='filtro_s_r'>".$msg."</p>";
    }

?>
