<?php
header('Content-Type: application/json; charset=utf-8');

$sess = $_COOKIE['fpds_access'] ?? '';
if (!$sess || !preg_match('/^[a-f0-9]{64}$/', $sess)) {
    http_response_code(401);
    echo json_encode(['ok' => true, 'authorized' => false]);
    exit;
}

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$data = $redis->get("fpds:session:$sess");
if (!$data) {
    http_response_code(401);
    echo json_encode(['ok' => true, 'authorized' => false]);
    exit;
}

$payload = json_decode($data, true) ?: [];
echo json_encode([
  'ok' => true,
  'authorized' => true,
  'user_id' => $payload['user_id'] ?? null,
  'plan' => $payload['plan'] ?? null,
]);
