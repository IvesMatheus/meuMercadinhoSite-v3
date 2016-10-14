<?php
    include_once "../_dao/ImagemDAO.php";
    
    $imagemDAO = new ImagemDAO();
    $imagens = $imagemDAO->listarPorCategoria(new Categoria($_POST["categoria"], '', '', ''));

    if($imagens[0] != null)
    {
        foreach ($imagens as $key => $value)
        {
            echo "<div id='item_imagem'>";
            echo "<img src='../".$value->getCaminho()."' ondblclick=''/>";
            echo "<input type='button' value='Selecionar' class='btn' onclick=''/>";
            echo "</div>";
        }
    }
    else
    {
        echo "<p id='filtro_s_r'>Não há imagens dessa categoria</p>";
    }
?>
