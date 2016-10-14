function addProduto()
{
    window.location = "../_telas/add_produtos.php";
}

function filtraProdutoPorCategoria(categoria, item)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("itens").innerHTML = xhttp.responseText;
        }
    };

    xhttp.open("POST", "../_phps/filtrar_produtos.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("categoria="+categoria);;
}

function filtrarProdutoPorNome()
{
    var nome = document.getElementById("nome_produto").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("itens").innerHTML = xhttp.responseText;
        }
    };

    xhttp.open("POST", "../_phps/filtrar_produtos.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("nome="+nome);
}

function editarProduto(produto)
{
    window.location = "../_phps/edicao_produto.php?produto=" + produto + "&op=1";
}

function excluirProduto(produto)
{
    window.location = "../_phps/edicao_produto.php?produto=" + produto + "&op=2";
}

/*
button = document.getElementById("add_produto");
button.onclick = function ()
{
    window.location = "../_telas/add_produto.php";
}
*/
