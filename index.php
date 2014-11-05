<?php
echo "Hello Heroku World!";
$config_load = file_get_contents('setting.json');
$config = json_decode($config_load);
var_dump($config);
?>
