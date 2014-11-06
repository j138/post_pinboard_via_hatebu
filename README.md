## 使い方

はじめに、herokuボタンを押すか、手動でインストール
## herokuにインストール
[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## 手動でインストール
apacheのディレクトリ配下に移動し、リポジトリをチェックアウト

```
cd /var/www/html/
git clone https://github.com/j138/post_pinboard_via_hatebu.git
```

## TOKENの設定
Web Hookの受け取り先の登録をします。Web Hook用のキーを発行し、あらかじめメモっておいてください。URLのHATENA_USERIDは自分のIDへ書き換え
 - http://b.hatena.ne.jp/HATENA_USERID/config#tabmenu-config_table_coop
![設定例](http://i.imgur.com/Q6M7R7T.png "設定例")

次に、以下URLを開き、pinbaordのAPI Tokenをメモします。
![PinboardのAPI Token](http://i.imgur.com/sfIEXwA.png "PinboardのAPI Token")

https://pinboard.in/settings/password

urwebserver.com/index.phpにアクセスし、各APIキーを設定するか、
直接setting.jsonを開き記述してください。

## 確認
はてブした際、pinboardにブックマークされていればOK!

