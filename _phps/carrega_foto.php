<?php
    include_once "../_dao/ImagemDAO.php";
    session_start();

    $categoria = new Categoria($_POST["categoria"], "", "", "");
    $_SESSION["categoria_s"] = $categoria;

    $imagemDAO = new ImagemDAO();
    $imagens = $imagemDAO->listarPorCategoria($categoria);
    $_SESSION["imagens"] = $imagens;
    $_SESSION["imagem_atual"] = 0;

    $caminho = '';
    if($imagens[0] != null)
        $caminho = "../".$imagens[0]->getCaminho();

    echo "<img id='imagem' src='".$caminho."'/>
        <figcaption>Adicionar imagem</figcaption>
        <input id='prev' type='button' class='btn' onclick='mudaFoto(-1)'/>
        <input id='next' type='button' class='btn' onclick='mudaFoto(1)'/>";
?>
