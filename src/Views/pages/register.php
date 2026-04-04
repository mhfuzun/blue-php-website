<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <div class="display-4 text-primary mb-2">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h2 class="fw-bold">Aramıza Katıl</h2>
                        <p class="text-secondary">Hemen ücretsiz hesabını oluştur.</p>
                    </div>

                    

                    <form action="<?= common::getUrl() ?>register" method="POST">
                        <?= common::retPostFormCSRF() ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="nick" class="form-control" id="regUser" placeholder="Kullanıcı Adı" required>
                            <label for="regUser"><i class="bi bi-at me-2"></i>Kullanıcı Adı</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="regUser" placeholder="Adınız" required>
                            <label for="regUser"><i class="bi bi-at me-2"></i>Adınız</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="regEmail" placeholder="isim@ornek.com" required>
                            <label for="regEmail"><i class="bi bi-envelope me-2"></i>E-posta Adresi</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="regPass" placeholder="Şifre" required>
                            <label for="regPass"><i class="bi bi-lock me-2"></i>Şifre</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirm" class="form-control" id="regPassConfirm" placeholder="Şifre Tekrar" required>
                            <label for="regPassConfirm"><i class="bi bi-shield-check me-2"></i>Şifre Tekrar</label>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="termsCheck" id="termsCheck" value="1" required>
                            <label class="form-check-label small text-secondary" for="termsCheck">
                                <a href="<?= common::getUrl() ?>terms" class="text-decoration-none">Kullanım Şartlarını</a> ve Gizlilik Politikasını kabul ediyorum.
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm mb-3">
                            Kayıt Ol <i class="bi bi-arrow-right ms-2"></i>
                        </button>

                    </form>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-secondary">Zaten bir hesabın var mı? 
                            <a href="<?= common::getUrl() ?>login" class="text-primary fw-bold text-decoration-none">Giriş Yap</a>
                        </p>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= common::getUrl() ?>" class="text-secondary text-decoration-none small">
                    <i class="bi bi-house"></i> Ana Sayfaya Dön
                </a>
            </div>

        </div>
    </div>
</div>