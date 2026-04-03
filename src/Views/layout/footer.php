<footer class="bg-dark text-light py-5 mt-auto border-top border-secondary">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="bi bi-cpu"></i> <?= Config::get('app_name') ?? 'BluePHP' ?>
                </h5>
                <p class="text-secondary">
                    Modern mimari ve güvenli kodlama standartlarıyla geliştirilmiş, 
                    "miss gibi" bir PHP projesi. Kod yazarken eğlenmeyi unutmayın!
                </p>
                <div class="d-flex gap-3 fs-4 mt-3">
                    <a href="#" class="text-secondary hvr-text-primary"><i class="bi bi-github"></i></a>
                    <a href="#" class="text-secondary hvr-text-primary"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-secondary hvr-text-primary"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-3">Keşfet</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= URL ?>" class="text-secondary text-decoration-none">Ana Sayfa</a></li>
                    <li class="mb-2"><a href="<?= URL ?>projects" class="text-secondary text-decoration-none">Projeler</a></li>
                    <li class="mb-2"><a href="<?= URL ?>blog" class="text-secondary text-decoration-none">Blog</a></li>
                    <li class="mb-2"><a href="<?= URL ?>about" class="text-secondary text-decoration-none">Hakkımızda</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="fw-bold mb-3">Destek</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= URL ?>faq" class="text-secondary text-decoration-none">SSS</a></li>
                    <li class="mb-2"><a href="<?= URL ?>contact" class="text-secondary text-decoration-none">İletişim</a></li>
                    <li class="mb-2"><a href="<?= URL ?>privacy" class="text-secondary text-decoration-none">Gizlilik Politikası</a></li>
                    <li class="mb-2"><a href="<?= URL ?>terms" class="text-secondary text-decoration-none">Kullanım Şartları</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">Bültene Abone Ol</h5>
                <p class="text-secondary small">Gelişmelerden haberdar olmak için e-postanı bırak!</p>
                <form action="<?= URL ?>subscribe" method="POST" class="input-group">
                    <input type="email" name="email" class="form-control bg-dark text-light border-secondary" placeholder="E-posta adresin..." required>
                    <button class="btn btn-primary" type="submit">Gönder</button>
                </form>
            </div>

        </div>

        <hr class="my-5 border-secondary">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start text-secondary small">
                &copy; <?= date('Y') ?> <strong><?= Config::get('app_name') ?></strong>. Tüm hakları saklıdır.
            </div>
            <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                <span class="text-secondary small">
                    Made with <i class="bi bi-heart-fill text-danger"></i> by <a href="<?= Config::get('app_author_url') ?>" target="_blank" class="text-primary text-decoration-none fw-bold"><?= Config::get('app_author') ?></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .hvr-text-primary:hover { color: #0d6efd !important; transition: 0.3s; }
    footer a:hover { color: white !important; transition: 0.2s; }
</style>