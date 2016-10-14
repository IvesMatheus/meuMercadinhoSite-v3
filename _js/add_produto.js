var dataProperty =
{
    set : function (value)
    {
        var dia, mes, ano;
        if (value)
        {
            dia = value.getDate().toString();
            if (dia.length === 1)
            {
                dia = "0" + dia;
            }
            mes = (value.getMonth() + 1).toString();
            if (mes.length === 1)
            {
                mes = "0" + mes;
            }
            ano = value.getFullYear().toString();

            if (isDateInvert)
            {
                this.value = mes + "/" + dia + "/" + ano;
            }
            else
            {
                this.value = dia + "/" + mes + "/" + ano;
            }
        }
        else
        {
            this.value = "";
        }
    },
    get : function ()
    {
        var valueV;
        var valueTimeStamp;
        var dia, mes, ano;
        try
        {
            valueV = this.value.trim().split("/");
            if(valueV.length === 3)
            {
                if (isDateInvert)
                {
                    dia = valueV[1];
                    mes = valueV[0];
                    ano = valueV[2];
                }
                else
                {
                    dia = valueV[0];
                    mes = valueV[1];
                    ano = valueV[2];
                }

                if (dia.length === 1)
                {
                    dia = "0" + dia;
                }
                if (mes.length === 1)
                {
                    mes = "0" + mes;
                }
                valueTimeStamp = Date.parse(ano + '-' + mes + '-' + dia);
                if (isNaN(valueTimeStamp))
                {
                    return null;
                }
                else
                {
                return new Date(parseInt(ano), (parseInt(mes) - 1), parseInt(dia));
                }
            }
            else
            {
                return null;
            }
        }
        catch(err)
        {
            return null;
        }
    }
}

if (HTMLInputElement.prototype.valueAsDate === undefined)
{
    Object.defineProperty(HTMLInputElement.prototype, 'valueAsDate', dataProperty);
}

var isDateInvert = (function()
{
    var lang = window.navigator.userLanguage || window.navigator.language;
    if (lang.substring(0,2) === "en")
    {
        return true;
    }
    else
    {
        return false;
    }
})();

if (Date.prototype.toLocaleDateString === undefined)
{
    Date.prototype.toLocaleDateString = function()
    {
        if (isDateInvert)
        {
            return (this.getUTCMonth() + 1) + "/" + this.getUTCDate() + "/" + this.getFullYear();
        }
        else{
            return this.getUTCDate() + "/" + (this.getUTCMonth() + 1) + "/" + this.getFullYear();
        }
    }
}

if (Date.prototype.toLocaleString === undefined)
{
    Date.prototype.toLocaleString = function()
    {
        return this;
    }
}

nome = document.getElementById("nome");
quantidade = document.getElementById("quantidade");
peso = document.getElementById("peso");
preco = document.getElementById("preco");
validade = document.getElementById("validade");
categoria = document.getElementById("categoria");
descricao = document.getElementById("descricao");
imagem = document.getElementById("imagem");

function btnClick(id, op)
{
    window.location = "../_phps/alterar_novo_produto.php?id=" + id + "&op=" + op;
}

function carregarVisualizador(status)
{
    if(verificaCampos())
    {
        preco_correto = preco.value.replace(",", ".");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (xhttp.readyState == 4 && xhttp.status == 200)
            {
                document.getElementById("prototipo_produto").innerHTML = xhttp.responseText;
            }
        };

        xhttp.open("POST", "../_phps/visualizar_produto.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("status="+status+"&nome=" + nome.value + "&quantidade=" + quantidade.value + "&peso=" + peso.value +     "&preco=" + preco_correto + "&validade=" + validade.valueAsDate.toLocaleDateString() + "&categoria=" + categoria.value + "&descricao=" + descricao.value + "&imagem=" + imagem.src);
    }
}

function btnAlterar(id)
{
    if(!verificaCampos())
    {
        preco_correto = preco.value.replace(",", ".");

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (xhttp.readyState == 4 && xhttp.status == 200)
            {
                document.getElementById("visualizar_produto").innerHTML = xhttp.responseText;
            }
        };

        var url = "../_phps/visualizar_produto.php";

        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("status=2&nome=" + nome.value + "&quantidade=" + quantidade.value + "&peso=" + peso.value + "&preco=" + preco_correto + "&validade=" + validade.value + "&categoria=" + categoria.value + "&descricao=" + descricao.value + "&imagem=null&id=" + id);

        nome.value = "";
        quantidade.value = "";
        peso.value = "";
        preco.value = "";
        validade.value = "";
        categoria.value = "";
        descricao.value = "";
        button = document.getElementById("btn_add");
        button.value = "Adicionar";
        button.onclick = carregarVisualizador(1);
    }
}

/* UPLOAD DE IMAGEM
function carregarImagem()
{
    var btnCarregarImagem = document.getElementById("btnCarregarImagem");
    if(btnCarregarImagem.value != "")
    {
        var file = btnCarregarImagem.files[0];
        var img = document.getElementById("imgProduto");
        var reader = new FileReader();
        reader.onload = (function(aImg) {return function(e) {aImg.src = e.target.result;};})(img);
        reader.readAsDataURL(file);
    }
}
*/

function btnCancelar()
{
    window.location = "../_phps/cancelar_alt_produto.php";
}

function finalizar()
{
    window.location = "../_phps/salvar_produtos.php";
}

function mudaFoto(op)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("img_produto").innerHTML = xhttp.responseText;
        }
    };

    xhttp.open("POST", "../_phps/muda_foto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("op=" + op);
}

function carregaFoto()
{
    categoria = document.getElementById("categoria").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("img_produto").innerHTML = xhttp.responseText;
        }
    };

    xhttp.open("POST", "../_phps/carrega_foto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("categoria=" + categoria);
}

function addImagem()
{
    window.open("../_telas/imagens.php", "imagens", "height=600,width=600");
    //window.alert('oi');
}

function subirTela()
{
    window.scrollTo(0, 0);
}

function verificaCampos()
{
    if((nome.value != "")
        && (quantidade.value > 0)
        && (peso.value != "")
        && (preco.value != "")
        && (validade.valueAsDate != null)
        && (categoria.selectedIndex != 0)
        && (imagem.src != ""))
    {
        var data = validade.valueAsDate.toLocaleDateString().split("/");
        var newData = data[1] + "/" + data[0] + "/" + data[2];
        validade_timestamp = (new Date(newData).getTime());

        if(validade_timestamp > (new Date().getTime()))
            return true;
        else
        {
            window.alert("data de validade inválida");
            return false;
        }
    }
    else
    {
        window.alert("campos obrigatórios faltando");
        return false;
    }
}
