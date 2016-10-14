<?php

    include_once "../_dao/ItemPedidoDAO.php";

    //Recupera todos os itens em formato json e decodifica num super array
    $itensPedido_array = json_decode($_POST["itens"], true);

    //cria um array que serÃ¡ responsÃ¡vel por conter os objetos de ItemPedido a serem salvos
    $itensPedido = array();
    $i = 0;
    foreach ($itensPedido_array as $key => $item)
    {
        //Cria um pedido contendo o id
        $pedido = new Pedido();
        $pedido->setId($item["pedido"]["id"]);

        echo $pedido->getId();

        //Cria um produto contendo o id
        $produto = new Produto();
        $produto->setId($item["produto"]["id"]);

        //Cria um objeto de ItemPedido com os valores correspondentes e add no array
        $itemPedido = new ItemPedido($pedido, $produto, $item["quantidade"]);
        $itensPedido[$i] = $itemPedido;
        $i++;
    }

    //Salva os itens de pedido e recupera o valor do commit
    $itemPedidoDAO = new ItemPedidoDAO();
    $aux = $itemPedidoDAO->inserir($itensPedido);

    $mercado = new Mercado();
    $categoria = new Categoria();
    $imagem = new Imagem();
    $imagem->setCategoria($categoria);
    $produto->setMercado($mercado);
    $produto->setCategoria($categoria);
    $produto->setImagem($imagem);

    $cliente = new Cliente();
    $ponto_entrega = new PontoEntrega();
    $ponto_entrega->setCliente($cliente);
    $pedido = new Pedido();
    $pedido->setCliente($cliente);
    $pedido->setPontoEntrega($ponto_entrega);
    $pedido->setMercado($mercado);

    //Cria um objeto ItemPedido contendo o resultado do commit no campo de quantidade
    $retorno = new ItemPedido($pedido, $produto, ( ( $aux ) ? 1 : 0 ));
    //Decodifica no formato json e envia para a app
    echo json_encode($retorno->toArray());

?>
