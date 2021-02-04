
$(document).ready(function () {
//ESCOLA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-escola").click(function () {

        var sNome = $("#nome").val();
        var sEndereco = $("#endereco").val();
        var sContato = $("#contato").val();
        var sLogin = $("#login").val();
        var sSenha = $("#senha").val();
        
	var oCidade = $("#cidade-escola").val();
        var aErros = [];
        
        if(sNome == "" || !isNaN(sNome)){
            $("#nome").css("borderColor", "#C2241F");
			$("#nome").val("");
            aErros.push("Nome");
        } 
        if(sEndereco == ""|| !isNaN(sEndereco)){
            $("#endereco").css("borderColor", "#C2241F");
			$("#endereco").val("");
            aErros.push("Endereço");
        } 
        if(sContato == ""){
            $("#contato").css("borderColor", "#C2241F");
	    $("#contato").val("");
            aErros.push("Contato");
        } 
        if(sLogin == ""){
            $("#login").css("borderColor", "#C2241F");
			$("#login").val("");
            aErros.push("Login");
        }
        if(sSenha == ""){
            $("#senha").css("borderColor", "#C2241F");
			$("#senha").val("");
            aErros.push("Senha");
        }
        
	if(oCidade == null){
            $("#cidade-escola").css("borderColor", "#C2241F");
			$("#cidade-escola").val("");
            aErros.push("Cidade");
        }

        

        if(aErros != ""){
           $("#modal-alerta").fadeIn("fast");
		   
           $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
          
        } else {
           $("#modal-sucesso").fadeIn("fast");
           $(".texto-modal").text("Cadastro realizado com sucesso!");
        }


    });

    //ALUNO: VERIFICAÇÃO CADASTRO
    $("#cadastrar-aluno").click(function () {

        var sNomeAluno = $("#nome-aluno").val();
        var sCpfAluno = $("#cpf-aluno").val();
        var sContatoAluno = $("#contato-aluno").val();
        var oTurmaAluno = $("#turma-aluno").val();
        var aErros = [];

        if(sNomeAluno == "" || !isNaN(sNomeAluno)){
            $("#nome-aluno").css("borderColor", "#C2241F");
			$("#nome-aluno").val("");
            aErros.push("Nome");
        } 
        if(sCpfAluno == "" || isNaN(sCpfAluno)){
            $("#cpf-aluno").css("borderColor", "#C2241F");
			$("#cpf-aluno").val("");
            aErros.push("CPF");
        } 
        if(sContatoAluno == ""){
            $("#contato-aluno").css("borderColor", "#C2241F");
			$("#contato-aluno").val("");
            aErros.push("Contato");
        } 
        if(oTurmaAluno == null){
            $("#turma-aluno").css("borderColor", "#C2241F");
			$("#turma-aluno").val("");
            aErros.push("Turma");
        } 

        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text(aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

    //AULA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-aula").click(function () {

        var dHoraInicio = $("#hora-inicio").val();
        var dHoraTermino = $("#hora-termino").val();
        var aErros = [];
        
        if(dHoraInicio == ""){
            $("#hora-inicio").css("borderColor", "#C2241F");
			$("#hora-inicio").val("");
            aErros.push("Hora de Início");
        } 
        if(dHoraTermino == ""){
            $("#hora-termino").css("borderColor", "#C2241F");
			$("#hora-termino").val("");
            aErros.push("Hora de Término");
        } 
        if(dHoraTermino <= dHoraInicio){
            $("#hora-termino").css("borderColor", "#C2241F");
			$("#hora-termino").val("");
            $("#hora-inicio").css("borderColor", "#C2241F");
			$("#hora-inicio").val("");
            aErros.push("Intervalo Válido");
        }

        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

    //CIDADE: VERIFICAÇÃO CADASTRO
    $("#cadastrar-cidade").click(function () {
        var sNomeCidade = $("#nome-cidade").val();
        var aErros = [];

        if(sNomeCidade == "" || !isNaN(sNomeCidade)){
            $("#nome-cidade").css("borderColor", "#C2241F");
			$("#nome-cidade").val("");
            aErros.push("Nome da Cidade");
        } 
        if(aErros != ""){
           $("#modal-alerta").fadeIn("fast");
           $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
          
        } else {
           $("#modal-sucesso").fadeIn("fast");
           $(".texto-modal").text("Cadastro realizado com sucesso!");
        }


    });

    //DISCIPLINA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-disciplina").click(function () {

        var sNomeDisciplina = $("#nome-disciplina").val();
        var sCreditoDisciplina = $("#credito-disciplina").val();
        var aErros = [];
        
        if(sNomeDisciplina == "" || !isNaN(sNomeDisciplina)){
            $("#nome-disciplina").css("borderColor", "#C2241F");
			$("#nome-disciplina").val("");
            aErros.push("Nome da Disciplina");
        } 
        if(sCreditoDisciplina == "" || isNaN(sCreditoDisciplina) || sCreditoDisciplina > 20){
            $("#credito-disciplina").css("borderColor", "#C2241F");
			$("#credito-disciplina").val("");
            aErros.push("Créditos da Disciplina");
        } 
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });
	
	//DISCIPLINA/TURMA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-dis-tur").click(function () {

        var oDisciplina = $("#disciplina-dis-tur").val();
        var oTurma = $("#turma-dis-tur").val();
        var aErros = [];
        
        if(oDisciplina == null){
            $("#disciplina-dis-tur").css("borderColor", "#C2241F");
			$("#disciplina-dis-tur").val("");
            aErros.push("Disciplina");
        } 
        if(oTurma == null){
            $("#turma-dis-tur").css("borderColor", "#C2241F");
			$("#turma-dis-tur").val("");
            aErros.push("Turma");
        } 
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

    //NOTAS: VERIFICAÇÃO CADASTRO
    $("#cadastrar-nota").click(function () {

        var oDisciplina = $("#discplina-nota").val();
        var oAluno = $("#aluno-nota").val();
        var iNota = $("#nota").val();
        var aErros = [];
        
        if(oDisciplina == null ){
            $("#disciplina-nota").css("borderColor", "#C2241F");
			$("#disciplina-nota").val("");
            aErros.push("Disciplina");
        } 
        if(oAluno == null){
            $("#aluno-nota").css("borderColor", "#C2241F");
			$("#aluno-nota").val("");
            aErros.push("Aluno");
        } 
        if(iNota == "" || isNaN(iNota) || iNota < 0 || iNota > 10){
            $("#nota").css("borderColor", "#C2241F");
			$("#nota").val("");
            aErros.push("Nota Válida");
        } else {
            $("#nota").css("borderColor", "#807B65");

        }
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

     //PROFESSOR: VERIFICAÇÃO CADASTRO
    $("#cadastrar-professor").click(function () {

        var sNomeProfessor = $("#nome-professor").val();
        var sCpfProfessor = $("#cpf-professor").val();
        var sContatoProfessor = $("#contato-professor").val();
        var sEspecialidadeProfessor = $("#especialidade-professor").val();
        var sSalarioProfessor = $("#salario-professor").val();
        var aErros = [];
        
        if(sNomeProfessor == "" || !isNaN(sNomeProfessor)){
            $("#nome-professor").css("borderColor", "#C2241F");
			$("#nome-professor").val("");
            aErros.push("Nome");
        } 
        if(sCpfProfessor == "" || isNaN(sCpfProfessor)){
            $("#cpf-professor").css("borderColor", "#C2241F");
			$("#cpf-professor").val("");
            aErros.push("CPF");
        } 
        if(sContatoProfessor == ""){
            $("#contato-professor").css("borderColor", "#C2241F");
            $("#contato-professor").val("");
            aErros.push("Contato");
        }
        if(sEspecialidadeProfessor == "" || !isNaN(sEspecialidadeProfessor)){
            $("#especialidade-professor").css("borderColor", "#C2241F");
			$("#especialidade-professor").val("");
            aErros.push("Especialidade");
        }
        if(sSalarioProfessor == "" || isNaN(sSalarioProfessor)){
            $("#salario-professor").css("borderColor", "#C2241F");
			$("#salario-professor").val("");
            aErros.push("Salário");
        }
        
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

	//PROFESSOR/DISCIPLINA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-prof-dis").click(function () {

        var oProfessor = $("#professor-prof-dis").val();
        var oDisciplina = $("#disciplina-prof-dis").val();
        var aErros = [];
        
        if(oProfessor == null){
            $("#professor-prof-dis").css("borderColor", "#C2241F");
			$("#professor-prof-dis").val("");
            aErros.push("Nome da Disciplina");
        } 
        if(oDisciplina == null){
            $("#disciplina-prof-dis").css("borderColor", "#C2241F");
			$("#disciplina-prof-dis").val("");
            aErros.push("Turma");
        } 
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });
	
	//PROFESSOR/ESCOLA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-prof-esc").click(function () {

        var oProfessor = $("#professor-prof-esc").val();
        var oEscola = $("#escola-prof-esc").val();
        var aErros = [];
        
        if(oProfessor == null){
            $("#professor-prof-esc").css("borderColor", "#C2241F");
			$("#professor-prof-esc").val("");
            aErros.push("Nome da Disciplina");
        } 
        if(oEscola == null){
            $("#escola-prof-esc").css("borderColor", "#C2241F");
			$("#escola-prof-esc").val("");
            aErros.push("Turma");
        } 
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });
	
    //SALA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-sala").click(function () {

        var sDescricaoSala = $("#descricao-sala").val();
        var oEscolaSala = $("#escola-sala").val();
        var aErros = [];
        
        if(sDescricaoSala == "" || !isNaN(sDescricaoSala)){
            $("#descricao-sala").css("borderColor", "#C2241F");
			$("#descricao-sala").val("");
            aErros.push("Descrição");
        } 
        if(oEscolaSala == null){
            $("#escola-sala").css("borderColor", "#C2241F");
			$("#escola-sala").val("");
            aErros.push("Escola");
        } 
       
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });
	
	//SALA/AULA: VERIFICAÇÃO CADASTRO
    $("#cadastrar-sal-aul").click(function () {

        var oSala = $("#sala-sal-aul").val();
        var oAula = $("#aula-dis-tur").val();
        var oTurma = $("#turma-dis-tur").val();
        var oProfessor = $("#professor-dis-tur").val();
        var oDisciplina = $("#disciplina-dis-tur").val();
        var aErros = [];
        
        if(oSala == null){
            $("#sala-sal-aul").css("borderColor", "#C2241F");
			$("#sala-sal-aul").val("");
            aErros.push("Sala");
        } 
        if(oAula == null){
            $("#aula-dis-tur").css("borderColor", "#C2241F");
			$("#aula-dis-tur").val("");
            aErros.push("Aula");
        } 
		if(oTurma == null){
            $("#turma-dis-tur").css("borderColor", "#C2241F");
			$("#turma-dis-tur").val("");
            aErros.push("Turma");
        } 
		if(oProfessor == null){
            $("#professor-dis-tur").css("borderColor", "#C2241F");
			$("#professor-dis-tur").val("");
            aErros.push("Professor");
        } 
		if(oDisciplina == null){
            $("#disciplina-dis-tur").css("borderColor", "#C2241F");
			$("#disciplina-dis-tur").val("");
            aErros.push("Disciplina");
        } 
        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });

    //TURMA: VERIFICAÇÃO CADASTRO
     $("#cadastrar-turma").click(function () {

        var sNomeTurma = $("#nome-turma").val();
        var aErros = [];
        
        if(sNomeTurma == "" || !isNaN(sNomeTurma)){
            $("#nome-turma").css("borderColor", "#C2241F");
			$("#nome-turma").val("");
            aErros.push("Nome da Turma");
        } 

        if(aErros != ""){
            $("#modal-alerta").fadeIn("fast");
            $(".texto-modal").text("Necessário informar: "+ aErros.join(", "));
           
         } else {
            $("#modal-sucesso").fadeIn("fast");
            $(".texto-modal").text("Cadastro realizado com sucesso!");
         }


    });
});