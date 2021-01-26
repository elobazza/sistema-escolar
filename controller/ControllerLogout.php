<?php

class ControllerLogout {
    function __construct() {
        session_destroy();
        header('Location:index.php?pg=login');
    }
}