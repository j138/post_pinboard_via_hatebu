## 使い方
Web Hookの受け取り先の登録をします。Web Hook用のキーを発行し、あらかじめメモっておいてください。URLのHATENA_USERIDは自分のIDへ
 - http://b.hatena.ne.jp/[HATENA_USERID]/config#tabmenu-config_table_coop


次に、post_pinboard_via_hatebu.phpのファイル上のdefineを書き換えます。

    define('HATENA_WEBHOOK_KEY', 'YOUR_WEBHOOK_KEY'); // WEBHOOK用のAPIキーを適宜書き換え
    define('PINBOARD_USER', 'YOUR_ID'); // pinboardのid
    define('PINBOARD_PASSWORD', 'YOUR_PASSWORD');  // pinboardのパスワード


submoduleとしてpinboard-apiのライブラリを追加します。

    git submodule add https://github.com/kijin/pinboard-api.git


gitコマンドが無理なら**pinboard-api/pinboard-api.php**にファイルを設置

    mkdir pinboard-api
    wget https://raw.github.com/kijin/pinboard-api/master/pinboard-api.php -O pinboard-api/pinboard-api.php


あとは、はてブした際、pinboardにブックマークされていればOK!

