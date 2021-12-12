<?php

//require_once './class/autoload.php';

class View{

    private $data = array();
    private $render = FALSE;

    public function __construct($controller,$action) {}
//
    public static function url($controller,$action) {
        $location = "./index.php?controller=".$controller."&action=".$action."";
        header("Location: ".$location."");
    }
//
    public function para($controller,$action,Array $para) {

        $location = "./index.php?controller=".$controller."&action=".$action."";
        $i=0;
        foreach($para as $x=>$x_value)
        {
            $location.="&".$x."=".$x_value;
        }
        header("Location: ".$location."");
    }
    
    public static function backs($action,Array $para) {
        
            $back = new backs($action);            
            foreach($para as $x=>$x_value)
            {
                $back->assign($x,$x_value);
            }
    }
    
    public static function redirects($action){
        
        $back = new backs($action); 
    }

    public function ba($action,Array $para) {
//echo "view";
//            $back = new backs($action);            
//            foreach($para as $x=>$x_value)
//            {
//                $back->assign($x,$x_value);
//               // $location.="&".$x."=".$x_value;
//            }
    }

}
