<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller {

    public function homePage() {
        $this->view('pages/home', ['title' => 'Anasayfa']);
    }
}

?>