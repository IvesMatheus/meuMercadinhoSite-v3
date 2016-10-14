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

function cancelar()
{
    window.location = "../_telas/produtos.php";
}

function editar()
{
    var nome = document.getElementById("nome");
    var quantidade = document.getElementById("quantidade");
    var peso = document.getElementById("peso");
    var preco = document.getElementById("preco");
    var validade = document.getElementById("validade");
    var categoria = document.getElementById("categoria");
    var descricao = document.getElementById("descricao");
    var imagem = document.getElementById("imagem");
    var preco_correto = preco.value.replace(",", ".");

    window.location = "../_phps/editarProduto.php?nome=" + nome.value + "&quantidade=" + quantidade.value + "&peso=" + peso.value + "&preco=" + preco_correto + "&validade=" + validade.valueAsDate.toLocaleDateString() + "&categoria=" + categoria.value + "&descricao=" + descricao.value + "&imagem=" + imagem.src;
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
