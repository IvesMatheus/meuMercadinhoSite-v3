<?php
    include "Compra.php";
    include "Cliente.php";
    include "PontoEntrega.php";
    include "Produto.php";
    include "ItemCompra.php";

    $cli = new Compra(1, 0, 0, Compra::$DINHEIRO, new Cliente(1, "teste", "teste", "teste"), new PontoEntrega(1, "teste", "teste", "teste", 0, "teste", new Cliente(1, "teste", "teste", "teste")), 0, true, "teste", Compra::$PEDIDO_FEITO);

    $itc = new ItemCompra();

    echo $itc;
?>
