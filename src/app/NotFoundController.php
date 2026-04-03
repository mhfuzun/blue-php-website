<?php

require_once __DIR__ . '/../core/Controller.php';

class NotFoundController extends Controller {

    public function NotFound() {
        $this->view('pages/404');
    }
}

?>