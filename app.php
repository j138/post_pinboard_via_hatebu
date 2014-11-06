<?php
	$_SERVER['HATENA_WEBHOOK_KEY'] = 'hatena_webhook_key';
	$_SERVER['PINBOARD_TOKEN'] = 'pinboard_token';

// はてなブックマークのWEBHOOKから、pinboardへブックマークするスクリプト
// config読み込み
$config_load = file_get_contents('setting.json');
$config = json_decode($config_load);

// heroku側でAPIキーが設定されていれば、それらを優先
if(isset($_SERVER['HATENA_WEBHOOK_KEY']) && $_SERVER['HATENA_WEBHOOK_KEY'] !== 'SET_UR_WEBHOOK_KEY'){
  $config->hatena_webhook_key = $_SERVER['HATENA_WEBHOOK_KEY'];
  $config->pinboard_token = $_SERVER['PINBOARD_TOKEN'];
}

// 意図してない動作はexit
if($config->hatena_webhook_key === 'SET_UR_WEBHOOK_KEY') exit('plz setting webhook-key');
if($_POST['key'] != $config->hatena_webhook_key) exit;
if(!isset($_POST['title'], $_POST['url'], $_POST['status'], $_POST['comment'])) exit;
if($_POST['status'] != 'add' && $_POST['status'] != 'update' && $_POST['status'] != 'delete') exit;


// pinboard用に投稿内容をまとめる
$param = array();
$param['url'] = urldecode($_POST['url']);

// ステータスごとにクエリを生成
switch($_POST['status']) {
    case 'add':
    case 'update':
        $status = 'add';
        $param['description'] = mb_convert_encoding(urldecode($_POST['title']), 'UTF-8', 'auto');
        $param['extended'] = preg_replace('/\[.+\]/', '', mb_convert_encoding(urldecode($_POST['comment']), 'UTF-8', 'auto'));

        if (isset($_POST['is_private'])) {
            $param['shared'] = $_POST['is_private'] == 1 ? 'no' : 'yes';
        }

        // はてブ流のタグの書き方を、pinboard流に変換
        preg_match_all('/\[([^\:\[\]]+)\]/', mb_convert_encoding(urldecode($_POST['comment']), 'UTF-8', 'auto'), $tags_tmp);
        $tags = (empty($tags_tmp[1])) ? '' : $tags_tmp[1];
        $param['tags'] = trim(implode(' ', $tags));
        break;

    case 'delete':
        $status = 'delete';
        break;
    default:
        exit;
}

// curlで投稿
$req_url = 'https://api.pinboard.in/v1/posts/'.$status.'?auth_token='.$config->pinboard_token.'&'. http_build_query($param);

$curl_handle = curl_init();
curl_setopt_array($curl_handle, array(
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_USERAGENT => 'pinboard api client for php',
    CURLOPT_ENCODING => '',
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_FOLLOWLOCATION => 1,
    CURLOPT_MAXREDIRS => 1,
    CURLOPT_HTTPAUTH => CURLAUTH_ANY,
));

curl_setopt($curl_handle, CURLOPT_URL, $req_url);
$response = curl_exec($curl_handle);
$status = (int)curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);

// 200以外はエラー
if($status != 200) {printf("status:%s\nresponse:%s",$status,$response); exit;}

