<?php

class LoginController extends Controller {

    public function login() {
        $this->view('pages/login',
        [
            'title' => 'Login',
            'error' => null,
        ]);
    }

    public function loginPost() {
        $identity = common::cleanInput($_POST['identity']);
        $password = common::cleanInput($_POST['password']);
        $rememberMe = common::getInputCheckbox('rememberMe');

        error_log("user login post and remember res: " . $rememberMe);
        $succ = $this->auth_service->login($identity, $password, $rememberMe);

        $this->view('pages/home',
        [
            'title' => 'Home',
            'error' => $succ,
        ]);
    }

    public function logout() {
        $this->auth_service->logout();
        $this->view('pages/home',
        [
            'error' => null,
        ]);
    }
}

?>