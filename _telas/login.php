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
    font-family: 'Helvetica Neue';font-style: normal;line-height: 1.1;margin-bottom: 14px;margin-top:14px;margin-bottom:30px">Área de login</h2>

        <div id="login">
                <form name="efetua_login" method="POST" action="../_phps/verificaLogin.php">
                    <div id="nome">
                        <label for="login" class="lbl">Login</label><br>
                        <input name="login" type="text" class="txt_grande" required name="login" /><br>
                    </div>
                    <div id="senha">
                        <label for="senha" class="lbl">Senha</label><br>
                        <input name="senha" type="password" class="txt_grande" required name="senha" /><br>
                    </div>
                    <div id="entrar">
                        <input name="entrar" type="submit" value="Entrar" class="btn"/>
                    </div>
                    <div id="sign">
                        <a href="sigin.php">Não tem uma conta? Cadastre-se aqui.</a>
                    </div>
                </form>
            </div>

       <footer id="rodape">

            &copy; Copyright 2016 - by RAIMAK<br><br>
             <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a>
        </footer>






    </body>
</html>
