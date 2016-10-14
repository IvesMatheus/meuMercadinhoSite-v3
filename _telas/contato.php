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
        $produtos = "<li><a href='produtos.php'>produtos</a></li>";
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
                        <li><a href="contato.php">Contato</a></li>
                         <li><a href="<?= $href_login ?>"><?= $a_login ?></a></li>
                        <?= $produtos ?>

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
                <h2>Cadastre seu Mercadinho  agora!</h2>
                     <p style="text-align:justify">Entre em contato conosco para cadastrar seu mercadinho. Após o cadastro, lhe enviaremos as instruções para habilitar seu mercadinho. Sinta-se à vontade. Nos ligue ou mande email.</p>

                     <p>
                    (11) 9275-7552</p>
                    <p>contato@raimak.com.br</p>

    </div>



       <footer id="rodape">

            &copy; Copyright 2016 - by RAIMAK<br><br>
           <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a>
        </footer>






    </body>
</html>
