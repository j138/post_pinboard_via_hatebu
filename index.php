<?php
$config_file_name = 'setting.json';
$config_load = file_get_contents($config_file_name);
$config = json_decode($config_load, true);

switch (true) {
    case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
    case $_SERVER['PHP_AUTH_USER'] !== $config['basic_auth_user']:
    case $_SERVER['PHP_AUTH_PW']   !== $config['basic_auth_pw']:
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        header('Content-Type: text/plain; charset=utf-8');
        die('このページを見るにはログインが必要です');
}

// heroku側でAPIキーが設定されていれば、それらを優先
if(isset($_SERVER['HATENA_WEBHOOK_KEY']) && $_SERVER['HATENA_WEBHOOK_KEY'] !== 'SET_UR_WEBHOOK_KEY'){
  exit('heroku側でAPIキーが設定済みです');
}

$msg = '';

$key_list = array('hatena_webhook_key', 'pinboard_token');
$save_flg = true;
foreach ($key_list as $key) {
    if ( isset($_POST[$key]) && $_POST[$key] !== '') {
        $config[$key] = $_POST[$key];
    } else {
        $save_flg = false;
    }
}

if($save_flg == true) {
    file_put_contents($config_file_name, json_encode($config));
    $msg = 'APIキーを設定しました。';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <p style="color:red"><?=$msg?></p>

    <p>
      hatena_webhook_keyとpinboard_tokenを各リンク先から拾ってきて入力してください。
    </p>

    <p>
      APIキー設定後、[http://b.hatena.ne.jp/UR_HATENA_ID/config]のWeb Hookの項目にイベントを受け取るURLを入力してください。<br />
      e.g. <?=sprintf('%s://%s/app.php', $_SERVER['REQUEST_SCHEME'], $_SERVER['HTTP_HOST'])?>
    </p>

    <hr />

    <form method="post">
      <a href="http://b.hatena.ne.jp/" target="_blank">hatena_webhook_key</a>: <input type="text" name="hatena_webhook_key" value="<?=$config['hatena_webhook_key']?>" /><br />
      <a href="https://pinboard.in/settings/password" target="_blank">pinboard_token</a>: <input type="text" name="pinboard_token" value="<?=$config['pinboard_token']?>" /></br />
      <input type="submit" value="save" />
    </form>
  </body>
</html>
