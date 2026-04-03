
<?php

require_once __DIR__ . '/../core/Controller.php';

class TermsController extends Controller {

    public function termsPage() {
        $this->view('pages/terms', ['title' => 'Terms']);
    }
}

?>
