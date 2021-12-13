## セットアップ

$ git clone git@github.com:hayashitanikazunori/minecraft-web.git
$ cd backend
$ cp .env.example .env
$ cp .env.example .env.testing
$ cd ..
$ make init
**envファイルのDB_HOSTはdocker-composeファイルのコンテナ名に合わせること。**

## 各コマンド
##### Resourceファイルの作成
`docker compose exec app php artisan make:resource リソースファイル名`  

##### Controllerファイルの作成
`docker compose exec app php artisan make:controller コントローラーファイル名`  
resourceオプションをつけるとCRUDのfuncを用意してくれる。
`--resource`

##### Requestファイルの作成
`docker compose exec app php artisan make:request リクエストファイル名`  

##### FeatureTestファイルの作成
`docker compose exec app php artisan make:test テストファイル名`  
