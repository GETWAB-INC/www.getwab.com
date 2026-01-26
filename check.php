<?php
$sess = $_COOKIE['fpds_access'] ?? '';
if (!$sess || !preg_match('/^[a-f0-9]{64}$/', $sess)) {
    http_response_code(401);
    exit;
}

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$data = $redis->get("fpds:session:$sess");
if (!$data) {
    http_response_code(401);
    exit;
}

http_response_code(204);
exit;
