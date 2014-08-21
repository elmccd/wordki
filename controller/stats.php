<?php

/**
 * Return all stats for graph in json
 */
$app->get('/rest/get/graph', function() use ($app) {
    $stats_model = new App\Model\Stats();
    echo json_encode($stats_model->getAllStats());
});

$app->get('/rest/get/graph2', function() use ($app) {
    $stats_model = new App\Model\Stats();
    echo json_encode($stats_model->getAllStats2());
});