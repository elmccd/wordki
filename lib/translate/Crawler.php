<?php
namespace App\Lib\Translate;

abstract class Crawler {

    abstract public function getAll();
    
    protected function validateRespond($respond){
        $first_line = strtok($respond, "\n\r");
        if(strpos($first_line, '20') || strpos($first_line, '30')){
            return true;
        }
        return false;
    }

}
?>