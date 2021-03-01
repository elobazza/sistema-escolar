<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ViewCadastroAviso extends ViewPadrao {
    
    /** @var ModelAviso $Aviso */
    private $Aviso;
    
    function getAviso() {
        return $this->Aviso;
    }

    function setAviso($escola) {
        $this->Aviso = $escola;
    }
    
    function getConteudoCadastrar(){   
        return 
        '<form action="index.php?pg=aviso&acao=insere" method="POST">
            <div class="container" style="height: 455px; margin-top:25px">
                <label class="titulo-formulario">CADASTRO DE AVISO</label>
                <input class="campo" type="text" name="titulo" placeholder="Título" id="titulo" maxlength="30">
                <textarea placeholder="Mensagem" class="campo" id="mensagem" name="mensagem" rows="4" cols="50" maxlength="250"></textarea>
                
                <div id="limpar" onclick="limpar()">Limpar</div>
                <input type="submit" value="Cadastrar" class="cadastrar" id="cadastrar-aviso">
                <input type="submit" value="Cadastrar" class="cadastrar-peq" id="cadastrar-aviso">
            </div>
        </form>';
    }
    
}
