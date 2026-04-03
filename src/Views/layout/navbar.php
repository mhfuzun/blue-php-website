<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= URL ?>">
      <i class="bi bi-code-slash"></i> MyProject
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= URL ?>">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= URL ?>about">Hakkımızda</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if ($session->get('is_logged_in')): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i> <?= htmlspecialchars($session->get('user')['username']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="<?= URL ?>profile">Profilim</a></li>
              <li><a class="dropdown-item" href="<?= URL ?>settings">Ayarlar</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="<?= URL ?>logout">Güvenli Çıkış</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>login">Giriş Yap</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-primary btn-sm ms-lg-2 mt-2 mt-lg-0" href="<?= URL ?>register">Kayıt Ol</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>