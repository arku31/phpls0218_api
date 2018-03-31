<?php
require 'vendor/autoload.php';
use Andreyco\Instagram\Client as Instagram;

$instagram = new Instagram([
    'apiKey'      => '6581b1d606c34f8682b838670c94d784',
    'apiSecret'   => '086956c5664e4d779775191ea7ba52fc',
    'apiCallback' => 'http://api.loft/instagram.php'
]);

echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";


if ($_GET['code']) {
    $token = $instagram->getOAuthToken($_GET['code']);
    $user = $token->user;

    $instagram->setAccessToken($token);
    $user = $instagram->getUser('arku31');
    $photos = $instagram->getUserMedia('self', 10);
    echo "<pre>";
    print_r($photos);
    die();
}