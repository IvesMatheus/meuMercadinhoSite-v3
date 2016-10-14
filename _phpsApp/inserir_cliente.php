<?php

    include_once "../_dao/ClienteDAO.php";

    //recupera o cliente no formato json e decodifica num array
    $cliente_array = json_decode($_POST["cliente"], true);
    //cria um objeto de Cliente com os dados contidos no array
    $cliente = new Cliente(
                $cliente_array["nome"],
                $cliente_array["login"],
                $cliente_array["senha"]
    );

    //inseri cliente no banco
    $clienteDAO = new ClienteDAO();
    $clienteDAO->inserir($cliente);

    //carrega o id do cliente recem cadastrado num objeto Cliente e retorna a app no formato json
    $retorno = $clienteDAO->ultimoId();
    echo json_encode($retorno->toArray());

?>
