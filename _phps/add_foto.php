<?php
    include_once "../_dao/ImagemDAO.php";
    session_start();

    $img = new Imagem($_POST["id_imagem"], "", null);

    $imagemDAO = new ImagemDAO();
    $imagem = $imagemDAO->listarPorId($img);
    $_SESSION["imagens"] = array(0 => $imagem);
    $_SESSION["imagem_atual"] = 0;

    $caminho = '';
    if($imagem != null)
    {
        $caminho = "../".$imagem->getCaminho();
        $_SESSION["categoria_s"] = $imagem->getCategoria();
    }

    echo "<img id='imagem' src='".$caminho."'/>
        <figcaption>Adicionar imagem</figcaption>
        <input id='prev' type='button' class='btn' onclick='mudaFoto(-1)'/>
        <input id='next' type='button' class='btn' onclick='mudaFoto(1)'/>";
?>
