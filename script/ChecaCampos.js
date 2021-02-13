$(document).ready(function () {

    $("#nome").keyup(function () {
        var sNome = $("#nome").val();
        if(sNome === "" || !isNaN(sNome)){
            $("#nome").css("borderColor", "#C2241F");
         }else {
            $("#nome").css("borderColor", "#807B65");

         }

    });
    
    $("#endereco").keyup(function () {
        var sEndereco = $("#endereco").val();
        if(sEndereco == "" || !isNaN(sEndereco)){
            $("#endereco").css("borderColor", "#C2241F");
        }else {
            $("#endereco").css("borderColor", "#807B65");

         }

    });
    
    $("#contato").keyup(function () {
        var sContato = $("#contato").val();
        if(sContato == ""){
            $("#contato").css("borderColor", "#C2241F");
        } else {
            $("#contato").css("borderColor", "#807B65");

         }
    });
    
    $("#login").keyup(function () {
        var sLogin = $("#login").val();
        if(sLogin == "" || !isNaN(sLogin)){
            $("#login").css("borderColor", "#C2241F");
        } else {
            $("#login").css("borderColor", "#807B65");

         }

    });
    
    $("#senha").keyup(function () {
        var sSenha = $("#senha").val();
        if(sSenha == ""){
            $("#senha").css("borderColor", "#C2241F");
        }else {
            $("#senha").css("borderColor", "#807B65");

         }

    });
    
    $("#cpf").keyup(function () {
        var sCpf = $("#cpf").val();
        if(sCpf == "" || sCpf.length < 11){
            $("#cpf").css("borderColor", "#C2241F");
        }else {
            $("#cpf").css("borderColor", "#807B65");

         }

    });    
});

