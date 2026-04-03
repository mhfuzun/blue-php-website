#!/bin/bash

set -e  # hata olursa script dursun

echo "🚀 Deploy başlıyor..."

# CONFIG
REPO_DIR="."
DEPLOY_DIR="/var/www/html"
TMP_DIR="/tmp/deploy_tmp"

# 1. Repo dizinine git
cd $REPO_DIR

echo "📥 Git pull yapılıyor..."
git pull origin main

# 2. Geçici klasör oluştur
echo "📁 Temp klasör hazırlanıyor..."
rm -rf $TMP_DIR
mkdir -p $TMP_DIR

# 3. src klasörünü temp'e kopyala
cp -r src/* $TMP_DIR/

# 4. (Opsiyonel) test çalıştır
if [ -f "$REPO_DIR/test.sh" ]; then
    echo "🧪 Testler çalıştırılıyor..."
    bash $REPO_DIR/test.sh
fi

# 5. Backup al
echo "💾 Backup alınıyor..."
BACKUP_DIR="/var/www/backup_$(date +%Y%m%d_%H%M%S)"
mkdir -p $BACKUP_DIR
cp -r $DEPLOY_DIR/* $BACKUP_DIR/

# 6. Deploy (atomic yaklaşım)
echo "📦 Yeni sürüm deploy ediliyor..."
rsync -av --delete $TMP_DIR/ $DEPLOY_DIR/

# 7. Permission düzelt (opsiyonel ama önerilir)
echo "🔐 İzinler ayarlanıyor..."
chown -R www-data:www-data $DEPLOY_DIR
chmod -R 755 $DEPLOY_DIR

echo "✅ Deploy tamamlandı!"
