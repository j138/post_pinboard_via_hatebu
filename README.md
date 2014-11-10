[![wercker status](https://app.wercker.com/status/27e6fdbf265be790ba608bda0f52efcd/m "wercker status")](https://app.wercker.com/project/bykey/27e6fdbf265be790ba608bda0f52efcd)

## 使い方
herokuボタンを押すか、手動でインストールのどちらかが選べます。

## herokuにインストール
ぽちっと押してherokuにとんだあと、各APIキーを設定してください。APIキーの取得の仕方は下記参照。

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)


## はてブのトークンと設定
APIキーの取得してください。
ホスト名は、deployした後に出るので、キーだけ受け取って、「あとでイベント通知を受け取るイベント」を登録してください。

**URLのUSERIDは自分のはてなIDへ書き換えて飛んでください**

http://b.hatena.ne.jp/USERID/config#tabmenu-config_table_coop


イベント受取先のURLは下記を想定してますので、デプロイあとに設定してください。
**UR-APPNAMEは適宜変更してください**

 **https://UR-APPNAME.herokuapp.com/app.php**


設定例はこんなかんじです。
![設定例](http://i.imgur.com/Q6M7R7T.png "設定例")


## pinboardのトークンを取得
次に、以下URLを開き、pinbaordのAPI Tokenを取得します。

https://pinboard.in/settings/password

![PinboardのAPI Token](http://i.imgur.com/sfIEXwA.png "PinboardのAPI Token")


## 手動でインストール
apacheのディレクトリ配下に移動し、リポジトリをチェックアウト

```
cd /var/www/html/
git clone https://github.com/j138/post_pinboard_via_hatebu.git
```

urwebserver.com/index.phpにアクセスし、各APIキーを設定するか、
直接setting.jsonを開き記述してください。

index.phpには、basic認証がかかっており、ID/PASSWDの初期値は下記になってます。これも、setting.jsonに記載されています。

初期値: root:alpine
