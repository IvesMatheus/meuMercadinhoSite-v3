function mostrarSenha(senha)
{
    var chkSenha = document.getElementById("mostraSenha");
    var lblSenha = document.getElementById("senha");

    if(chkSenha.checked)
        lblSenha.innerText = senha;
    else
    {
        var aux = "";
        for(i = 0; i < senha.length; i++)
            aux += "*";

        lblSenha.innerText = aux;
    }
}

function logout()
{
    window.location = "../_phps/logout.php";
}

function mapa()
{
    window.open("../_telas/mapa.php", "minhaJanela", "height=500,width=500");
}

function editarPerfil()
{
    window.location = "editar_perfil.php";
}

/*
btnEditarPerfil = document.getElementById("btnEditarPerfil");
btnEditarPerfil.onclick = function ()
{
    window.location = "../_telas/editar_perfil.php";
}
*/
