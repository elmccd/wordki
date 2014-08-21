<?php

$app->post('/rest/cats/add', function() use ($app) {
    $cats_model = new App\Model\Cats();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    $get = $cats_model->addCategory($app->request()->params('name'), $app->request()->params('id'));
    echo json_encode($get);
});

$app->post('/rest/cats/remove', function() use ($app) {
    $cats_model = new App\Model\Cats();
    $cats_model->removeCat($app->request()->params('id'));
});

$app->post('/rest/cats/clearstats', function() use ($app) {
    $cats_model = new App\Model\Cats();
    $cats_model->clearStats($app->request()->params('id'));
});

?>