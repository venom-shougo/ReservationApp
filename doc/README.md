# sampleDocker

## 開発環境構築前の準備

- Githubのアカウント取得

- ローカルにgitconfigの設定をする

gitconfigの設定確認を下記コマンでする

```code
git config --global --edit
```

ユーザ名とメールアドレスを設定しておく

※下記の`My Name`と`myname@example.com`は自身のGithubアカウントにする

```code
git config --global user.name "My Name"
git config --global user.email myname@example.com
```

- SSHKeyを生成してGithubに登録

下記リンクを参考にSSHKeyを生成してGithubに登録してほしい

[GitHubでssh接続する手順ー公開鍵・秘密鍵の生成からー](https://qiita.com/shizuma/items/2b2f873a0034839e47ce)

## 開発環境構築方法

- リモートリポジトリから`git clone`してくる

```code
git clone git@github.com:HOMEGARDIANS/BlogAPI-PurePHP.git
```

- docker-composeを起動する

プロジェクトルートにディレクトリを移動して、`docker-compose up -d`コマンド実行する。

```code
cd BlogAPI-PurePHP
docker-compose up -d
```

## データベースに接続する

### データベース接続の準備

- `.env-example`ファイルをプロジェクトルートに用意しているので
`.env-example`ファイルをコピーして`.env`ファイルを作成し、
デフォルト値を置き換えて使用する

### PHPMyadminを使用する場合

ブラウザで`http://localhost:8080`にアクセスしてPHPMyAdminを開く

※キャッシュがない状態が好ましいので、シークレットモードでブラウザを開いてください。
※シークレットモードでPHPMyAdminが開けない場合は下記のクライアントツールを試してみましょう。

### クライアントツールを使用する

ここではクライアントツールの1つで`Sequel Ace`を使ってDB接続する。

Sequel Aceのインストール方法としてはHomebrewでインストールする方法が簡単でオススメです。

※Homebrewを使うので、Homebrewがインストールがインストール済みであることが前提になります。

```code
brew install --cask sequel-ace
```

Sequel Aceを起動すると下記画面が表示されます。
下記項目を埋めて接続する前に`Test Connection`を実行
「接続が成功しました」とメッセージが表示されたら接続します。

```edit
Name      // 接続名
Host      // 接続先ホスト
Username  // MySQLユーザ名
Password  // MySQLパスワード
Port      // docker-composeで設定したポート番号
```

<img width="1312" alt="スクリーンショット 2022-05-04 16 26 18" src="https://user-images.githubusercontent.com/25321380/166644555-ec20e7f0-d1da-4741-96e5-f062fc9598d2.png">

<img width="1312" alt="スクリーンショット 2022-05-04 16 24 41" src="https://user-images.githubusercontent.com/25321380/166645830-f251709f-29ee-4860-b546-73d0e63203a2.png">

データベースにログインすると、左サイドバーにテーブルのリストが表示されないことがあります。
下のスクリーンショットのようにデータベースの選択プルダウンから該当のデータベースを選択します。

<img width="1205" alt="スクリーンショット 2022-05-04 16 27 16" src="https://user-images.githubusercontent.com/25321380/166646099-3f801344-e22e-4f05-98a1-23d006c0e371.png">

下のように左サイドバーに設定したテーブルが表示できればOKです。
データベースを選択してもテーブルが表示されなときは、dumpファイルをインポートするか、テーブルを作成しましょう。

<img width="1312" alt="スクリーンショット 2022-05-04 17 27 50" src="https://user-images.githubusercontent.com/25321380/166646669-33984dc0-43fb-4e3a-b2db-2b54968f9e54.png">

最後に、接続先はお気に入り登録しておくと次回以降はログイン情報を入力しないでもデータベース接続できるようになるので、
お気に入り登録をオススメします。

<img width="1312" alt="スクリーンショット 2022-05-04 16 28 28" src="https://user-images.githubusercontent.com/25321380/166647083-a81b4891-8105-401e-8f83-d5acf4cb780a.png">

<img width="1312" alt="スクリーンショット 2022-05-04 16 28 36" src="https://user-images.githubusercontent.com/25321380/166646513-dc631e39-0043-4532-b8f7-70593a699483.png">
