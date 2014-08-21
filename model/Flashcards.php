<?php

namespace App\Model;
use PDO;

class Flashcards extends Login{

    public function getRandomWord(){
        $q = $this->pdo->prepare("SELECT * FROM words WHERE user=? ORDER BY RAND() LIMIT 1");
        $q->execute(array($this->user));
        return $q->fetchAll(PDO::FETCH_NUM);
    }

    public function increaseBox($id){
        $q = $this->pdo->prepare("UPDATE  `words` SET box = box +1 WHERE id =? AND user=?");
        $q->execute(array($id, $this->user));
        return 1;
    }

    public function decreaseBox($id){
        $q = $this->pdo->prepare("UPDATE  `words` SET box = box -1 WHERE id =? AND user=?");
        $q->execute(array($id, $this->user));
        return 1;
    }

}