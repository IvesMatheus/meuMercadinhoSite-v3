<?php
    include_once "../_dao/MercadoDAO.php";
    session_start();

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    $mercado = new Mercado('', '', '', '', '', '', '', '', '', '', '', '', '', '', $login, $senha);

    $mercadoDAO = new MercadoDAO();

    $_SESSION["mercado"] = $mercadoDAO->verificaLogin($mercado);

    $url = "../";
    if($_SESSION["mercado"] != null)
        $url .= "_telas/perfil.php";
    else
        $url .= "_telas/login.php";

    header("Location: ".$url);
?>
