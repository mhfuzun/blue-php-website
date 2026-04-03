
<?php

require_once __DIR__ . '/../core/Controller.php';

class RegisterController extends Controller {

    public function registerPage() {
        $this->view('pages/register', ['title' => 'Register']);
    }

    public function registerPost() {
        // $this->view('pages/register', ['title' => 'Register']);
    }
}

?>
