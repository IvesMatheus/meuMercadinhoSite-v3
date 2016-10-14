<?php
    print_r($_GET);

    include_once "../_dao/MercadoDAO.php";
    session_start();

    $mercado_ant = $_SESSION["mercado"];
    $mercado_new = new Mercado($mercado_ant->getId(), $_GET["nome"], $_GET["rua"], $_GET["bairro"], $_GET["numero"], $_GET["complemento"], $_GET["codigo"], $mercado_ant->getLatitude(), $mercado_ant->getLongitude(), $_GET["hora_abertura"], $_GET["hora_encerramento"], $mercado_ant->getLogo(), $_GET["servico_entrega"], $_GET["taxa_entrega"], $_GET["vmc"], $_GET["login"], $_GET["senha"]);

    $mercadoDao = new MercadoDAO();
    $x = $mercadoDao->atualizar($mercado_new);

    if($x)
        $_SESSION["mercado"] = $mercado_new;

    header("Location: ../_telas/perfil.php");
?>
