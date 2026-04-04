<?php

class Controller {
    protected AuthService $auth_service;

    public function __construct() {
        $this->auth_service = new AuthService();
    }

    public function checkRememberMe(): bool {
        return $this->auth_service->tryRememberMe();
    }

    public function view($view, $data = []) {
        extract($data);

        if (!isset($data['title'])) $title = Config::get('app_name');
        require __DIR__ . "/../Views/layout/main.php";
    }
}

?>
