<?php

    include_once "../_dao/PontoEntregaDAO.php";

    $pontoEntregaDAO = new PontoEntregaDAO();
    $pontoEntregas = $pontoEntregaDAO->listar();

    $pontoEntrega = new PontoEntrega();
    $pontoEntrega->setCliente(new Cliente);

    $aux = array(0 => $pontoEntrega->toArray());
    $i = 0;

    if($pontoEntregas[0] != null)
    {
        foreach ($pontoEntregas as $key => $value)
        {
            $aux[$i] = array( "pont" => $value );
            $i++;
        }
    }

    echo json_encode($aux);

?>
