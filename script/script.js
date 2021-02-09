$(document).ready(function () {

    $("#botao-desce").click(function () {
        $("#dropdown-content").fadeToggle("fast");
    });
   
    
    $("#botao-desce-dois").click(function () {
        $("#dropdown-content-dois").fadeToggle("fast");
    });

    $(".fecha-modal-sucesso").click(function () {
        $("#modal-sucesso").fadeOut("fast");
    });
	
    $(".fecha-modal-normal").click(function () {
        $("#modal-normal").fadeOut("fast");
    });
	
    $(".fecha-modal-erro").click(function () {
        $("#modal-erro").fadeOut("fast");
    });
    
    $(".fecha-modal-alerta").click(function () {
       ("#modal-alerta").fadeOut("fast");
    });
  
    
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


     


function adicionarNota(){
    var oTabela = document.getElementById("notas");
    var oLinha = document.createElement('tr');
    var oColuna1 = document.createElement('td');
    var oColuna2 = document.createElement('td');
    var oColuna3 = document.createElement('td');
    var oImagem = document.createElement('img');
    var oInput = document.createElement('input');
    var oInputTexto = document.createElement('input');
    var iNota = document.getElementById("nota").value;
    var oSelect = document.getElementById('Aluno');
    var sNomeAluno = oSelect.options[oSelect.selectedIndex].text;
    
    oImagem.setAttribute("src", "./images/garbage-2.png");
    oImagem.setAttribute("width", "20px");
    oImagem.setAttribute("cursor", "pointer");
    oImagem.setAttribute("id", "lixeira");
    oImagem.setAttribute("onclick", "limparCampo(this)");
    
    oInput.setAttribute("type", "text");
    oInput.setAttribute("name", "disciplinas[]");
    oInput.setAttribute("class", "input-especial");
    oInput.setAttribute("disabled", "true");
    
    oInputTexto.setAttribute("type", "text");
    oInputTexto.setAttribute("disabled", "true");
    oInputTexto.setAttribute("class", "input-especial-nome");
    
    oColuna1.appendChild(oInput).value = sNomeAluno;
    oLinha.appendChild(oColuna1);
    oColuna2.appendChild(oInputTexto).value = iNota;
    oLinha.appendChild(oColuna2);
    oColuna3.appendChild(oImagem);
    oLinha.appendChild(oColuna3);

    oTabela.appendChild(oLinha);
}

function adicionarDisciplina() {
    var oTabela = document.getElementById("tabela-disciplina");
    var oLinha = document.createElement('tr');
    var oColuna1 = document.createElement('td');
    var oColuna2 = document.createElement('td');
    var oColuna3 = document.createElement('td');
    var oImagem = document.createElement('img');
    var oInput = document.createElement('input');
    var oInputTexto = document.createElement('input');
    var iCodigoDisciplina = document.getElementById("Disciplina").value;
    var oSelect = document.getElementById('Disciplina');
    var sNomeDisciplina = oSelect.options[oSelect.selectedIndex].text;
    
    oImagem.setAttribute("src", "./images/garbage-2.png");
    oImagem.setAttribute("width", "20px");
    oImagem.setAttribute("cursor", "pointer");
    oImagem.setAttribute("id", "lixeira");
    oImagem.setAttribute("onclick", "limparCampoDisciplina(this)");
    
    oInput.setAttribute("type", "text");
    oInput.setAttribute("name", "disciplinas[]");
    oInput.setAttribute("class", "input-especial");
    oInput.setAttribute("readonly", "");
    
    oInputTexto.setAttribute("type", "text");
    oInputTexto.setAttribute("disabled", "true");
    oInputTexto.setAttribute("class", "input-especial-nome");
        
    oColuna1.appendChild(oInput).value = iCodigoDisciplina;
    oLinha.appendChild(oColuna1);
    oColuna2.appendChild(oInputTexto).value = sNomeDisciplina;
    oLinha.appendChild(oColuna2);
    oColuna3.appendChild(oImagem);
    oLinha.appendChild(oColuna3);

    oTabela.appendChild(oLinha);
}
 
function adicionarEscola() {
    var oTabela = document.getElementById("tabela-escola");
    var oLinha = document.createElement('tr');
    var oColuna1 = document.createElement('td');
    var oColuna2 = document.createElement('td');
    var oColuna3 = document.createElement('td');
    var oImagem = document.createElement('img');
    var oInput = document.createElement('input');
    var oInputTexto = document.createElement('input');
    var iCodigoEscola = document.getElementById("Escola").value;
    var oSelect = document.getElementById('Escola');
    var sNomeEscola = oSelect.options[oSelect.selectedIndex].text;
    
    oImagem.setAttribute("src", "./images/garbage-2.png");
    oImagem.setAttribute("width", "20px");
    oImagem.setAttribute("cursor", "pointer");
    oImagem.setAttribute("id", "lixeira");
    oImagem.setAttribute("onclick", "limparCampoEscola(this)");
    
    oInput.setAttribute("type", "text");
    oInput.setAttribute("name", "escolas[]");
    oInput.setAttribute("class", "input-especial");
    oInput.setAttribute("readonly", "");
    
    oInputTexto.setAttribute("type", "text");
    oInputTexto.setAttribute("disabled", "true");
    oInputTexto.setAttribute("class", "input-especial-nome");
    
    oLinha.setAttribute("class", "estilo-sublinhado");
    
    oColuna1.appendChild(oInput).value = iCodigoEscola;
    oLinha.appendChild(oColuna1);
    oColuna2.appendChild(oInputTexto).value = sNomeEscola;
    oLinha.appendChild(oColuna2);
    oColuna3.appendChild(oImagem);
    oLinha.appendChild(oColuna3);

    oTabela.appendChild(oLinha);
}

//function limparCampo(oImagem){
//   
//   document.getElementById("tabela").deleteRow(oImagem.parentNode.parentNode.rowIndex);
//}
function limparCampoEscola(oImagem){
   
   document.getElementById("tabela-escola").deleteRow(oImagem.parentNode.parentNode.rowIndex);
}
function limparCampoDisciplina(oImagem){
   
   document.getElementById("tabela-disciplina").deleteRow(oImagem.parentNode.parentNode.rowIndex);
}

function alterar() {
    var codigo = pegarCodigo();
    window.open('index.php?pg=aluno&acao=altera&codigo='+ parseInt(codigo) +'&efetiva=0');
}

function excluir() {
    var codigo = pegarCodigo();
    window.open('index.php?pg=aluno&acao=exclui&codigo='+ parseInt(codigo));
}


function pegarCodigo() {
    var selecionados = document.getElementsByClassName("selected");
    if(selecionados.length < 1){
  	alert("Selecione pelo menos uma linha");
        return false;
    }
    return selecionados[0].getElementsByTagName("input")[0].value;
     
}

//function limparCampoDois(oImagem){
//   document.getElementById("tabela-dois").deleteRow(oImagem.parentNode.parentNode.rowIndex);
//}
//
//function limparLinha(oImagemDois){
//    document.getElementById("tabela").deleteRow(oImagemDois.parentNode.parentNode.rowIndex);
//}

