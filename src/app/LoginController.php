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

        $succ = parent::$session->login($identity, $password, $rememberMe);

        $this->view('pages/home',
        [
            'title' => 'Login',
            'error' => $succ,
        ]);
    }
}

?>