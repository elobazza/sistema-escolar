$(document).ready(function () {
    $(".table-selectable tr").click(function(e) {
        if(document.URL.indexOf('presenca') <= 0) {
            var selecionar = !$(this).hasClass("selected");
            $(this).parent().find("tr.selected").removeClass("selected");
            $(this).parent().find("input[type='checkbox']").prop('checked', false);
            if (selecionar) {
              $(this).addClass("selected");
              $(this).find("input[type='checkbox']").prop('checked', true);
            }            
        } else {
            debugger;
            if($(this).find("input[type='checkbox']").val() == "on") {
                $(this).find("input[type='checkbox']").val("off");
            } else {
                $(this).find("input[type='checkbox']").val("on");
            }
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

function visualizar(event, pagina) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.href='index.php?pg=' + pagina + '&visu=1&codigo='+ parseInt(codigo);
    }
}

function registrar(event, pagina) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.href='index.php?pg=' + pagina + '&codigo='+ parseInt(codigo);
    }
}

function consultarAlunoTurma(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaAlunoTurma&codigo='+ parseInt(codigo));
    }
}

function consultarDisciplinaProfessor(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaDisciplina&professor='+ parseInt(codigo));        
    }
}

function consultarProfessorDisciplina(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaProfessor&disciplina='+ parseInt(codigo));        
    }
}

function consultarTurmaProfessorDisciplina(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaDisciplinaProfessorTurma&indice=disciplinaprofessorturma.id_turma&valor='+ parseInt(codigo));        
    }
}

function consultarAulaTurma(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaAula&indice=disciplinaprofessorturma.id_turma&valor='+ parseInt(codigo));        
    }
}

function registrarNota(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=nota&notaTurma='+ parseInt(codigo));        
    }
}

function consultarNotaTurma(event) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaNota&notaTurma='+ parseInt(codigo));        
    }
}

function consultarNotaAluno(event, turmaDisc) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaNota&turmaDisc=' + turmaDisc + '&notaAluno='+ parseInt(codigo));        
    }
}

function consultarNotaFromAluno(event, codigoAluno) {
    event.preventDefault();
    var codigo = pegarCodigo();
    if(codigo) {
        window.location.assign('index.php?pg=consultaNota&turmaDisc=' + parseInt(codigo) + '&notaAluno='+ codigoAluno);        
    }
}

function consultaAviso(event) {
    event.preventDefault();
    window.location.assign('index.php?pg=consultaAviso');        
}

function pegarCodigo() {
    var selecionados = document.getElementsByClassName("selected");
    if(selecionados.length < 1){
  	alert("Selecione pelo menos uma linha");
        return false;
    }
    return selecionados[0].getElementsByTagName("input")[0].value;  
}