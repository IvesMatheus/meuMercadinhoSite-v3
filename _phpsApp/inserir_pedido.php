<?php

    include_once "../_dao/PedidoDAO.php";

    //recupera pedido passado pelo app e decodifica o json no formato array
    //$pedido_array = json_decode($_POST["pedido"], true);
    $pedido_array = array('total'=>0, 'troco'=>0, 'forma_pagamento'=>Pedido::$PEDIDO_FEITO, 'cliente'=>array('id'=>2), 'ponto_entrega'=>null, 'entrega'=>0, 'hora_busca'=>0, 'mercado'=>3);
    //cria um objeto cliente com o id passado pelo array
    $cliente = new Cliente($pedido_array["cliente"]["id"], "", "", "");

    $mercado = new Mercado();
    $mercado->setId($pedido_array['mercado']);
    //verifica se o pedido terá entrega. Se tiver cria um objeto ponto entrega, se não retorna null
    $pontoEntrega = ($pedido_array["entrega"]) ? new PontoEntrega($pedido_array["ponto_entrega"], "", "", "", "", "", $cliente) : null;
    //cria um objeto pedido com base nos dados do array.
    $pedido = new Pedido(
                $pedido_array["total"],
                $pedido_array["troco"],
                $pedido_array["forma_pagamento"],
                $cliente,
                $pontoEntrega,
                (!$pedido_array["entrega"]) ? $pedido_array["hora_busca"] : null,
                $pedido_array["entrega"],
                null,
                Pedido::$PEDIDO_FEITO,
                $mercado
    );

    //inseri pedido no banco
    $pedidoDAO = new PedidoDAO();
    $pedidoDAO->inserir($pedido);

    //recupera o id do pedido recém cadastrado e retorna para a app
    $retorno = $pedidoDAO->ultimoId();
    echo json_encode($retorno->toArray());

?>
