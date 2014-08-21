<?php

namespace App\Model;
use PDO;

class App {

    protected $pdo;

    function __construct(){
        try
        {
            $this -> pdo = new PDO('mysql:host=localhost;dbname=name;encoding=utf8', 'db', 'pass');
            $this -> pdo -> exec("SET CHARACTER SET utf8");
        }
        catch(PDOException $e)
        {
            echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
        }
    }

}