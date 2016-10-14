<?php
    include_once "../_dao/ProdutoDAO.php";
    include_once "../_dao/ImagemDAO.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>meuMercadinho</title>
        <link rel="stylesheet" type="text/css" href="../_css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/formulario.css"/>
    </head>
    <body id="corpo_imagem">
        <div id="filtro">
            <select id="categoria" name="categoria" onchange="filtraImagens()" class="text_extra_grande">
                <?php
                    $categoriaDAO = new CategoriaDAO();
                    $categorias = $categoriaDAO->listar();

                    foreach ($categorias as $key => $value)
                        echo "<option value='".$value->getId()."' ".$s.">".$value->getNome()."</option>";
                ?>
            </select>
            <input type="button" value="Filtrar" class="btn" onclick="filtrarImagens()"/>
        </div>
        <div id="imagens">
            <?php
                $imagemDAO = new ImagemDAO();
                $imagens = $imagemDAO->listar();

                foreach ($imagens as $key => $value)
                {
                    echo "<div id='item_imagem'>";
                    echo "<img src='../".$value->getCaminho()."' ondblclick='selecionar(".$value->getId().")'/>";
                    echo "<input type='button' value='Selecionar' class='btn' onclick='selecionar(".$value->getId().")'/>";
                    echo "</div>";
                }
            ?>
        </div>
        <script language="javascript" src="../_js/imagens.js"></script>
    </body>
</html>
