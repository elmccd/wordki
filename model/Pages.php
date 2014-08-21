<?php

namespace App\Model;
use PDO;

class Pages extends App {

    public $user;
    public $user_session;

    public function __construct(){

        parent::__construct();

        $this->user_session=(@$_COOKIE['user'])?@$_COOKIE['user']:false;
        $user = $this->getUser();
        $this->user = $user[2];
    }

    public function registerUser($name, $pass, $mail){
        $pass = $this->hashPass($pass);
        $q = $this->pdo->prepare("INSERT INTO `users`(`name`, `pass`, `mail`) VALUES (?, ?, ?)");
        $q->execute(array($name, $pass, $mail));
        return $this->pdo->lastInsertId();
    }

    public function loginUser($name, $pass){
        $pass = $this->hashPass($pass);
        $q = $this->pdo->prepare("SELECT id from users WHERE (name=? OR mail=?) AND pass=?");
        $q->execute(array($name, $name, $pass));
        $result = $q->fetchAll(PDO::FETCH_NUM);
        if(count($result)>0){
            $session_id=md5(time().$result[0][0].'%d90@l;(153^Y_#NS3');
            $q = $this->pdo->prepare("INSERT INTO `sessions`(`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_id`) VALUES (?,?,?,NOW(),?)");
            $q->execute(array($session_id, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $result[0][0]));
            setcookie("user", $session_id, time()+3600*24*7);
            return true;
        } else {
            return false;
        }
    }

    public function getUser(){
        if($this->user_session){
            $q = $this->pdo->prepare("SELECT name, mail, id FROM `users`
JOIN sessions
ON users.id=sessions.user_id
WHERE sessions.session_id=?");
            $q->execute(array($this->user_session));
            $result = $q->fetchAll(PDO::FETCH_NUM);
            if(count($result)>0){
                return $result[0];
            }
            return false;
        }
        return false;
    }

    private function hashPass($pass){
        return sha1($pass."$%^&*()BN894165*&U*HY*asdnjyvgdsf");
    }

    public function isUser(){
        if($this->getUser())
            return true;
        return false;
    }

    public function logOut(){
        $q = $this->pdo->prepare("DELETE FROM `sessions` WHERE `session_id`=? AND `user_id`=?");
        $q->execute(array($this->user_session, $this->user));
        setcookie("user", "", time() - 3600);
    }
}