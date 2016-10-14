<?php

    /*
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
    error_reporting(E_ALL);
    */

    /*
    $content = http_build_query(array(
        'to' => "cy70lYjjHOc:APA91bG-xxtMEnH6z1PesCpDBt9RNkjiL9NvoO1my_2bl1iU0P9zMLVdD0kVpZd8b-xEYfXwftgbK8kBuKmZWI-U8Xsvuxe_Uu-HIttLNk4kAXytRrE-o6IiiAWam2TMs5gDMiPubYV5",
        'notification' => array(
            'body' => 'great match!',
            'title' => 'Portugal vs. Denmark'
        )
    ));

    $context = stream_context_create(array(
        'http' => array(
            'method'  => 'POST',
            'header'  => array("Content-Type:appliction/json",
                         "Authorization:key=AIzaSyDWQ3MKV9tt3DfKmVwbY4-ZEHFdFEXy56I"),
            'content' => $content
        )
    ));

    $result = file_get_contents('http://fcm.googleapis.com/fcm/send', null, $context);
    echo $result;
    */

        $msg = array
        (
            'title'   => 'teste',
            'from_msg'    => 'servidor',
            'body_msg'    => 'libera_pedido'
        );

        $fields = array
        (
            'to'              => 'cDlILAFoc8A:APA91bGz5lY5rZMKj67UEP-ohIkZd_3PKpbiV1zLeoLxgXv8vbJBA_Fuubda4f2JmUrkMvw5JL4kiY2JUXL5_fsRsPZypWbT2eemcFvXKi-syGadHPW4uY76nKSsXXj7BhUuhyEIsZVR',
            'title'   => 'teste',
            'body'    => 'ives',
            'data'            => $msg
        );

        $headers = array
        (
            'Authorization: key=AIzaSyDWQ3MKV9tt3DfKmVwbY4-ZEHFdFEXy56I',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        //echo $result;
?>
