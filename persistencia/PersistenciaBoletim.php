<?php

/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana.
 */
class PersistenciaBoletim extends PersistenciaPadrao {
    
    public function alterarRegistro() {}
    public function excluirRegistro($codigo) {}
    public function inserirRegistro() {}

    public function listarRegistros() {}

    public function listar($codAluno) {
        $sSelect = 'SELECT aluno.id_aluno AS id_aluno,
                           aluno.matricula as matricula,
                           alu.nome as nome_aluno,
                           prof.nome as nome_professor,
                           disciplina.nome as nome_disciplina,
                           turma.nome as nome_turma,
						   aula.id_aula,
						   discproftur.id_discproftur,
                           round((select cast(sum(nota.nota)/count(nota) as numeric) 
                                       from nota
                                      where nota.id_aluno = aluno.id_aluno
								        and nota.id_discproftur = discproftur.id_discproftur), 2) as nota,
                           round((select cast(count(presenca.presenca) as numeric) 
                                       from presenca
                                        join aula
                                          on presenca.id_aula = aula.id_aula
                                       where presenca.id_aluno = aluno.id_aluno
                                         and aula.id_discproftur = disciplinaprofessorturma.id_discproftur
                                         and presenca.presenca = true) 
                                /  
                                (select case when frequencia > 0 
                                            then frequencia 
                                            else 1
                                            end 
                                      from (select cast(count(presenca.presenca) as numeric) as frequencia
                                              from presenca
                                              join aula
                                                on presenca.id_aula = aula.id_aula
                                             where presenca.id_aluno = aluno.id_aluno
                                               and aula.id_discproftur = disciplinaprofessorturma.id_discproftur) as sf) 
           * 100, 2) as presenca    
                      FROM aluno 
           		   JOIN presenca 
                        ON presenca.id_aluno = aluno.id_aluno
				   JOIN nota 
                        ON nota.id_aluno = aluno.id_aluno
				   JOIN aula
					    ON aula.id_aula = presenca.id_aula
                   JOIN disciplinaprofessorturma discproftur
                        ON discproftur.id_discproftur = aula.id_discproftur
                      JOIN disciplina 
                        ON disciplina.id_disciplina = discproftur.id_disciplina
                      JOIN turma
                        ON turma.id_turma = discproftur.id_turma
                      JOIN professor
                        ON professor.id_professor = discproftur.id_professor
                      JOIN pessoa alu
                        ON alu.id_pessoa = aluno.id_aluno
                      JOIN pessoa prof 
                        ON prof.id_pessoa = professor.id_professor
                     WHERE aluno.id_aluno = ' . $codAluno . '
		  GROUP BY  aluno.id_aluno, matricula, nome_aluno, nome_professor,nome_disciplina,nome_turma,
		            aula.id_aula, discproftur.id_discproftur';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aBoletins = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){            
            $oBoletim = new ModelBoletim();
            $oBoletim->getAluno()->getUsuario()->setCodigo($aLinha['id_aluno']);
            $oBoletim->getAluno()->setNome($aLinha['nome_aluno']);
            $oBoletim->getAluno()->setMatricula($aLinha['matricula']);
            $oBoletim->getDiscProfTur()->getProfessor()->setNome($aLinha['nome_professor']);
            $oBoletim->getDiscProfTur()->getDisciplina()->setNome($aLinha['nome_disciplina']);
            $oBoletim->getDiscProfTur()->getTurma()->setNome($aLinha['nome_turma']);
            $oBoletim->setMediaNota($aLinha['nota']);
            $oBoletim->setTaxaPresenca($aLinha['presenca']);
            
            $aBoletins[] = $oBoletim;
        }
        return $aBoletins;
    }
    
    public function getDesempenhoProfessor($codProfessor) {
        $sSelect = 'SELECT aluno.id_aluno AS id_aluno,
                           pessoa.nome AS nome_aluno,
                           professor.id_professor,
			   discproftur.id_discproftur,
                           round((select cast(sum(nota.nota)/count(nota) as numeric) 
                                       from nota
                                      where nota.id_aluno = aluno.id_aluno
								        and nota.id_discproftur = discproftur.id_discproftur), 2) as nota,
                           round((select cast(count(presenca.presenca) as numeric) 
                                       from presenca
                                        join aula
                                          on presenca.id_aula = aula.id_aula
                                       where presenca.id_aluno = aluno.id_aluno
                                         and aula.id_discproftur = discproftur.id_discproftur
                                         and presenca.presenca = true) 
                                /  
                                (select case when frequencia > 0 
                                            then frequencia 
                                            else 1
                                            end 
                                      from (select cast(count(presenca.presenca) as numeric) as frequencia
                                              from presenca
                                              join aula
                                                on presenca.id_aula = aula.id_aula
                                             where presenca.id_aluno = aluno.id_aluno
                                               and aula.id_discproftur = discproftur.id_discproftur) as sf) 
           * 100, 2) as presenca    
                      FROM aluno 
           	      JOIN presenca 
                        ON presenca.id_aluno = aluno.id_aluno
                      JOIN nota 
                        ON nota.id_aluno = aluno.id_aluno
                      JOIN aula
			ON aula.id_aula = presenca.id_aula
                      JOIN disciplinaprofessorturma discproftur
                        ON discproftur.id_discproftur = aula.id_discproftur
                      JOIN professor
                        ON professor.id_professor = discproftur.id_professor
                      JOIN pessoa
                        ON pessoa.id_pessoa = aluno.id_aluno
                     WHERE professor.id_professor = ' . $codProfessor . '
		  GROUP BY aluno.id_aluno, 
                           nome_aluno,
			   professor.id_professor,
			   discproftur.id_discproftur';
        $oResultado = pg_query($this->conexao, $sSelect);
        $aBoletins = [];
        
        while ($aLinha = pg_fetch_array($oResultado, null, PGSQL_ASSOC)){            
            $oBoletim = new ModelBoletim();
            $oBoletim->getAluno()->getUsuario()->setCodigo($aLinha['id_aluno']);
            $oBoletim->getAluno()->setNome($aLinha['nome_aluno']);
            $oBoletim->setMediaNota($aLinha['nota']);
            $oBoletim->setTaxaPresenca($aLinha['presenca']);
            
            $aBoletins[] = $oBoletim;
        }
        return $aBoletins;
    }
}
