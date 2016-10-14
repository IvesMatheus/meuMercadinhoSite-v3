<?php
    include_once "_model/Mercado.php";
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
        $href_login = "_telas/login.php";
        $a_login = "login";
        $produtos = "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>meuMercadinho</title>
        <meta charset="utf-8"/>
     
        <link rel="stylesheet" type="text/css" href="_css/formulario.css"/>
        <link rel="stylesheet" type="text/css" href="_css/teste.css"/>
        <link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
        <link rel="stylesheet" type="text/css" href="_css/responsive.css"/>
        
    </head>
    <body>
    <!-- ######################## Main Menu ######################## -->
         <nav id="menu2">
                <div id="1" style="background:rgb(0,0,0); height:80px;" >
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="_telas/about.php">About</a></li>
                        <li><a href="_telas/contato.php">Contato</a></li>
                        <li><a href="<?= $href_login ?>"><?= $a_login ?></a></li>
                        <?= $produtos ?>
                    </ul>
                    
                </div>
                
        </nav>

        <!-- ######################## Header ######################## -->
        
        <header>
             <img class="logo" src="_imagens/logo.png" >
              <h2 class="boas_vindas">meuMercadinho! Suas compras em um clique.</h2>    
        </header>
       <!-- 

      <h2 style="text-align:center; color: #333;color: #222;
    font-family: 'Helvetica Neue';font-style: normal;line-height: 1.1;margin-bottom: 14px;margin-top:14px;margin-bottom:30px">Tudo em apenas alguns clicks!</h2>
      -->
     <div id="informativo1">
                <h2>Consumidores</h2>

                <p>Em casa, no trabalho, na rua... com o meuMercadinho você faz as suas compras pelo celular, em qualquer lugar!<p>
                 <p>  meuMercadinho é o aplicativo que oferece conforto e facilidade nas suas compras. Com o meuMErcadinho você pode realizar suas compras em qualquer lugar. Basta baixar o aplicativo, escolher o mercadinho mais proximo de você, selecionar os produtos que você quer comprar e pronto!<p>
    </div>
      
    <div id="informativo2">
            <h2>Mercados</h2>

                <p>O seu mercadinho virtual!

                Os seus produtos em uma loja virtual. no meuMercadinho você tem um espaço virtual, onde oferece os seus produtos pelo aplicativo. Você recebe a lista de pedidos e o endereço de entrega. É muito prático!
                Cadastre-se e encontre o pacote que oferece o que você procura.</p>

               <a href="_telas/contato.php">Entre em contato conosco!</a>
    </div> 

       <footer id="rodape" >
       <!--
        <hr style="width:70%; background-color:#FF8C00;"> 
            &copy; Copyright 2016 - by RAIMAK<br>
            Facebook | Twitter-->

             &copy; Copyright 2016 - by RAIMAK<br><br>
             <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a>    
           </footer>

  
     
      
      

    </body>
</html>
