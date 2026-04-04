<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            
            <div class="text-center mb-4">
                <a href="<?= common::getUrl() ?>" class="text-decoration-none">
                    <div class="display-6 fw-bold text-primary">
                        <i class="bi bi-shield-lock-fill"></i> <?= Config::get('app_name') ?>
                    </div>
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <h3 class="fw-bold mb-3 text-center">Tekrar Hoş Geldin!</h3>
                    <p class="text-secondary text-center mb-4 small">Lütfen bilgilerinle giriş yap.</p>

                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2 small border-0 shadow-sm mb-4">
                            <i class="bi bi-exclamation-circle me-2"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
                        <div class="alert alert-success py-2 small border-0 shadow-sm mb-4">
                            <i class="bi bi-check-circle me-2"></i> Kayıt başarılı! Giriş yapabilirsin.
                        </div>
                    <?php endif; ?>

                    <form action="<?= common::getUrl() ?>login" method="POST">
                        <?= common::retPostFormCSRF() ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="identity" class="form-control" id="floatingId" placeholder="Kullanıcı Adı veya E-posta" required>
                            <label for="floatingId">Kullanıcı Adı veya E-posta</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Şifre" required>
                            <label for="floatingPassword">Şifre</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" value="1">
                                <label class="form-check-label small text-secondary" for="rememberMe">Beni Hatırla</label>
                            </div>
                            <a href="<?= common::getUrl() ?>forgot-password" class="small text-primary text-decoration-none">Şifremi Unuttum</a>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm py-2 fw-bold">
                            Giriş Yap <i class="bi bi-box-arrow-in-right ms-2"></i>
                        </button>
                    </form>

                    <div class="position-relative my-4">
                        <hr class="text-secondary">
                        <p class="text-secondary small">Hesabın yok mu? 
                            <a href="<?= common::getUrl() ?>register" class="text-primary fw-bold text-decoration-none">Hemen Kayıt Ol</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>