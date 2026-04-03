#!/bin/bash

# 1. Değişkenleri Tanımla
BOOTSTRAP_URL="https://github.com/twbs/bootstrap/releases/download/v5.3.3/bootstrap-5.3.3-dist.zip"
TARGET_DIR="./src/assets"
TEMP_ZIP="bootstrap.zip"
TEMP_FOLDER="bootstrap_temp"

echo "🚀 Bootstrap kurulumu başlatılıyor..."

# 2. Hedef klasörleri oluştur
mkdir -p "$TARGET_DIR/js"
mkdir -p "$TARGET_DIR/css"

# 3. Bootstrap'i indir
echo "📥 Dosyalar indiriliyor..."
curl -L $BOOTSTRAP_URL -o $TEMP_ZIP

# 4. Zip dosyasını geçici klasöre aç
echo "📦 Dosyalar ayıklanıyor..."
unzip -q $TEMP_ZIP -d $TEMP_FOLDER

# 5. Sadece gerekli dosyaları hedef klasöre taşı (minified versiyonlar)
# CSS dosyaları
cp $TEMP_FOLDER/*/css/bootstrap.min.css "$TARGET_DIR/css/"
# JS dosyaları (Popper dahil bundle versiyonu)
cp $TEMP_FOLDER/*/js/bootstrap.bundle.min.js "$TARGET_DIR/js/"

# 6. Temizlik yap
echo "🧹 Geçici dosyalar siliniyor..."
rm -rf $TEMP_ZIP $TEMP_FOLDER

echo "✅ İşlem tamamlandı!"
echo "📍 Dosyalar şuraya yerleştirildi: $TARGET_DIR"
