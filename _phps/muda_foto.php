<?php
    include_once "../_model/Imagem.php";
    session_start();

    $caminho = '../';
    if(isset($_SESSION["imagens"]))
    {
        if($_SESSION["imagens"][0] != null)
        {
            $imagens = $_SESSION["imagens"];

            if(isset($imagens[$_SESSION["imagem_atual"] + $_POST["op"]]))
            {
                $caminho .= trim($imagens[$_SESSION["imagem_atual"] + $_POST["op"]]->getCaminho());
                $_SESSION["imagem_atual"] += $_POST["op"];
            }
            else
            {
                $caminho .= trim($imagens[($_POST["op"] == 1? 0 : count($imagens) - 1)]->getCaminho());
                $_SESSION["imagem_atual"] = ($_POST["op"] == 1? 0 : count($imagens) - 1);
            }
        }
    }

    echo "<img id='imagem' src='".$caminho."'/>
        <figcaption>Adicionar imagem</figcaption>
        <input id='prev' type='button' class='btn' onclick='mudaFoto(-1)'/>
        <input id='next' type='button' class='btn' onclick='mudaFoto(1)'/>";
?>
