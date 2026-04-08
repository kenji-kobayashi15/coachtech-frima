# coachtechフリマ

## プロジェクト概要

このプロジェクトは、アイテムの出品と購入を行うための独自のフリマアプリです。
10代から30代の社会人をターゲットとし、シンプルな操作で商品の売買ができるプラットフォームを提供します。

### 主な機能

- **ユーザー認証**: 会員登録、ログイン、ログアウト（Fortify）
- **商品一覧・検索**: 全商品の一覧表示、商品名による部分一致検索
- **商品詳細**: 商品情報（画像、価格、説明等）の確認、いいね、コメント投稿
- **出品**: 商品画像のアップロード、カテゴリ（複数選択可）、状態設定、価格設定
- **購入**: クレジットカード決済（Stripe対応）、コンビニ支払い、配送先変更
- **プロフィール**: プロフィール画像、ユーザー名、住所設定、出品/購入履歴の確認

## 開発環境

以下の環境で動作を確認しています。

- **Framework**: Laravel 8.75
- **PHP**: 8.1
- **Database**: MySQL 8.0.26
- **Web Server**: Nginx 1.21.1
- **Others**:
  - Laravel Sanctum / Fortify (認証)
  - Laravel Mix (フロントエンドビルド)
  - Stripe (決済連携)
  - phpMyAdmin (DB管理ツール: ポート 8080)

## セットアップ手順（ターミナル操作）

### 1. リポジトリのクローン

このプロジェクトは、以下のテンプレートリポジトリからクローンして作成しています。

```bash
git clone git@github.com:Estra-Coachtech/laravel-docker-template.git
cd coachtech-frima
```

### 2. 環境設定ファイルの準備

機密情報（DBパスワード等）は直接READMEに記載しないでください。必ず `.env.example` をコピーして設定を行ってください。

```bash
cp src/.env.example src/.env
```

### 3. Dockerコンテナの起動

```bash
docker-compose up -d --build
```

### 4. アプリケーションの初期化

```bash
# ライブラリのインストール
docker-compose exec php composer install

# アプリケーションキーの生成
docker-compose exec php php artisan key:generate

# ストレージのシンボリックリンク作成
docker-compose exec php php artisan storage:link
```

### 5. データベースの構築

```bash
# マイグレーションの実行
docker-compose exec php php artisan migrate

# 初期データ（シーダー）の投入
docker-compose exec php php artisan db:seed
```

### 6. フロントエンドアセットのビルド（必要に応じて）

※ ローカル環境に Node.js がインストールされている場合

```bash
npm install
npm run dev
```

## ディレクトリ構造

主要なディレクトリの構成は以下の通りです。

```text
.
├── docker/              # Docker設定ファイル（PHP, Nginx, MySQL等）
├── docs/                # プロジェクト要件・設計ドキュメント
├── src/                 # Laravelアプリケーション本体
│   ├── app/             # Controller, Model, Middleware, Providers
│   ├── bootstrap/       # フレームワークの起動設定
│   ├── config/          # アプリケーション設定ファイル
│   ├── database/        # Migrations, Factories, Seeders
│   ├── public/          # 公開ディレクトリ、エントリーポイント
│   ├── resources/       # Views (Blade), Assets (JS, CSS), Lang
│   ├── routes/          # ルーティング（web.php, api.php等）
│   ├── storage/         # ログ、アップロードファイル、キャッシュ
│   └── tests/           # テストコード
└── docker-compose.yml   # Docker Compose構成ファイル
```

## テスト手順

PHPUnitを使用してテストを実行します。

```bash
docker-compose exec php php artisan test
```

## 注意点

- **環境設定**: 実際のDBパスワードやAPIキーなどの機密情報は、`.env` ファイルに記述してください。`.env` ファイルはGitの管理対象外（`.gitignore` に記載済み）としてください。
- **ファイル権限**: `storage` および `bootstrap/cache` ディレクトリには、Webサーバーからの書き込み権限が必要です。
# laravel-docker-template
