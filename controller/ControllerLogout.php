<?php
/**
 * @author Eloisa Bazzanella e Maria Eduarda Buzana
 */
class ControllerLogout {
    function __construct() {
        session_destroy();
        header('Location:index.php?pg=login');
    }
}