<?php

session_start();

// $_SESSION['oauth_token'] = 'eyJraWQiOiJLQk5qRlhHODhoWm1UQXZmY2xDMVU1cTlPeWpqOUxYZndmSjUwdWN0dEQ4IiwiYWxnIjoiUlMyNTYifQ.eyJ2ZXIiOjEsImp0aSI6IkFULlZkMWluOWlxOWg2bkVacU1heEZQaDZYdVFwSFpyMzM0b3o5eFQybTFQMVEiLCJpc3MiOiJodHRwczovL2Rldi0zNjIzODMub2t0YS5jb20vb2F1dGgyL2RlZmF1bHQiLCJhdWQiOiJhcGk6Ly9kZWZhdWx0IiwiaWF0IjoxNTg2OTQxNzE3LCJleHAiOjE1ODY5NDUzMTcsImNpZCI6IjBvYTNqNmVtZ2hXMUV2UTlQMzU3Iiwic2NwIjpbImNvbS5sdWNpZHdvcmtzLmNsb3VkLnNlYXJjaC5zb2xyLmN1c3RvbWVyIl0sInN1YiI6IjBvYTNqNmVtZ2hXMUV2UTlQMzU3IiwiZnVzaW9uLWdyb3VwcyI6WyJhZG1pbiJdfQ.qdoYBJbfIkpAowHeDCLPwfJD-ygbz--EPvlmSbITWmfQAE7Uzqo84bwHAncPdcKM1pyu-R64Fexp7w-39PUdMxHtMOxb3cf43QI2HwQ1R2HAHVMe-VRm-DbmEtwdt2vFkMnXh-2-4QOBX5u7Wqr3TuFYLGeXDk_Ux7vhwavnCxq75P5-ZrahFPSj7_X2MTnnbgM38slQmZh4SUAxKHF96jMgnUuTar9Ygh8wuBcY56lfoS6P59Z2kVXRXwax9D5PHj61oFl9jTW2Q6itu-hsLTSZIh5yw0AZMe20HVm41IzRDyqgyn1x20TqTTb6LwS5oNYK2Jp_YlZ8AIYSYzEmqQ';

require(__DIR__.'/init.php');
htmlHeader();

// check solarium version available
echo 'Solarium library version: ' . Solarium\Client::VERSION . ' - ';

// create a client instance
$client = new Solarium\Client($config);
echo '<br/>Session path: '.session_save_path();
// create a ping query
$ping = $client->createPing();

// execute the ping query
try {
    $result = $client->ping($ping);
    echo 'Ping query successful';
    echo '<br/><pre>';
    var_dump($result->getData());
    echo '</pre>';
} catch (Solarium\Exception $e) {
    echo 'Ping query failed';
}

htmlFooter();
