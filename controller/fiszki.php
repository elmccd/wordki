<?php

/**
 * Add one more studied word
 */
$app->post('/rest/increase/studied', function() use ($app) {
    $stats_model = new App\Model\Stats();
    echo $app->request()->params('id');
    $stats_model->increaseStudied($app->request()->params('id'));
});

/**
 * Add one more word you already known
 */
$app->post('/rest/increase/known', function() use ($app) {
    $stats_model = new App\Model\Stats();
    $stats_model->increaseKnown($app->request()->params('id'));
});

/**
 * Get random word to flashcard
 */
$app->get('/rest/get/randomword', function() use ($app) {
    $flashcards_model = new App\Model\Flashcards();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    echo json_encode($flashcards_model->getRandomWord());
});

/**
 * Move item to box up
 */
$app->post('/rest/fiszki/increasebox', function() use ($app) {
    $flashcards_model = new App\Model\Flashcards();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    echo json_encode($flashcards_model->increaseBox($app->request()->params('id')));
});

/**
 * Move item to box down
 */
$app->post('/rest/fiszki/decreasebox', function() use ($app) {
    $flashcards_model = new App\Model\Flashcards();
    $res = $app->response();
    $res['Content-Type'] = 'application/json';
    echo json_encode($flashcards_model->decreaseBox($app->request()->params('id')));
});