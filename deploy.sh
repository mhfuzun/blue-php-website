#!/bin/bash

set -e
set -o pipefail

# === RENKLER ===
GREEN='\033[0;32m'
BLUE='\033[0;34m'
RED='\033[0;31m'
NC='\033[0m' # No Color

log() {
    echo -e "${BLUE}➜ $1${NC}"
}

success() {
    echo -e "${GREEN}✔ $1${NC}"
}

error() {
    echo -e "${RED}✖ $1${NC}"
}

# CONFIG
REPO_DIR="/home/user/myproject"
DEPLOY_DIR="/var/www/html"
TMP_DIR="/tmp/deploy_tmp"

echo ""
echo "=============================="
echo "🚀 DEPLOY BAŞLADI"
echo "=============================="
echo ""

# 1. Repo
log "Repo dizinine gidiliyor..."
cd $REPO_DIR

log "Git pull yapılıyor..."
git pull origin main

# 2. Temp
log "Temp klasör hazırlanıyor..."
rm -rf $TMP_DIR
mkdir -p $TMP_DIR

# 3. Copy
log "Dosyalar temp klasöre kopyalanıyor..."
cp -rv src/. $TMP_DIR/

# 4. Test
if [ -f "$REPO_DIR/test.sh" ]; then
    log "Testler çalıştırılıyor..."
    bash $REPO_DIR/test.sh
    success "Testler başarılı"
fi

# 5. Backup
log "Backup alınıyor..."
BACKUP_DIR="/var/www/backup_$(date +%Y%m%d_%H%M%S)"
mkdir -p $BACKUP_DIR
cp -rv $DEPLOY_DIR/. $BACKUP_DIR/

# 6. Deploy
log "Deploy ediliyor (rsync)..."
rsync -av --delete \
  --exclude='.env' \
  $TMP_DIR/ $DEPLOY_DIR/

# 7. Permission
log "İzinler ayarlanıyor..."
chown -R www-data:www-data $DEPLOY_DIR
chmod -R 755 $DEPLOY_DIR

success "Deploy tamamlandı!"
echo ""
