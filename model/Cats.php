<?php

namespace App\Model;

class Cats extends Login {

    public function addCategory($name, $id){
        if($id==0) {
            $q = $this->pdo->prepare("INSERT INTO cats (name, user) VALUES (?, ?)");
            $q->execute(array(htmlspecialchars($name), $this->user));
            return $this->pdo->lastInsertId();
        } else {

        }
    }
    public function removeCat($id){
        $q = $this->pdo->prepare("DELETE FROM cats WHERE id=? AND user=?");
        $q->execute(array($id, $this->user));
    }

    public function clearStats($id){
        $q = $this->pdo->prepare("UPDATE `words` SET `box`=1 WHERE cat=? AND user=?");
        $q->execute(array($id, $this->user));
    }

}