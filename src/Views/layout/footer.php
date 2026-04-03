<footer class="bg-purple-dark text-light py-5 mt-auto">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3 text-purple-primary"><?= Config::get('app_name') ?></h5>
                <p class="text-purple-soft small">Geleceğin mor tonlarıyla yazılmış modern bir altyapı.</p>
            </div>
            <div class="col-lg-4">
              <h5 class="fw-bold mb-3">Bülten</h5>
              <div class="input-group">
                <input type="text" class="form-control bg-transparent border-purple-light text-white" placeholder="E-posta...">
                <button class="btn btn-purple">Gönder</button>
              </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="d-flex justify-content-lg-end gap-3 fs-3 text-purple-primary">
                    <i class="bi bi-github"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-instagram"></i>
                </div>
            </div>
        </div>
        <hr class="my-4" style="border-color: #4338CA;">
        <div class="text-center text-purple-soft small">
            &copy; <?= date('Y') ?> Tüm hakları mor saklıdır.
        </div>
    </div>
</footer>