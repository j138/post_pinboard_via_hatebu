# 使い方
1. 下記ページで、Web Hookの受け取り先の登録をします。HATENA_USERIDは自分のIDへ
    - http://b.hatena.ne.jp/**HATENA_USERID**/config#tabmenu-config_table_coop

2. Web Hook用のキーを発行し、あらかじめメモっておきます。

3. **post_pinboard_via_hatebu.php**のファイルの上のdefineを書き換えます。
    - 2.でメモったはてブのwebhook用のキー
    - pinboardのID
    - pinboardのPASSWORD

4. submoduleとしてpinboard-apiのライブラリを追加
    - % git submodule add https://github.com/kijin/pinboard-api.git

5. gitコマンドが無理なら**pinboard-api/pinboard-api.php**にファイルを設置
    - % mkdir pinboard-api
    - % wget https://raw.github.com/kijin/pinboard-api/master/pinboard-api.php -O pinboard-api/pinboard-api.php

6. はてブした際、pinboardにブックマークされていればOK!


** 書き換える場所は以下

>define('HATENA_WEBHOOK_KEY', 'YOUR_WEBHOOK_KEY'); // WEBHOOK用のAPIキーを適宜書き換え

>define('PINBOARD_USER', 'YOUR_ID'); // pinboardのid

>define('PINBOARD_PASSWORD', 'YOUR_PASSWORD');
