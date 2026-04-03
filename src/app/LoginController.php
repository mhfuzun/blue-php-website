<?php

require_once __DIR__ . '/../core/Controller.php';

class LoginController extends Controller {

    public function login() {
        $this->view('pages/login');
    }

    public function loginPost() {
        $this->view('pages/home');
    }
}

?>