<?php
// はてなブックマークのWEBHOOKから、pinboardへブックマークするスクリプト

define('HATENA_WEBHOOK_KEY', 'YOUR_WEBHOOK_KEY');      // はてブWEBHOOK用のAPIキーに適宜書き換え
define('PINBOARD_USER', 'YOUR_PINBOARD_USER_ID');      // pinboardのユーザーID
define('PINBOARD_PASSWORD', 'YOUR_PINBOARD_PASSWORD'); // pinboardのパスワード

// 意図してない動作はexit
if($_POST['key'] != HATENA_WEBHOOK_KEY) exit;
if(!isset($_POST['title'], $_POST['url'], $_POST['status'], $_POST['comment'])) exit;
if($_POST['status'] != 'add' && $_POST['status'] != 'update') exit;

// pinboardの初期化から保存まで
require_once 'pinboard-api/pinboard-api.php';
$pinboard = new PinboardAPI(PINBOARD_USER, PINBOARD_PASSWORD);
$bookmark = new PinboardBookmark;
$bookmark->url = urldecode($_POST['url']);
$bookmark->title = mb_convert_encoding(urldecode($_POST['title']), 'UTF-8', 'auto');
$bookmark->description = preg_replace('/\[.+\]/', '', mb_convert_encoding(urldecode($_POST['comment']), 'UTF-8', 'auto'));

preg_match_all('/\[([^\:\[\]]+)\]/', mb_convert_encoding(urldecode($_POST['comment']), 'UTF-8', 'auto'), $tags_tmp);
$tags    = $tags_tmp[1];
if(!empty($tags)) {
    $bookmark->tags = $tags;
}
$bookmark->save();

