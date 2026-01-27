<?php
$ticket = $_GET['ticket'] ?? '';
$redirect = $_GET['redirect'] ?? '/query';

if (!preg_match('/^[a-f0-9]{64}$/', $ticket)) {
    http_response_code(400);
    echo "bad_ticket";
    exit;
}

if (!preg_match('~^/[A-Za-z0-9/_\-\.]*$~', $redirect)) {
    $redirect = '/query';
}

try {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379, 1.0);

    $key = "laravel_database_fpds:ticket:$ticket";

    $data = $redis->get($key);
    if (!$data) {
        http_response_code(403);
        echo "expired";
        exit;
    }

    $redis->del($key);

    $sess = bin2hex(random_bytes(32));
    $redis->setex("fpds:session:$sess", 3600, $data);
} catch (Throwable $e) {
    http_response_code(403);
    echo "auth_unavailable";
    exit;
}

setcookie('fpds_access', $sess, [
  'expires'  => time() + 3600,
  'path'     => '/',
  'domain'   => 'fpds.getwab.com',
  'secure'   => true,
  'httponly' => true,
  'samesite' => 'Lax',
]);

header('Location: /query', true, 302);
exit;
