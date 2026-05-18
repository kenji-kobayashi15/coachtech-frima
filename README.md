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

## データベース設計（ER図）

GitHub等では、以下のMermaidコードが自動的にグラフィカルなER図としてレンダリングされます。

```mermaid
erDiagram
Users ||--o{ Items : "出品する (seller_id)"
Users ||--o{ Likes : "いいねする"
Users ||--o{ Comments : "コメントする"
Users ||--o{ Orders : "注文する"
Users ||--o| Profiles : "プロフィールを持つ"

    Items ||--o{ Likes : "いいねされる"
    Items ||--o{ Comments : "コメントされる"
    Items ||--o| Orders : "注文される"
    Items }|--|| Conditions : "状態を持つ"

    Items ||--o{ CategoryItem : "属する"
    Categories ||--o{ CategoryItem : "含まれる"

    Users {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    Profiles {
        bigint id PK
        bigint user_id FK "Users.id"
        string image_url
        string post_code
        string address
        string building
        timestamp created_at
        timestamp updated_at
    }

    Items {
        bigint id PK
        bigint user_id FK "Users.id (seller)"
        bigint condition_id FK "Conditions.id"
        string name
        string brand
        integer price
        text description
        string image_url
        timestamp created_at
        timestamp updated_at
    }

    Categories {
        bigint id PK
        string name
        timestamp created_at
        timestamp updated_at
    }

    CategoryItem {
        bigint id PK
        bigint item_id FK "Items.id"
        bigint category_id FK "Categories.id"
        timestamp created_at
        timestamp updated_at
    }

    Conditions {
        bigint id PK
        string name
        timestamp created_at
        timestamp updated_at
    }

    Likes {
        bigint id PK
        bigint user_id FK "Users.id"
        bigint item_id FK "Items.id"
        timestamp created_at
        timestamp updated_at
    }

    Comments {
        bigint id PK
        bigint user_id FK "Users.id"
        bigint item_id FK "Items.id"
        string comment "max 255 chars"
        timestamp created_at
        timestamp updated_at
    }

    Orders {
        bigint id PK
        bigint user_id FK "Users.id"
        bigint item_id FK "Items.id"
        string payment_method "コンビニ, カード"
        string post_code
        string address
        string building
        timestamp created_at
        timestamp updated_at
    }
```

## セットアップ手順（ターミナル操作）

### 1. リポジトリのクローン

このプロジェクトは、以下のテンプレートリポジトリからクローンして作成しています。

```bash
git clone git@github.com:Estra-Coachtech/laravel-docker-template.git
cd coachtech-frima
```

### 2. 環境設定ファイルの準備

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
