function salvar()
{
    var nome = document.getElementById("nome").value;
    var login = document.getElementById("login").value;
    var senha = document.getElementById("senha").value;
    var codigo = document.getElementById("codigo").value;
    var rua = document.getElementById("rua").value;
    var numero = document.getElementById("numero").value;
    var bairro = document.getElementById("bairro").value;
    var complemento = document.getElementById("complemento").value;
    var servico_entrega = document.getElementById("servico_entrega").checked;
    var hora_abertura = document.getElementById("hora_abertura").value;
    var hora_encerramento = document.getElementById("hora_encerramento").value;
    var taxa_entrega = document.getElementById("taxa_entrega").value;
    var vmc = document.getElementById("vmc").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("corpo").innerHTML = xhttp.responseText;
        }
    };

    window.location = "../_phps/salva_alteracoes_perfil.php?" + "nome=" + nome + "&login=" + login + "&senha=" + senha + "&codigo=" + codigo + "&rua=" + rua + "&numero=" + numero + "&bairro=" + bairro + "&complemento=" + complemento + "&servico_entrega=" + servico_entrega + "&hora_abertura=" + hora_abertura + "&hora_encerramento=" + hora_encerramento + "&taxa_entrega=" + taxa_entrega + "&vmc=" + vmc;
}

function cancelar()
{
    window.location = "../_telas/perfil.php";
}

function mostrarSenha(senha)
{
    var chkSenha = document.getElementById("mostraSenha");
    var txtSenha = document.getElementById("senha");

    if(chkSenha.checked)
    {
        txtSenha.type = "text";
        txtSenha.value = senha;
    }
    else
        txtSenha.type = "password";
}

function servicoEntrega()
{
    var servico_entrega = document.getElementById("servico_entrega");

    if(servico_entrega.checked)
    {
        var div = document.getElementById("dados_sem_servico_entrega");
        div.id = "dados_servico_entrega";
    }
    else
    {
        var div = document.getElementById("dados_servico_entrega");
        div.id = "dados_sem_servico_entrega";
    }
}
