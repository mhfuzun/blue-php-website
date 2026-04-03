<?php

class Controller {
    protected SessionManager $session;

    public function __construct() {
        $this->session = new SessionManager();
    }

    public function checkRememberMe(): bool {
        return $this->session->tryRememberMe();
    }

    public function view($view, $data = []) {
        extract($data);

        if (!isset($data['title'])) $title = Config::get('app_name');
        require __DIR__ . "/../Views/layout/main.php";
    }
}

?>
