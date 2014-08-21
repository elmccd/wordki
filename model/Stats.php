<?php

namespace App\Model;
use PDO;

class Stats extends Login {

    public function getAllStats2(){
        $stmt = $this->pdo->prepare("SELECT UNIX_TIMESTAMP(date) as date, `view`, `add`, `learn`, `known` FROM `stats2` WHERE user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        return $result;
    }
    public function getCountStats(){
        $stmt = $this->pdo->prepare("SELECT SUM(`view`) as v, SUM(`add`) as a , SUM(`learn`) as l , SUM(`known`) as k  FROM `stats2` WHERE user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        return $result;
    }

    /**
     * Some data for graph
     */
    public function increaseView(){
        $stmt = $this->pdo->prepare("SELECT * FROM `stats2` WHERE `date`=CURDATE()  AND user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        if(count($result)==0){
            $this->addEmptyStat();
        }
        $stmt = $this->pdo->prepare("UPDATE `stats2` SET view=view + 1 WHERE date=CURDATE() AND user=?");
        $stmt->execute(array($this->user));
    }
    public function addEmptyStat($id=false){
        $stmt = $this->pdo->prepare("INSERT INTO `stats2`(`date`, `view`, `add`, `learn`, `known`, `user`) VALUES (NOW(), 0, 0, 0, 0, ?)");
        $stmt->execute(array($id?$id:$this->user));
    }
    public function increaseAdd($pl, $en, $context, $sound_id, $cat){
        //stats
        $stmt = $this->pdo->prepare("SELECT * FROM `stats2` WHERE `date`=CURDATE() AND user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        if(count($result)==0){
            $this->addEmptyStat();
        }
        $stmt = $this->pdo->prepare("UPDATE `stats2` SET `add`=`add` + 1 WHERE date=CURDATE() AND user=?");
        $stmt->execute(array($this->user));

        //word
        $q = $this->pdo->prepare("INSERT INTO `words`(`pl`, `en`, context, sound_id, cat, user) VALUES (?,?,?,?,?,?)");
        $q->execute(array($pl, $en, $context, $sound_id, $cat, $this->user));
        echo $this->pdo->lastInsertId();
    }

    public function increaseStudied($id){
        //stats
        $stmt = $this->pdo->prepare("SELECT * FROM `stats2` WHERE `date`=CURDATE() AND user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        if(count($result)==0){
            $this->addEmptyStat();
        }
        $stmt = $this->pdo->prepare("UPDATE `stats2` SET `learn`=`learn` + 1 WHERE date=CURDATE() AND  user=?");
        $stmt->execute(array($this->user));
    }

    public function increaseKnown($id){
        //stats
        $stmt = $this->pdo->prepare("SELECT * FROM `stats2` WHERE `date`=CURDATE() AND user=?");
        $stmt->execute(array($this->user));
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        if(count($result)==0){
            $this->addEmptyStat();
        }
        $stmt = $this->pdo->prepare("UPDATE `stats2` SET `known`=`known` + 1 WHERE date=CURDATE() AND  user=?");
        $stmt->execute(array($this->user));
    }
}