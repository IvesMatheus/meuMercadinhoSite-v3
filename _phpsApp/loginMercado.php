<?php

    include_once "../_dao/MercadoDAO.php";

    $mercado_array = json_decode($_POST["mercado"], true);

    $mercado = new Mercado();
    $mercado->setLogin($mercado_array["login"]);
    $mercado->setSenha($mercado_array["senha"]);
    $mercado->setTokenId($mercado_array["token_id"]);

    $mercadoDAO = new MercadoDAO();
    $new_mercado = $mercadoDAO->login($mercado);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode( $new_mercado->toArray() );

?>
