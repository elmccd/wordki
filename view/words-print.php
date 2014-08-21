<?php
//var_dump($data[0]);
var_dump($data[1]);

foreach($data[0] as $value){
    if(isset($value[0])){
        echo "<h1>".$value[0][6]."</h1>";
    }
    foreach($value as $value2){
        echo $value2[2]." - ".$value2[1]."<br/>";
    }
}