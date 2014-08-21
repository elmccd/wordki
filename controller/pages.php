<?php

/**
 * View
 */
$app->get('/', function() use ($app) {
    $login_model = new App\Model\Login();
    if($login_model->isUser()){
        $app->render('template/header.php', array('user' => $login_model->getUser()));
    } else {
        $app->render('template/header-index.php');
    }
    $app->render('index.php');
    $app->render('template/footer-index.php');
});

$app->get('/words', function() use ($app) {
    $login_model = new App\Model\Login();
    if(!$login_model->isUser()){
        $app->redirect('login');
    }
    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('words.php');
    $app->render('template/footer.php');
});

$app->get('/words-import', function() use ($app) {
    $login_model = new App\Model\Login();
    if(!$login_model->isUser())
        $app->redirect('login');

    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('words-import.php');
    $app->render('template/footer.php');
});

$app->get('/words-export', function() use ($app) {
    $login_model = new App\Model\Login();
    $words_model = new App\Model\Words();
    if(!$login_model->isUser())
        $app->redirect('login');

    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('words-export.php', array('cats' => $words_model->getCats()));
    $app->render('template/footer.php');
});

$app->get('/stats', function() use ($app) {
    $login_model = new App\Model\Login();
    $stats_model = new App\Model\Stats();
    if(!$login_model->isUser())
        $app->redirect('login');
    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('stats.php', array('data' => $stats_model->getCountStats()));
    $app->render('template/footer.php');
});

$app->get('/fiszki', function() use ($app) {
    $login_model = new App\Model\Login();
    if(!$login_model->isUser())
        $app->redirect('login');
    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('fiszki.php');
    $app->render('template/footer.php');
});

$app->get('/cats', function() use ($app) {
    $login_model = new App\Model\Login();
    if(!$login_model->isUser())
        $app->redirect('login');
    $app->render('template/header.php', array('user' => $login_model->getUser()));
    $app->render('cats.php');
    $app->render('template/footer.php');
});

$app->get('/traits', function() use ($app) {
    trait Boo {
        public function boo(){
            echo 3;
            return ['one', 'two', 'three'];
        }
    }
    class SayBoo {
        use Boo;
    }
    echo (new SayBoo)->boo()[0];
});