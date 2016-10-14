<?php

    include_once "../_dao/MercadoDAO.php";

    $mercadoDAO = new MercadoDAO();
    $mercados = $mercadoDAO->listar();

    $aux = array(0 => null);
    $i = 0;
    foreach ($mercados as $key => $value)
    {
        $aux[$i] = $value->toArray();
        $i++;
    }

    echo json_encode($aux);
?>
