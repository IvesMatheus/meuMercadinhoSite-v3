<?php

    include_once "../_dao/PontoEntregaDAO.php";

    //Pega o json vindo do celular e transforma num array
    $ponto_entrega = json_decode($_POST["ponto_entrega"], true);
    //Cria um objeto de ponto de entrega com os dados do array
    $pontoEntrega = new PontoEntrega(
                                $ponto_entrega["nome"],
                                $ponto_entrega["rua"],
                                $ponto_entrega["bairro"],
                                $ponto_entrega["numero"],
                                $ponto_entrega["complemento"],
                                new Cliente($ponto_entrega["cliente"]["id"], '', '', '')
                            );

    //Inseri o ponto de entrega no BD
    $pontoEntregaDAO = new PontoEntregaDAO();
    $pontoEntregaDAO->inserir($pontoEntrega);

    //Carrega um objeto de ponto entrega contendo o id do ponto de entrega recém cadastrado para envio a app
    $retorno = $pontoEntregaDAO->ultimoId();
    echo json_encode($retorno->toArray());

?>
