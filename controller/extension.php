<?php
/**
 * REST Extensions routing
 */

/**
 * Add one more view word
 */
$app->get('/rest/increase/view', function() use ($app) {
    $stats_model = new App\Model\Stats();
    $stats_model->increaseView();
});

/**
 * Add one more added word
 */
$app->get('/rest/increase/add/:pl/:en/:context/:sound_id', function($pl, $en, $context, $sound_id) use ($app) {
    $stats_model = new App\Model\Stats();
    $stats_model->increaseAdd($pl, $en, $context, $sound_id, 24);
});
