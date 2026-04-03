<div class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-primary" style="font-size: 10rem; opacity: 0.8;">404</h1>
        
        <div class="mb-4">
            <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
            <h2 class="fw-bold">Aradığınız sayfa kaybolmuş!</h2>
            <p class="text-muted fs-5">
                Görünüşe göre gitmek istediğiniz yol artık burada değil veya hiç olmadı. <br> 
                Sıkılmayın, ana sayfadan devam edebiliriz.
            </p>
        </div>

        <a href="<?= URL ?>" class="btn btn-primary btn-lg shadow-sm px-5 py-3 rounded-pill fw-bold">
            <i class="bi bi-house-door-fill me-2"></i> Ana Sayfaya Dön
        </a>

        <div class="mt-5 text-secondary">
            <small>&copy; <?= date('Y') ?> <?= Config::get('app_name') ?? 'Projem' ?> - Tüm hakları saklıdır.</small>
        </div>
    </div>
</div>