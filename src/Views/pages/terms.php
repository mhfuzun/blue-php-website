<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-5">
                        <i class="bi bi-file-earmark-text text-primary" style="font-size: 3rem;"></i>
                        <h1 class="fw-bold mt-3">Kullanım Şartları</h1>
                        <p class="text-secondary">Son Güncellenme: 03.04.2026</p>
                        <hr class="w-25 mx-auto border-primary border-2">
                    </div>

                    <div class="terms-content text-secondary">
                        
                        <section class="mb-5">
                            <h4 class="text-dark fw-bold"><i class="bi bi-check2-circle me-2 text-primary"></i>1. Şartların Kabulü</h4>
                            <p>
                                <strong><?= Config::get('app_name') ?></strong> platformuna erişerek veya kullanarak, bu kullanım şartlarının tamamını okuduğunuzu, anladığınızı ve kabul ettiğinizi beyan etmiş olursunuz. Eğer bu şartlardan herhangi birini kabul etmiyorsanız, lütfen sitemizi kullanmayınız.
                            </p>
                        </section>

                        <section class="mb-5">
                            <h4 class="text-dark fw-bold"><i class="bi bi-shield-lock me-2 text-primary"></i>2. Hesap Güvenliği</h4>
                            <p>
                                Kayıt sırasında oluşturduğunuz şifrenin gizliliğinden tamamen siz sorumlusunuz. Hesabınız üzerinden gerçekleşen tüm aktiviteler sizin sorumluluğunuzdadır. Şüpheli bir durum fark ettiğinizde derhal bizimle iletişime geçmelisiniz.
                            </p>
                        </section>

                        <section class="mb-5">
                            <h4 class="text-dark fw-bold"><i class="bi bi-exclamation-octagon me-2 text-primary"></i>3. Kullanım Kısıtlamaları</h4>
                            <p>Sitemizi kullanırken aşağıdaki kurallara uymayı taahhüt edersiniz:</p>
                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item bg-transparent border-0 ps-0"><i class="bi bi-dash me-2"></i> Yasalara aykırı içerik paylaşmamak.</li>
                                <li class="list-group-item bg-transparent border-0 ps-0"><i class="bi bi-dash me-2"></i> Sisteme zarar verecek yazılımlar veya saldırılar düzenlememek.</li>
                                <li class="list-group-item bg-transparent border-0 ps-0"><i class="bi bi-dash me-2"></i> Diğer kullanıcıların deneyimini olumsuz etkileyecek davranışlarda bulunmamak.</li>
                            </ul>
                        </section>

                        <section class="mb-5">
                            <h4 class="text-dark fw-bold"><i class="bi bi-cookie me-2 text-primary"></i>4. Gizlilik ve Çerezler</h4>
                            <p>
                                Verilerinizin nasıl işlendiği hakkında detaylı bilgi için <strong>Gizlilik Politikamıza</strong> göz atabilirsiniz. Sitemiz, size daha iyi bir deneyim sunmak için oturum yönetimi (session) ve çerezleri (cookies) kullanmaktadır.
                            </p>
                        </section>

                        <section class="mb-5">
                            <h4 class="text-dark fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>5. Sorumluluk Reddi</h4>
                            <p>
                                <strong><?= Config::get('app_name') ?></strong>, sunulan hizmetlerin kesintisiz veya hatasız olacağını garanti etmez. Teknik arızalardan veya veri kayıplarından kaynaklanabilecek dolaylı zararlardan platformumuz sorumlu tutulamaz.
                            </p>
                        </section>

                    </div>

                    <div class="mt-5 p-4 bg-light rounded-4 text-center">
                        <p class="mb-3 fw-bold text-dark">Sorunuz mu var?</p>
                        <a href="<?= common::getUrl() ?>contact" class="btn btn-outline-primary px-4 rounded-pill">
                            Bizimle İletişime Geçin
                        </a>
                    </div>

                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?= common::getUrl() ?>" class="text-secondary text-decoration-none small">
                    <i class="bi bi-house-door"></i> Ana Sayfaya Dön
                </a>
            </div>

        </div>
    </div>
</div>

<style>
    .terms-content p {
        line-height: 1.8;
        font-size: 1.05rem;
    }
    .list-group-item {
        color: #6c757d;
    }
</style>