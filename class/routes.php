<?php


require_once './class/autoload.php';

class routes{
    
    private $_listUri = array();
    private $_listCall = array();
    
    
    public static function add($uri, $function)
    {
        $this->_listUri[] = $uri;
        $this->_listCall[] = $function;
    }

    public function submit($controller,$action)
    {
             $controller = $controller."Controller";
             $controllers = new $controller();
             $controllers->$action();
              
    }    
}

?>