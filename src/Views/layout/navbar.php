<nav class="navbar navbar-expand-lg navbar-dark bg-purple-dark shadow shadow-lg py-3">
  <div class="container">
    <a class="navbar-brand fw-bold text-purple-primary" href="<?= common::getUrl() ?>">
       <i class="bi bi-magic me-2"></i> <?= Config::get('app_name') ?>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active text-purple-soft" href="<?= common::getUrl() ?>">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-purple-soft" href="<?= common::getUrl() ?>about">Hakkımızda</a>
        </li>
      </ul>

      <ul class="navbar-nav ms-auto align-items-center">
        <?php if (SessionManager::isUserLoggedIn()): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-purple-primary" href="#" id="userDropdown" data-bs-toggle="dropdown">
              <?= SessionManager::getUserName() ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= common::getUrl() ?>profile">Profilim</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="<?= common::getUrl() ?>logout">Çıkış</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-purple-soft" href="<?= common::getUrl() ?>login">Giriş</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-purple btn-sm ms-lg-3 px-4 rounded-pill" href="<?= common::getUrl() ?>register">Kayıt Ol</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>