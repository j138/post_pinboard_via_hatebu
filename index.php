<?php
$msg = '';

$config_file_name = 'setting.json';
$config_load = file_get_contents($config_file_name);
$config = json_decode($config_load, true);

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
      e.g. http://example.com/post_pinboard_via_hatebu.php
    </p>

    <hr />

    <form method="post">
      <a href="http://b.hatena.ne.jp/" target="_blank">hatena_webhook_key</a>: <input type="text" name="hatena_webhook_key" value="<?=$config['hatena_webhook_key']?>" /><br />
      <a href="https://pinboard.in/settings/password" target="_blank">pinboard_token</a>: <input type="text" name="pinboard_token" value="<?=$config['pinboard_token']?>" /></br />
      <input type="submit" value="save" />
    </form>
  </body>
</html>
