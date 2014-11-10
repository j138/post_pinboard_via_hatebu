<?php
if ($_GET['x'] !== $_SERVER['BASIC_AUTH_PW']) exit;

$config_load = file_get_contents('setting.json');
$config = json_decode($config_load);

echo "config_load<br />";
var_dump($config_load);
echo "<hr />";

echo "config<br />";
// heroku側でAPIキーが設定されていれば、それらを優先
if(isset($_SERVER['HATENA_WEBHOOK_KEY']) && $_SERVER['HATENA_WEBHOOK_KEY'] !== 'SET_UR_WEBHOOK_KEY'){
  $config->hatena_webhook_key = $_SERVER['HATENA_WEBHOOK_KEY'];
  $config->pinboard_token = $_SERVER['PINBOARD_TOKEN'];
}
var_dump($config);
echo "<hr />";

echo "_POST</br />";
var_dump($_POST);
echo "<hr />";

echo "_SERVER</br />";
var_dump($_SERVER);
echo "<hr />";

