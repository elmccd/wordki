<?php

namespace App\Model;
use PDO;

class Words extends Login {

    public function getAllWords(){
        $stmt = $this->pdo->prepare("SELECT * FROM
(SELECT id, name, user FROM cats) as cats
LEFT JOIN (SELECT cat, COUNT(id) as liczba FROM `words` WHERE user=? GROUP by cat) as count
ON cats.id=count.cat
WHERE user=? OR user=0");
        $stmt->execute(array($this->user, $this->user));
        $cats = $stmt->fetchAll(PDO::FETCH_NUM);
        $all = array();
        $all[0] = array();
        $all[1] = $cats;
        foreach($cats as $cat){
            $q = $this->pdo->prepare("SELECT * FROM words WHERE cat=? AND user=? ORDER by id DESC");
            $q->execute(array($cat[0], $this->user));
            $all[0][] = $q->fetchAll(PDO::FETCH_NUM);
        }

        return $all;
    }

    public function removeOne($id){
        $q = $this->pdo->prepare("DELETE FROM `words` WHERE `id`=? AND user=?");
        $q->execute(array($id, $this->user));
        return 1;
    }

    public function getCats(){
        $q = $this->pdo->prepare("SELECT * FROM
        (SELECT id, name, user FROM cats WHERE user=? OR user=0) as cats
        LEFT JOIN
        (SELECT cat, COUNT(id) as count FROM `words`  WHERE user=? OR user=0 GROUP by cat) as sth
        ON cats.id=sth.cat");
        $q->execute(array($this->user, $this->user));
        $result = $q->fetchAll(PDO::FETCH_NUM);
        return $result;
    }
}