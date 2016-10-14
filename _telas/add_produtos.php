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

        if(!isset($_SESSION["alt_produto"]) || $_SESSION["alt_produto"] == null)
        {
            $v_btn_add = "Adicionar produto";
            $v_btn_lim = "Limpar campos";
            $btn_onclick_add = "carregarVisualizador(1)";
            $btn_onclick_lim = "";
            $v_nome = "";
            $v_quantidade = "";
            $v_peso = "";
            $v_preco = "";
            $v_validade = "";
            $v_categoria = 0;
            $v_descricao = "";
        }
        else
        {
            $produto = $_SESSION["add_produtos"][$_SESSION["id_alt"]];
            if($produto != null &&  $produto->getCategoria() != null)
            {
                $v_btn_add = "Alterar produto";
                $v_btn_lim = "Cancelar";
                $btn_onclick_add = "btnAlterar(".$_SESSION["id_alt"].")";
                $btn_onclick_lim = "onclick='btnCancelar()'";

                $v_nome = $produto->getNome();
                $v_quantidade = $produto->getQuantidade();
                $v_peso = $produto->getPeso();
                $v_preco = $produto->getPreco();
                $v_validade = date('d/m/Y', $produto->getValidade());
                $v_categoria = $produto->getCategoria()->getId();
                $v_descricao = $produto->getDescricao();
            }
            else
            {
                $v_btn_add = "Adicionar produto";
                $v_btn_lim = "Limpar campos";
                $btn_onclick_add = "carregarVisualizador(1)";
                $btn_onclick_lim = "";
                $v_nome = "";
                $v_quantidade = "";
                $v_peso = "";
                $v_preco = "";
                $v_validade = "";
                $v_categoria = 0;
                $v_descricao = "";
            }
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
                       <li><a href="../index.php">home</a></li>
                        <li><a href="<?= $href_login ?>"><?= $a_login ?></a></li>
                        <?= $li_produtos ?>
                    </ul>
                    
                </div>
                
        </nav>

        <!-- ######################## Header ######################## -->
        
        <header style="background-image: url(../_imagens/fundo-laranja.png);">
             <img src="../_imagens/logo.png" width="30%" style="margin-left: 450px;margin-bottom:-40px">
              <h2 class="boas_vindas">meuMercadinho! Suas compras em um clique.</h2>    
        </header>
       <!--     <nav id="navegacao">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li>&gt;</li>
                    <li><a href="produtos.php">Produtos</a><li>
                    <li>&gt;</li>
                    <li>Adicionar Produtos</li>
                </ul>
            </nav>-->

            
            <div id="add_produto">
                <div id="formulario">
                    <form>
                        <div id="add_imagem">
                            <figure id="img_produto">
                                <img id="imagem" src=""/>
                                <figcaption>Adicionar imagem</figcaption>
                                <input id="prev" type="button" class="btn" onclick="mudaFoto(-1)"/>
                                <input id="next" type="button" class="btn" onclick="mudaFoto(1)"/>
                            </figure>
                            <input id="procurar_imagem" type="button" value="procurar imagem" class="btn" onclick="addImagem()"/>
                        </div>
                        <div id="inputs">
                            <label for="nome">Nome:</label><br>
                            <input id="nome" name="nome" type="text" class="txt_medio" value="<?= $v_nome ?>"/><br>
                            <label for="quantidade">Quantidade:</label><br>
                            <input id="quantidade" name="quantidade" type="number" min="1" class="txt_pequeno" value="<?= $v_quantidade ?>"/><br>
                            <label for="peso">Peso:</label><br>
                            <input id="peso" name="peso" type="text" class="txt_pequeno" placeholder="10 gm ou 10 kg" value="<?= $v_peso ?>"/><br>
                            <label for="preco">Preço:</label><br>
                            <input id="preco" name="preco" type="text" class="txt_pequeno" value="<?= $v_preco ?>"/><br>
                        </div>
                        <div id="r_inputs">
                            <label for="validade">Validade:</label><br>
                            <input id="validade" name="validade" type="date" class="txt_medio" value="<?= $v_validade ?>"/><br>
                            <label for="categoria">Categoria:</label><br>
                            <select id="categoria" name="categoria" onchange="carregaFoto()">
                                <option></option>
                                <?php
                                    $categoriaDAO = new CategoriaDAO();
                                    $categorias = $categoriaDAO->listar();

                                    foreach ($categorias as $key => $value)
                                    {
                                        if($v_categoria != "")
                                        {
                                            if($value->getId() == $v_categoria)
                                                $s = "selected='true'";
                                            else
                                                $s = "";
                                        }
                                        else
                                            $s = "";

                                        echo "<option value='".$value->getId()."' ".$s.">".$value->getNome()."</option>";
                                    }
                                ?>
                            </select>
                            <br>
                            <label for="descricao">Descrição:</label><br>
                            <textarea id="descricao" name="descricao" type="text" rows="5" cols="48"><?= $v_descricao ?></textarea><br>
                            <div id="op_form">
                            <input id="btn_add" type="button" value="<?= $v_btn_add ?>" class="btn" onclick="<?= $btn_onclick_add ?>"/>
                                <input type="reset" value="<?= $v_btn_lim ?>" class="btn" <?= $btn_onclick_lim ?>/><br>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="visualizar">
                    <div id="prototipo_produto">
                        <?php
                            if(isset($_SESSION["add_produtos"]))
                            {
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
                            }
                        ?>
                    </div>
                    <div id="add_menu">
                        <input type="button" class="btn" value="Finalizar" onclick="finalizar()"/>
                    </div>
                </div>
            </div>
            <div class="direita">
                <input id="up" type="button" class="btn" onclick="subirTela()"/>
            </div>
        </div>
        <footer id="rodape">
            &copy; Copyright 2016 - by RAIMAK<br>
            Facebook | Twitter
        </footer>
        <script language="javascript" src="../_js/add_produto.js"></script>
    </body>
</html>
