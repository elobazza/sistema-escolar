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

function limparCampoEscola(oImagem){
   
   document.getElementById("tabela-escola").deleteRow(oImagem.parentNode.parentNode.rowIndex);
}
function limparCampoDisciplina(oImagem){
   
   document.getElementById("tabela-disciplina").deleteRow(oImagem.parentNode.parentNode.rowIndex);
}

function alterar(pagina) {
    var codigo = pegarCodigo();
    window.open('index.php?pg=' + pagina + '&acao=altera&codigo='+ parseInt(codigo) +'&efetiva=0');
}

function excluir(pagina) {
    var codigo = pegarCodigo();
    window.open('index.php?pg=' + pagina + '&acao=exclui&codigo='+ parseInt(codigo));
}

function consultarAlunoTurma() {
//    $(location).attr('href', 'index.php?pg=consultaAlunoTurma&codigo='+ parseInt(pegarCodigo()));
    var codigo = pegarCodigo();
    window.location.assign('index.php?pg=consultaAlunoTurma&codigo='+ parseInt(codigo));
}




function pegarCodigo() {
    var selecionados = document.getElementsByClassName("selected");
    if(selecionados.length < 1){
  	alert("Selecione pelo menos uma linha");
        return false;
    }
    return selecionados[0].getElementsByTagName("input")[0].value;
     
}