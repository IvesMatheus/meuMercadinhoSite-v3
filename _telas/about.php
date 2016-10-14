<?php
    include_once "../_model/Mercado.php";
    session_start();

    $mercado = null;
    if(isset($_SESSION["mercado"]))
        $mercado = $_SESSION["mercado"];

    if($mercado != null)
    {
        $href_login = "_telas/perfil.php";
        $a_login = "perfil";
        $produtos = "<li><a href='_telas/produtos.php'>produtos</a></li>";
    }
    else
    {
        $href_login = "login.php";
        $a_login = "login";
        $produtos = "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>

        <link rel="stylesheet" type="text/css" href="../_css/formulario.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/teste.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="../_css/responsive.css"/>


    </head>
    <body>
    <!-- ######################## Main Menu ######################## -->
         <nav id="menu2">
                <div id="1" style="background:rgb(0,0,0); height:80px" >
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contato.php">Contato</a></li>
                        <li><a href="<?= $href_login ?>"><?= $a_login ?></a></li>
                        <?= $produtos ?>
                    </ul>

                </div>

        </nav>

        <!-- ######################## Header ######################## -->

        <header>
              <img class="logo" src="../_imagens/logo.png" >
              <h2 class="boas_vindas">meuMercadinho! Suas compras em um clique.</h2>
        </header>


      <h2 style="text-align:center; color: #333;color: #222;
    font-family: 'Helvetica Neue';font-style: normal;line-height: 1.1;margin-bottom: 14px;margin-top:14px;margin-bottom:30px">Tudo em apenas alguns clicks!</h2>

     <div id="informativo1">
                <h2>Sobre meuMercadinho</h2>
                <p>O meuMercadinho é um aplicativo que tem como objetivo facilitar a logística de venda dos mercadinhos, onde cliente e mercado ganhem. O cliente é beneficiado com a comodidade, facilidade, segurança e rapidez ao realizar suas compras, e o mercadinho é beneficiado com facilidade em receber a lista de produtos e o endereço, além do interesse dos clientes em comprar em seu estabelecimento.</p>

    </div>

    <div id="informativo2">
            <h2>Sobre a RAIMAK</h2>

                <p>A RAIMAK é uma empresa de desenvolvimento de software que busca oferecer soluções inovadoras e significativas para a sociedade. A missão da RAIMAK é desenvolver produtos acessíveis, com exclusividade e qualidade, atendendo aos mercadinhos de vizinhança, proporcionando conforto e comodidade aos seus clientes.</p>

               <a href="contato.php">Entre em contato conosco!</a>
    </div>

       <footer id="rodape">

            &copy; Copyright 2016 - by RAIMAK<br><br>
            <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a>
        </footer>






    </body>
</html>
