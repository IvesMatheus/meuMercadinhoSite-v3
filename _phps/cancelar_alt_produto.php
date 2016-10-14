<?php
    session_start();

    $_SESSION["alt_produto"] = FALSE;
    $_SESSION["id_alt"] = FALSE;

    header("Location: ../_telas/add_produtos.php");
?>
