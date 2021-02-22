$(document).ready(function () {
     $(".table-selectable tr").click(function(e) {
        var selecionar = !$(this).hasClass("selected");
        $(this).parent().find("tr.selected").removeClass("selected");
        $(this).parent().find("input[type='checkbox']").prop('checked', false);
        if (selecionar) {
          $(this).addClass("selected");
          $(this).find("input[type='checkbox']").prop('checked', true);
        }
      });      
}); 

function limpar() {
   document.getElementById("nome").value = "";
   document.getElementById("matricula").value = "";
   document.getElementById("cpf").value = "";
   document.getElementById("contato").value = "";
   document.getElementById("cpf").value = "";
   document.getElementById("data_nascimento").value = "";
   document.getElementById("salario").value = "";
   document.getElementById("login").value = "";
   document.getElementById("senha").value = "";
   document.getElementById("carga_horaria").value = "";  
}

function alterar(event, pagina, cod) {
    event.preventDefault();
    var codigo;
    if(cod) {
        codigo = cod;
    } else {
        codigo = pegarCodigo();
    }
    
    if(codigo) {
        window.location.href='index.php?pg=' + pagina + '&acao=altera&codigo='+ parseInt(codigo) +'&efetiva=0';
    } 
}

function excluir(event, pagina) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.href='index.php?pg=' + pagina + '&acao=exclui&codigo='+ parseInt(codigo);
    }
}

function consultarAlunoTurma(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaAlunoTurma&codigo='+ parseInt(codigo));
    }
}

function pegarCodigo() {
    var selecionados = document.getElementsByClassName("selected");
    if(selecionados.length < 1){
  	alert("Selecione pelo menos uma linha");
        return false;
    }
    return selecionados[0].getElementsByTagName("input")[0].value;  
}