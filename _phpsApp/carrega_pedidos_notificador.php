<?php

    include_once "../_dao/PedidoDAO.php";

    $mercado_array = json_decode($_POST["mercado"], true);
    $mercado = new Mercado();
    $mercado->setId($mercado_array["id"]);

    $pedidoDAO = new PedidoDAO();
    $pedidos = $pedidoDAO->listarPorMercado($cliente);

    $ponto_entrega = new PontoEntrega();
    $ponto_entrega->setCliente(new Cliente());
    $mercado = new Mercado();
    $pedido = new Pedido();
    $pedido->setMercado($mercado);
    $pedido->setCliente($cliente);
    $pedido->setPontoEntrega($ponto_entrega);

    $aux = array(0 => $pedido);
    $i = 0;
    foreach ($pedidos as $key => $value)
    {
        $aux[$i] = $value->toArray();
        $i++;
    }

    echo json_encode($aux);

?>
