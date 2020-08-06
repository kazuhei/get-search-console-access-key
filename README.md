# これはなに
Google Search Consoleのアクセスキーを取るためだけのコードです

# 使い方
https://console.developers.google.com/apis/credentials からOAuth 2.0 クライアントIDを追加します。
追加する際の「承認済みの JavaScript 生成元」を`http://localhost:8000`、「承認済みのリダイレクト URI」を `http://localhost:8000/oauth2callback.php` とします。

ダウンロードしたjsonをclient_id.jsonという名前でvendorと同階層に配置します。

以下のコマンドで起動します。

`php -S localhost:8000 -t ./`

# 参考
こちらのサイトをとても参考にしました。ありがとうございます。

https://yukiyuriweb.com/call-google-search-console-api-using-google-apis-client-library-for-php/
