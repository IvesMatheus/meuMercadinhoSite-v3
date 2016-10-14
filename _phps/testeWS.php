<?php
    include_once "../_dao/ClienteDAO.php";

    $x = array(0=>"a", 1=>"b");
    echo $x;
    echo json_encode($x);
    echo json_decode(json_encode())
?>
