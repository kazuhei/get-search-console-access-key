<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
// 認証情報の読み込み
$client->setAuthConfig('client_id.json');
// スコープの設定
$client->addScope(Google_Service_Webmasters::WEBMASTERS);

// アクセストークンが未取得、もしくはアクセストークンの有効期限を過ぎていたらoauth2callback.phpへリダイレクト
if (isset($_SESSION['access_token']) && $_SESSION['access_token']):
    $client->setAccessToken($_SESSION['access_token']);
    if ($client->isAccessTokenExpired()):
        redirectToCallback();
    endif;
else:
    redirectToCallback();
endif;

// アクセストークンの表示
var_dump($_SESSION['access_token']);

function redirectToCallback()
{
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit();
}
