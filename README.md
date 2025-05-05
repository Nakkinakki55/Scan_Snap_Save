# ScanSnapSave(QRコード在庫管理Webアプリ)

このプロジェクトでは、ECサイトでの在庫管理を効率化するために、QRコードを活用したWebアプリを開発しました。スマートフォンやタブレットを使用してQRコードをスキャンし、製品の情報をデータベースへ登録・管理できます。加えて、製品画像のアップロード機能も備え、社内で閲覧できるようになっています。

## 特徴
- **PWA対応**：スマホやタブレットでアプリのように使用可能
- **QRコードリーダー搭載**：`jsQR`ライブラリを利用
- **クラウドストレージ**：Amazon S3へ画像をアップロード
- **低コスト運用**：App StoreやGoogle Playの登録不要

## 使用技術
| 技術 | 詳細 |
|------|------|
| **開発言語** | PHP 8.3.19 |
| **フレームワーク** | Laravel 12.1.1 |
| **認証機能** | Laravel Breeze（Bladeテンプレート + Tailwind CSS） |
| **フロントエンド** | PWA（オフライン対応、ホーム画面追加） |
| **QRコード読み取り** | `jsQR`ライブラリ |
| **クラウドストレージ** |  Amazon S3（製品画像をアップロード・保存） |
| **データベース** | 11.4.5-MariaDB (MySQL) |
| **開発環境** | Docker（v27.5.1）、XAMPP（v8.2.12） |
| **デプロイ環境** | AWS LightSail (Debian GNU/Linux 12) |

## デプロイ先URL
本アプリは以下のURLで公開されています。ぜひアクセスして動作を確認してください！
<br>
**[https://scansnapsave.com](https://scansnapsave.com)**

**注意事項:**
このURL上で動作しているアプリは **検証用・開発用** に作成されたものであり、本番環境での利用は推奨しません。  
予告なくアプリが削除される場合があり、継続的な運用やサポートは保証できません。  
そのため、業務用途や重要な環境で利用する場合は **自己責任** でお願いします。  
本アプリの動作やデータに関する保証は一切ありませんので、ご了承ください。

## インストール方法
### リポジトリをクローン
```txt
git clone https://github.com/Nakkinakki55/Scan_Snap_Save.git
cd Scan_Snap_Save
```

# デプロイ方法
このアプリをAWS LightSailにデプロイする手順については、以下の記事を参考にするとスムーズに進められます。
<br>
**[PWAでQRコード読取アプリを開発！iPhone/Android対応＆S3・Lightsailの設定も解説 #AWS - Qiita](https://copilot.microsoft.com/chats/W1sAHWgSebZ1Yx2d6LMEd)**

# 主な機能

- **スマートフォンやタブレットで簡単アクセス**  
ブラウザにアクセスするだけで、特別なインストール不要で利用可能。

![readme01](https://github.com/user-attachments/assets/6bf0b7d4-056b-4cf7-a5fe-29bd15d95dcc)

- **QRコードスキャン機能**  
スマホやタブレットのカメラを使って、製品のQRコードをスキャンし、データベースに登録。

![readme02](https://github.com/user-attachments/assets/523bec6c-c26c-4283-af6d-62b92d8602d5)

- **画像撮影＆アップロード**  
スキャンした製品の画像を撮影し、サーバーへアップロード。社内で簡単に閲覧可能。

![readme04](https://github.com/user-attachments/assets/bac595e0-4237-4c72-b853-901f7f7f5411)

- **登録情報＆画像の閲覧ページ**  
登録した製品情報と画像を一覧表示し、視覚的に確認できる専用ページを用意。

![readme05](https://github.com/user-attachments/assets/f03a6b51-6a62-4fd5-9acb-ff681c344593)

- **情報の検索＆管理機能**
登録された製品情報をキーワードで検索、詳細を確認し、管理できるシステムを搭載。

![readme03](https://github.com/user-attachments/assets/71873a96-371c-43bd-accd-931fb64b0f5d)
