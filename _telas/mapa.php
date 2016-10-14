<?php
    include_once "../_model/Mercado.php";
    session_start();

    $mercado = null;
    if(isset($_SESSION["mercado"]))
        $mercado = $_SESSION["mercado"];

    if($mercado != null)
    {
        $href_login = "perfil.php";
        $a_login = "perfil";
        $li_produtos = "<li><a href='produtos.php'>produtos</a></li>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <style type="text/css">
            html, body { height: 100%; margin: 0; padding: 0; }
            #map { height: 100%; }
        </style>
    </head>
    <body onload="initMap(<?= $mercado->getLatitude() ?>, <?= $mercado->getLongitude() ?>)">
        <div id="map">
        </div>
        <script type="text/javascript">
            function initMap(latt, long)
            {
                var map;
                map = new google.maps.Map(document.getElementById('map'),
                {
                    center: {lat: latt, lng: long},
                    zoom: 8
                });
            }
        </script>
        <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGl8ZQSSA54_tdBo1JfMqqH0DFp3leDDs&callback=initMap">
        </script>
    </body>
</html>
