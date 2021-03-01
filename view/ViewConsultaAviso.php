<?php
/**
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ViewConsultaAviso extends ViewPadrao {
    
    private $avisos = [];
    
    function getAvisos() {
        return $this->avisos;
    }

    function setAvisos($avisos) {
        $this->avisos = $avisos;
    }

    protected function getConteudo() {
        if($_SESSION['tipo'] == 1) {
            return '     
                <b><p class="titulo">MURAL DE AVISOS</p></b>
                <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                    <div class="container">
                        <a href="index.php?pg=aviso" style="color:white; font-size:18px; margin-right: 20px"> Cadastrar</a>
                    </div>
                </div>

              ' 
            . $this->montaTabela();
        } else {
            return '     
                <b><p class="titulo">MURAL DE AVISOS</p></b>
                <div style="background-color:#4a6891; height: 50px; width: 100%; margin-top: 30px; padding-top:10px">
                </div>

              ' 
            . $this->montaTabela();
        }
    }
    
    
    public function montaTabela(){
        return '<form method="get">
                    <table class="table table-striped table-selectable">
                        <tr>
                            <th></th>
                            <th>Título</th>
                            <th>Mensagem</th>
                            <th>Data</th>
                            <th>Hora</th>
                        </tr>
                        <tbody>
                        '.$this->createSelectListagem().'
                        </tbody>
                    </table>
                </form>';
    }
    
    private function createSelectListagem() {
        $sResult = "";
        
        foreach ($this->avisos as $oAviso) { 
            $sResult .= ' <tr class="">
                            <td><input type="checkbox" name="linha" value=" '. $oAviso->getCodigo() .'"/></td>
                            <td>' . $oAviso->getTitulo() . '</td>
                            <td>' . $oAviso->getMensagem() . '</td>
                            <td>' . $oAviso->getData() . '</td>
                            <td>' . $oAviso->getHora() . '</td>
                        </tr>';
        }
        return $sResult;
    }

}
