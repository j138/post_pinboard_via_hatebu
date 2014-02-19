## 使い方
apacheのディレクトリ配下に移動し、リポジトリをチェックアウト

```
cd /var/www/html/
git clone https://github.com/j138/post_pinboard_via_hatebu.git
```

Web Hookの受け取り先の登録をします。Web Hook用のキーを発行し、あらかじめメモっておいてください。URLのHATENA_USERIDは自分のIDへ
 - http://b.hatena.ne.jp/HATENA_USERID/config#tabmenu-config_table_coop
![設定例](http://i.imgur.com/Q6M7R7T.png "設定例")

次に、以下URLを開き、pinbaordのAPI Tokenをメモします。 # 例) user:0123456789
https://pinboard.in/settings/password

setting.json.defaultをコピーし、setting.jsonとして保存します。

次に、setting.jsonのファイルを開き、
hatena_webhook_keyの値に、はてなのwebhookキーを、
pinboard_tokenの値に、pinboardのAPI Tokenへ書き換えます。

submoduleとしてpinboard-apiのライブラリを追加します。

    git submodule add https://github.com/kijin/pinboard-api.git

git-submoduleコマンドができないならpinboard-api/pinboard-api.phpにファイルを設置

    mkdir pinboard-api
    wget https://raw.github.com/kijin/pinboard-api/master/pinboard-api.php -O pinboard-api/pinboard-api.php

あとは、はてブした際、pinboardにブックマークされていればOK!

