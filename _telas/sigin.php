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
        
        <script  type="text/javascript">
            function exibir() {    
                if (document.getElementById("entrega1").style.display == "block"){
                    document.getElementById("entrega1").style.display = "none";  
                 }
                 else{       
                document.getElementById("entrega1").style.display = "block"; 
         }  
    }
    </script>
    </head>
    <body>
    <!-- ######################## Main Menu ######################## -->
         <nav id="menu2">
                <div id="1" style="background:rgb(0,0,0); height:80px;" >
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="ontato.php">Contato</a></li>
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


       <div id="cadastro">
                <form name="efetua_cadastro" method="POST" action="../_phps/cadastro.php">
                    <div id="mercado">
                        <label for="mercado" class="lbl">Nome do Mercado</label><br>
                        <input name="login" type="text" class="txt_grande"/><br>
                    </div>
                    <div id="endereco_">
                        <div id= "rua">
                            <label for="rua" class="lbl">Rua</label><br>
                            <input name="rua" type="text" class="txt_grande"/><br>
                        </div>
                        <div id="numero">
                            <label for="numero" class="lbl">Numero</label><br>
                            <input name="numero" type="text" class="txt_grande"/><br>
                         </div>
                         <div id="bairro">    
                            <label for="bairro" class="lbl">Bairro</label><br>
                            <input name="bairro" type="text" class="txt_grande"/><br>
                        </div>
                        <div id="complemento">
                            <label for="complemento" class="lbl">Complemento</label><br>
                            <input name="complemento" type="text" class="txt_grande"/><br>
                        </div> 
                    </div>
                    <div >
                            <label for="hora_abertura" class="lbl">Hora de abertura</label><br>
                            <input name="hora_abertura" type="text" class="txt_grande"/><br>
                        </div> 
                    <div >
                            <label for="hora_fechamento" class="lbl">Hora de fechamento</label><br>
                            <input name="hora_fechamento" type="text" class="txt_grande"/><br>
                        </div>     
                    <!-- SE ENTREGA -->
                   
                        <label for="servicoEntrega" class="lbl">Possui serviço de Entrega?</label>
                        <input type="checkbox" name="checkbox" value="checkbox" onclick="exibir()" /><br>
                            <div id="entrega1">
                                <label for="taxaentrega" class="lbl">Taxa de Entrega</label><br>
                                <input name="taxaentrega" type="text" class="txt_grande"/><br>
                                <label for="valor_minimo" class="lbl">Valor mínimo para entrega</label><br>
                                <input name="valor_minimo" type="text" class="txt_grande"/><br>
                            </div>
                    
                    <!--
                    <div id="opcoes">
                        <input type="button" value="Cadastrar" class="btn" onclick=""/>
                        <input type="button" value="Sair" class="btn" onclick="cancelar()"/>
            </div>-->
                   
                  <input type="button" value="Cadastrar" class="btn" onclick=""/>
                </form>
        </div>
      
        
       <footer id="rodape">
       
            &copy; Copyright 2016 - by RAIMAK<br><br>
             <a href="https://www.facebook.com/meuMercadinhoApp">Facebook</a> 
        </footer>
       
  
     
      
      

    </body>
</html>
