<?php
    include_once "../_dao/ProdutoDAO.php";
    session_start();

    $mercado = null;
    if(isset($_SESSION["mercado"]))
        $mercado = $_SESSION["mercado"];

    if($mercado != null)
    {
        $href_login = "perfil.php";
        $a_login = "perfil";
        $li_produtos = "<li><a href='produtos.php'>produtos</a></li>";

        $produtoDAO = new ProdutoDAO();
        $produtos = $produtoDAO->listarPorMercado($mercado);

        if($produtos[0] != null)
        {
            $p_id = "com_produto";
            $div_id = "c_produto";
        }
        else
        {
            $p_id = "sem_produto";
            $div_id = "s_produto";
        }

        if(isset($_SESSION["add_produtos"]))
        {
            $_SESSION["add_produtos"] = FALSE;
        }
    }
    else
    {
        /*
        $href_login = "login.php";
        $a_login = "login";
        $produtos = "";
        */

        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="../_css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/formulario.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/teste.css"/>                                                                                                                                               
    </head>
    <body>
        <div id="">

        <!-- ######################## Main Menu ######################## -->
         <nav id="menu2">
                <div id="1" style="background:rgb(0,0,0); height:80px" >
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="contato.php">Contato</a></li>
                         <li><a href="<?= $href_login ?>"><?= $a_login ?></a></li>
                        <?= $li_produtos ?>
                    </ul>
                    
                </div>
                
        </nav>

        <!-- ######################## Header ######################## -->
        
        <header style="background-image: url(../_imagens/fundo-laranja.png);">
             <img src="../_imagens/logo.png" width="30%" style="margin-left: 450px;margin-bottom:-30px">
              <h2 class="boas_vindas">meuMercadinho! Suas compras em um clique.</h2>    
        </header>

        <!--
            <nav id="navegacao">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li>&gt;</li>
                    <li>Produtos</li>
                </ul>
            </nav>-->
            <p id="<?= $p_id ?>" >
                Você não possui nenhum produto cadastrado ainda. Comece a montar seu mercado<br>
                <a id="aqui" href="add_produtos.php">[AQUI]</a>
            </p>
            <div id="<?= $div_id ?>">
                <div id="categorias">
                    <input type="button" class="btn" value="Adicionar Produtos" onclick="addProduto()"/>
                    <h1>Categorias</h1>
                    <?php
                        if($produtos[0] != null)
                        {
                            $categoriaDAO = new CategoriaDAO();
                            $categorias = $categoriaDAO->listar();

                            foreach ($categorias as $key => $value)
                                echo "<div id='item".$key."' class='item_categoria' onclick='filtraProdutoPorCategoria(".$value->getId().", item".$key.")'>".$value->getNome()."</div>";
                        }
                    ?>
                </div>
                <div id="produtos">
                    <div id="filtro">
                        <input id="nome_produto" type="text" class="txt_extra_grande"/>
                        <input id="search" type="button" class="btn" onclick="filtrarProdutoPorNome()"/>
                    </div>
                    <div id="itens">
                        <?php
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
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer id="rodape">
       
            &copy; Copyright 2016 - by RAIMAK<br><br>
            <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a> 
        </footer>
        <script language="javascript" src="../_js/produtos.js"></script>
    </body>
</html>
