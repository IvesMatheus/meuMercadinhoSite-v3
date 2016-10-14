<?php

    include_once "../_dao/PedidoDAO.php";

    //$cliente_array = json_decode($_POST["cliente"], true);
    $cliente = new Cliente();
    $cliente->setId(2);

    $pedidoDAO = new PedidoDAO();
    $pedidos = $pedidoDAO->listar();

    $ponto_entrega = new PontoEntrega();
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
