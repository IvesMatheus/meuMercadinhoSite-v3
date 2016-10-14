<?php
    session_start();
    if(isset($_SESSION["mercado"]))
        $_SESSION["mercado"] = FALSE;
    if(isset($_SESSION["add_produtos"]))
        $_SESSION["add_produtos"] = FALSE;
    if(isset($_SESSION["id_add_produtos"]))
        $_SESSION["id_add_produtos"] = FALSE;
    if(isset($_SESSION["salvar_produto"]))
        $_SESSION["salvar_produto"] = FALSE;
    if(isset($_SESSION["alt_produto"]))
        $_SESSION["alt_produto"] = FALSE;
    if(isset($_SESSION["id_alt"]))
        $_SESSION["id_alt"] = FALSE;
    if(isset($_SESSION["edt_prod"]))
        $_SESSION["edt_prod"] = FALSE;
    if(isset($_SESSION["imagens"]))
        $_SESSION["imagens"] = FALSE;
    if(isset($_SESSION["imagem_atual"]))
        $_SESSION["imagem_atual"] = FALSE;
    header("Location: ../index.php");
?>
