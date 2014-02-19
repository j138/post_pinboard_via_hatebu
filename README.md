## 使い方
apacheのディレクトリ配下に移動し、リポジトリをチェックアウト

```
cd /var/www/html/
git clone https://github.com/j138/post_pinboard_via_hatebu.git
```

Web Hookの受け取り先の登録をします。Web Hook用のキーを発行し、あらかじめメモっておいてください。URLのHATENA_USERIDは自分のIDへ書き換え
 - http://b.hatena.ne.jp/HATENA_USERID/config#tabmenu-config_table_coop
![設定例](http://i.imgur.com/Q6M7R7T.png "設定例")

次に、以下URLを開き、pinbaordのAPI Tokenをメモします。
![PinboardのAPI Token](http://i.imgur.com/sfIEXwA.png "PinboardのAPI Token")

https://pinboard.in/settings/password

setting.json.tmplをコピーし、setting.jsonとして保存します。

次に、setting.jsonのファイルを開き、
hatena_webhook_keyの値に、はてなのwebhookキーを、
pinboard_tokenの値に、pinboardのAPI Tokenへ書き換えます。

はてブした際、pinboardにブックマークされていればOK!

