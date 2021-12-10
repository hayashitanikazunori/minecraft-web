## セットアップ

$ git clone git@github.com:hayashitanikazunori/minecraft-web.git
$ cd backend
$ cp .env.example .env
$ cp .env.example .env.testing
$ cd ..
$ make init
**envファイルのDB_HOSTはdocker-composeファイルのコンテナ名に合わせること。**

## 各コマンド

### Resourceファイルの作成
$ php artisan make:resource
