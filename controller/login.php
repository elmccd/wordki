<?php

/**
 * Add one more studied word
 */
$app->get('/register', function() use ($app) {
    $login_model = new App\Model\Login();
    session_start(); //session for flash errors
    if($login_model->isUser())
        $app->redirect('words');
    $app->render('template/header-index.php');
    $app->render('register.php', array('error' => ($data=@$_SESSION['slim.flash']['error'])?$data:''));
    $app->render('template/footer-index.php');
});


$app->post('/register', function() use ($app) {
    $login_model = new App\Model\Login();
    session_start(); //session for flash errors
    $name = $app->request()->params('name');
    $pass = $app->request()->params('pass');
    $pass_repeat = $app->request()->params('pass_repeat');
    $mail = $app->request()->params('mail');
    if($name!='' && $pass!='' && $mail!='' &&  $pass == $pass_repeat){
        if($id = $login_model->registerUser($name, $pass, $mail)){
            $stats_model = new App\Model\Stats();
            $stats_model->addEmptyStat($id);
            if($login_model->loginUser($name, $pass)){
                $app->redirect('words');
            }
        } else {
            $app->flash('error', 'Nazwa użykownika, lub adres e-mail jest już zajęty!');
        }
    }
    $app->redirect('register');
});

$app->get('/login', function() use ($app) {
    $login_model = new App\Model\Login();

    if($login_model->isUser())
        $app->redirect('words');
    $app->render('template/header-index.php');
    $app->render('login.php');
    $app->render('template/footer-index.php');
});

$app->post('/login', function() use ($app) {
    $login_model = new App\Model\Login();

    $name = $app->request()->params('name');
    $pass = $app->request()->params('pass');
    if($login_model->loginUser($name, $pass)){
        $app->redirect('words');
    } else {
        $app->redirect('login');
    }
});

$app->get('/logout', function() use ($app) {
    $login_model = new App\Model\Login();

    $login_model->logout();
    $app->redirect('login');
});
