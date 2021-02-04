<?php

/**
 * View da Tela Principal
 *
 * @author Eloísa Bazzanella e Maria Eduarda Buzana
 */
class ViewTelaPrincipal extends ViewPadrao {
    
    protected function getConteudo() {
        return '
            <div class="container">
                <div class="caixa-tela-principal">
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>
                </div>
                <div class="caixa-tela-principal">
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>
                    <div class="caixinha"></div>                
                    <div class="caixinha"></div>                
                </div>
            </div>
          ';
    }
    
}
