$(document).ready(function () {
    $("#limpar-escola").click(function () {
		$("#nome").val("");
		$("#endereco").val("");
		$("#contato").val("");
		$("#login").val("");
		$("#senha").val("");
		$("#verifica-senha").val("");
		$("#cidade-escola").val("");
		
		$("#nome").css("borderColor", "#807B65");
		$("#endereco").css("borderColor", "#807B65");
		$("#contato").css("borderColor", "#807B65");
		$("#login").css("borderColor", "#807B65");
		$("#senha").css("borderColor", "#807B65");
		$("#verifica-senha").css("borderColor", "#807B65");
        
    });
	
	$("#limpar-aluno").click(function () {
		$("#nome-aluno").val("");
		$("#cpf-aluno").val("");
		$("#contato-aluno").val("");
		$("#turma-aluno").val(""); 

		$("#nome-aluno").css("borderColor", "#807B65");	
		$("#cpf-aluno").css("borderColor", "#807B65");	
		$("#contato-aluno").css("borderColor", "#807B65");	
		$("#turma-aluno").css("borderColor", "#807B65");	
    });
	
	$("#limpar-aula").click(function () {
		$("#hora-inicio").val("");
		$("#hora-termino").val(""); 

		$("#hora-inicio").css("borderColor", "#807B65");	
		$("#hora-termino").css("borderColor", "#807B65");			
    });
	
	$("#limpar-cidade").click(function () {
		$("#nome-cidade").val(""); 
		
		$("#nome-cidade").css("borderColor", "#807B65");	
    });
	
	$("#limpar-disciplina").click(function () {
		$("#nome-disciplina").val(""); 
		$("#credito-disciplina").val("");

		$("#nome-disciplina").css("borderColor", "#807B65");
		$("#credito-disciplina").css("borderColor", "#807B65");	
    });
	
	$("#limpar-dis-tur").click(function () {
		$("#disciplina-dis-tur").val(""); 
		$("#turma-dis-tur").val(""); 
		
		$("#disciplina-dis-tur").css("borderColor", "#807B65");	
		$("#turma-dis-tur").css("borderColor", "#807B65");	
    });
	
	$("#limpar-nota").click(function () {
		$("#discplina-nota").val(""); 
		$("#aluno-nota").val(""); 
		$("#nota").val("");
		
		$("#discplina-nota").css("borderColor", "#807B65");	
		$("#aluno-nota").css("borderColor", "#807B65");	
		$("#nota").css("borderColor", "#807B65");	
		
    });
	
	$("#limpar-professor").click(function () {
		$("#nome-professor").val(""); 
		$("#cpf-professor").val(""); 
		$("#contato-professor").val("");
		$("#especialidade-professor").val("");
		$("#salario-professor").val("");
		
		$("#nome-professor").css("borderColor", "#807B65");
		$("#cpf-professor").css("borderColor", "#807B65");
		$("#contato-professor").css("borderColor", "#807B65");
		$("#especialidade-professor").css("borderColor", "#807B65");
		$("#salario-professor").css("borderColor", "#807B65");
    });
	
	$("#limpar-prof-dis").click(function () {
		$("#professor-prof-dis").val(""); 
		$("#disciplina-prof-dis").val(""); 
		
		$("#professor-prof-dis").css("borderColor", "#807B65");
		$("#disciplina-prof-dis").css("borderColor", "#807B65");
    });
	
	$("#limpar-prof-esc").click(function () {
		$("#professor-prof-esc").val(""); 
		$("#escola-prof-esc").val(""); 
		
		$("#professor-prof-esc").css("borderColor", "#807B65");
		$("#escola-prof-esc").css("borderColor", "#807B65");
    });
	
	
	
	$("#limpar-turma").click(function () {
		$("#nome-turma").val(""); 
		
		$("#nome-turma").css("borderColor", "#807B65");
    });
});