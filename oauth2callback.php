<?php
require_once __DIR__.'/vendor/autoload.php';

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_id.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
$client->addScope(Google_Service_Webmasters::WEBMASTERS_READONLY);

// 認可コードが未取得ならGoogleの認証画面を表示
if (! isset($_GET['code'])) {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
// 認証コードが未取得の場合、認証画面から認可コード付きでリダイレクトされてくるので認可コードを取得してアクセストークンを取得、その後index.phpへリダイレクト
} else {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
