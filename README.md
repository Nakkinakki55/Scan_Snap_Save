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

## デプロイ方法
このアプリをAWS LightSailにデプロイする手順については、以下の記事を参考にするとスムーズに進められます。
<br>
**[PWAでQRコード読取アプリを開発！iPhone/Android対応＆S3・Lightsailの設定も解説 #AWS - Qiita](https://copilot.microsoft.com/chats/W1sAHWgSebZ1Yx2d6LMEd)**

## 主な機能

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

---

# ScanSnapSave (QR Code Inventory Management Web App)

This project involved developing a web application utilizing QR codes to streamline inventory management for e-commerce sites. The app allows users to scan QR codes with smartphones or tablets to register and manage product information in a database. Additionally, it features a product image upload function to make visuals accessible company-wide.

## Features
- **PWA Compatible**：Usable like a native app on smartphones and tablets.
- **Built-in QR Code Reader**：Leverages the `jsQR` library for scanning.
- **Cloud Storage**：Uploads product images to Amazon S3.
- **Low-Cost Operation**：No App Store or Google Play registration required.

## 使用技術
| Technology | Details |
|------|------|
| **Development Language** | PHP 8.3.19 |
| **Framework** | Laravel 12.1.1 |
| **Authentication** | Laravel Breeze (Blade templates + Tailwind CSS)） |
| **Frontend** | PWA (Offline support, Add to Home Screen) |
| **QR Code Reading** | `jsQR`library |
| **Cloud Storage** |  Amazon S3 (for uploading and storing product images) |
| **Database** | 11.4.5-MariaDB (MySQL) |
| **Development Environment** | Docker（v27.5.1）、XAMPP（v8.2.12） |
| **Deployment Environment** | AWS LightSail (Debian GNU/Linux 12) |

## Deployed URL
This application is publicly available at the following URL. Feel free to visit and check its functionality!
<br>
**[https://scansnapsave.com](https://scansnapsave.com)**

**Important Note:**
The application running at this URL is created for verification and development purposes only and is not recommended for production use. The application may be deleted without prior notice, and continuous operation or support cannot be guaranteed. Therefore, if you intend to use it for business purposes or in critical environments, please do so at your own risk. No warranties regarding the application's operation or data are provided.

## Installation
### Clone the Repository
```txt
git clone https://github.com/Nakkinakki55/Scan_Snap_Save.git
cd Scan_Snap_Save
```

## Deployment
For smooth deployment of this app to AWS LightSail, you can refer to the following article:
<br>
**[Develop a QR Code Reader App with PWA! iPhone/Android Support & Explaining S3/Lightsail Settings #AWS - Qiita](https://copilot.microsoft.com/chats/W1sAHWgSebZ1Yx2d6LMEd)**

## Key Features

- Easy Access via Smartphone or Tablet
Simply access it via a browser; no special installation is required to use it like an app.

![readme01](https://github.com/user-attachments/assets/6bf0b7d4-056b-4cf7-a5fe-29bd15d95dcc)

- QR Code Scanning Function
Use your smartphone or tablet camera to scan product QR codes and register them in the database.

![readme02](https://github.com/user-attachments/assets/523bec6c-c26c-4283-af6d-62b92d8602d5)

- Image Capture & Upload
Capture images of scanned products and upload them to the server for easy viewing within the company.

![readme04](https://github.com/user-attachments/assets/bac595e0-4237-4c72-b853-901f7f7f5411)

- Registered Information & Image Viewing Page
A dedicated page is available to display registered product information and images in a list for visual confirmation.

![readme05](https://github.com/user-attachments/assets/f03a6b51-6a62-4fd5-9acb-ff681c344593)

- Information Search & Management Function
Includes a system to search for registered product information by keyword, view details, and manage them.

![readme03](https://github.com/user-attachments/assets/71873a96-371c-43bd-accd-931fb64b0f5d)

