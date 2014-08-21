<?php

/**
 * Return all words list
 */
$app->get('/rest/get/allwords', function() use ($app) {
    $words_model = new App\Model\Words();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    echo json_encode($words_model->getAllWords());
});

/**
 * Add word from panel
 */
$app->post('/rest/increase/add', function() use ($app) {
    $stats_model = new App\Model\Stats();
    $pl=$app->request()->params('pl');
    $en=$app->request()->params('en');
    $cat=$app->request()->params('cat_id');
    $context='0';
    $sound_id=$app->request()->params('sound_id');
    $stats_model->increaseAdd($pl, $en, $context, $sound_id, $cat);
});


/**
 * Return translation of word in json
 */
$app->get('/rest/translate/:en', function($en) use ($app) {
    $translate = new App\Lib\Translate\Translate();

    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    $translate->setWord($en);
    echo json_encode($translate->getWords());
});

/**
 * Remove word
 */
$app->post('/rest/remove/one', function() use ($app) {
    $words_model = new App\Model\Words();
    $words_model->removeOne($app->request()->params('id'));
});

/**
 * Get all cats
 */
$app->get('/rest/get/cats', function() use ($app) {
    $words_model = new App\Model\Words();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    echo json_encode($words_model->getCats());
});