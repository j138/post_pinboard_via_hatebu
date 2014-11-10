<?php
// はてなブックマークのWEBHOOKから、pinboardへブックマークするスクリプト
// config読み込み
$config_load = file_get_contents('setting.json');
$config = json_decode($config_load);

echo "config_load<hr />";
var_dump($config_load);

echo "config<hr />";
var_dump($config);

echo "_POST</hr />";
var_dump($_POST);

echo "_SERVER</hr />";
var_dump($_SERVER);

exit;
