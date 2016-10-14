<?php
    include "../_model/Produto.php";
    include "../_model/Imagem.php";
    include "../_dao/CategoriaDAO.php";
    session_start();

    if(!isset($_SESSION["add_produtos"]))
    {
        $produtos = array();
        $_SESSION["add_produtos"] = $produtos;
        $_SESSION["id_add_produtos"] = 0;
        $_SESSION["salvar_produto"] = true;
    }

    $id = $_SESSION["id_add_produtos"];
    $produtos = $_SESSION["add_produtos"];

    if($_POST["status"] == 1)
    {
        $imagem = $_SESSION["imagens"][$_SESSION["imagem_atual"]];
        //echo $imagem

        $dia = substr($_POST["validade"], 0, 2);
        $mes = substr($_POST["validade"], 3, 2);
        $ano = substr($_POST["validade"], 6, 4);

        $validade = mktime(23, 59, 58, $mes, $dia, $ano);

        $produto = new Produto($_POST["nome"], $_POST["peso"], $validade, $_POST["quantidade"], $_POST["preco"], $imagem, CategoriaDAO::listarPorId(new Categoria($_SESSION["categoria_s"], "", "", "")), $_POST["descricao"], $_SESSION["mercado"]);

        $produtos[$id] = $produto;
        $_SESSION["id_add_produtos"] = $id + 1;
        $_SESSION["add_produtos"] = $produtos;
    }
    else if($_POST["status"] == 2)
    {
        $produto = new Produto($_POST["nome"], $_POST["peso"], $_POST["validade"], $_POST["quantidade"], $_POST["preco"], new Imagem($_POST["imagem"], null), CategoriaDAO::listarPorId(new Categoria($_POST["categoria"], "", "", "")), $_POST["descricao"], $_SESSION["mercado"]);

        $produtos[$_POST["id"]] = $produto;
        $_SESSION["add_produtos"] = $produtos;

        $_SESSION["alt_produto"] = FALSE;
        $_SESSION["id_alt"] = FALSE;
    }

    if($_SESSION["add_produtos"] != FALSE)
    {
        foreach ($_SESSION["add_produtos"] as $key => $value)
        {
            if($value != null)
            {
                if($value->getCategoria() != null)
                {
                    echo "<div class='v_item_produto'>";
                    echo "<img src='../".$value->getImagem()->getCaminho()."'/>";
                    echo "<p>".$value->getNome().", ".$value->getPeso().", Quantidade em estoque: ".$value->getQuantidade().", ".$value->getCategoria()->getNome()."</p>";
                    echo "<div class='dado_preco'>R$".$value->getPreco()."</div>";
                    echo "<div class='dado_validade'>".date('d/m/Y', $value->getValidade())."</div>";
                    echo "<div class='dado_descricao'>".$value->getDescricao()."</div>";
                    echo "<input type='button' value='Editar' class='btn' onclick='btnClick(".$key.", 0)'/><br><br>";
                    echo "<input type='button' value='Retirar' class='btn' onclick='btnClick(".$key.", 1)'/>";
                    echo "</div>";
                }
            }
        }
    }
?>
