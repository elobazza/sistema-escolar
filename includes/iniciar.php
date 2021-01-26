<?php
function carregaClasses($className) {
    if(strpos($className, 'Controller') !== false)  {
        return require_once('controller/'.$className.'.php');
    }
    
    if(strpos($className, 'Persistencia') !== false)  {
        return require_once('persistencia/'.$className.'.php');
    }
    
    if(strpos($className, 'Model') !== false)  {
        return require_once('model/'.$className.'.php');
    }
    
    if(strpos($className, 'View') !== false)  {
        return require_once('view/'.$className.'.php');
    }
        
    return require_once('includes/'.$className.'.php');
}
spl_autoload_register('carregaClasses');