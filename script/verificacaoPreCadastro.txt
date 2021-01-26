$(document).ready(function () {


    /*ESCOLA: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
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
        if(sEndereco == ""){
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
        if(sLogin == ""){
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
    

     /*ALUNO: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nome-aluno").keyup(function () {
        var sNomeAluno = $("#nome-aluno").val();
        if(sNomeAluno === "" || !isNaN(sNomeAluno)){
            $("#nome-aluno").css("borderColor", "#C2241F");
         } else {
            $("#nome-aluno").css("borderColor", "#807B65");

         }

    });
    $("#cpf-aluno").keyup(function () {
        var sCpfAluno = $("#cpf-aluno").val();
        if(sCpfAluno === "" || isNaN(sCpfAluno)){
            $("#cpf-aluno").css("borderColor", "#C2241F");
        } else {
            $("#cpf-aluno").css("borderColor", "#807B65");

        }

    });
    $("#contato-aluno").keyup(function () {
        var sContatoAluno = $("#contato-aluno").val();
        if(sContatoAluno === ""){
            $("#contato-aluno").css("borderColor", "#C2241F");
        } else {
            $("#contato-aluno").css("borderColor", "#807B65");

        }

    });

    /*AULA: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#hora-inicio").keyup(function () {
        var dHoraInicio = $("#hora-inicio").val();
        if(dHoraInicio === ""){
            $("#hora-inicio").css("borderColor", "#C2241F");
        } else {
            $("#hora-inicio").css("borderColor", "#807B65");

        }

    });
    $("#hora-termino").keyup(function () {
        var dHoraTermino = $("#hora-inicio").val();
        if(dHoraTermino === ""){
            $("#hora-termino").css("borderColor", "#C2241F");
        } else {
            $("#hora-termino").css("borderColor", "#807B65");

        }

    });

    /*CIDADE: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nome-cidade").keyup(function () {
        var sNomeCidade = $("#nome-cidade").val();
        if(sNomeCidade === "" || !isNaN(sNomeCidade)){
            $("#nome-cidade").css("borderColor", "#C2241F");
        } else {
            $("#nome-cidade").css("borderColor", "#807B65");

        }

    });

    /*DISCIPLINA: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nome-disciplina").keyup(function () {
        var sNomeDisciplina = $("#nome-disciplina").val();
        if(sNomeDisciplina === "" || !isNaN(sNomeDisciplina)){
            $("#nome-disciplina").css("borderColor", "#C2241F");
        } else {
            $("#nome-disciplina").css("borderColor", "#807B65");

        }

    });
    $("#credito-disciplina").keyup(function () {
        var sCreditoDisciplina = $("#credito-disciplina").val();
        if(sCreditoDisciplina === "" || isNaN(sCreditoDisciplina)){
            $("#credito-disciplina").css("borderColor", "#C2241F");
        } else {
            $("#credito-disciplina").css("borderColor", "#807B65");

        }

    });

    /*NOTAS: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nota").keyup(function () {
        var iNota = $("#nota").val();
        if(iNota == "" || isNaN(iNota) || iNota < 0 || iNota > 10){
            $("#nota").css("borderColor", "#C2241F");
        } else {
            $("#nota").css("borderColor", "#807B65");

        }

    });

    /*PROFESSOR: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nome-professor").keyup(function () {
        var sNomeProfessor = $("#nome-professor").val();
        if(sNomeProfessor === "" || !isNaN(sNomeProfessor)){
            $("#nome-professor").css("borderColor", "#C2241F");
        } else {
            $("#nome-professor").css("borderColor", "#807B65");

        }

    });
    $("#cpf-professor").keyup(function () {
        var sCpfProfessor = $("#cpf-professor").val();
        if(sCpfProfessor === "" || isNaN(sCpfProfessor)){
            $("#cpf-professor").css("borderColor", "#C2241F");
        } else {
            $("#cpf-professor").css("borderColor", "#807B65");

        }

    });
    $("#contato-professor").keyup(function () {
        var sContatoProfessor = $("#contato-professor").val();
        if(sContatoProfessor === ""){
            $("#contato-professor").css("borderColor", "#C2241F");
        } else {
            $("#contato-professor").css("borderColor", "#807B65");

        }

    });
    $("#especialidade-professor").keyup(function () {
        var sEspecialidadeProfessor = $("#especialidade-professor").val();
        if(sEspecialidadeProfessor === "" || !isNaN(sEspecialidadeProfessor)){
            $("#especialidade-professor").css("borderColor", "#C2241F");
        } else {
            $("#especialidade-professor").css("borderColor", "#807B65");

        }

    });
    $("#salario-professor").keyup(function () {
        var sSalarioProfessor = $("#salario-professor").val();
        if(sSalarioProfessor === "" || isNaN(sSalarioProfessor)){
            $("#salario-professor").css("borderColor", "#C2241F");
        } else {
            $("#salario-professor").css("borderColor", "#807B65");

        }

    });
    
    /*SALA: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#descricao-sala").keyup(function () {
        var sDescricaoSala = $("#descricao-sala").val();
        if(sDescricaoSala === "" || !isNaN(sDescricaoSala)){
            $("#descricao-sala").css("borderColor", "#C2241F");
        } else {
            $("#descricao-sala").css("borderColor", "#807B65");

        }

    });

    /*TURMA: VERIFICA O TIPO E SE É NULO ANTES DE ENVIAR*/
    $("#nome-turma").keyup(function () {
        var sNomeTurma = $("#nome-turma").val();
        if(sNomeTurma === "" || !isNaN(sNomeTurma)){
            $("#nome-turma").css("borderColor", "#C2241F");
        } else {
            $("#nome-turma").css("borderColor", "#807B65");

        }

    });

    
});

