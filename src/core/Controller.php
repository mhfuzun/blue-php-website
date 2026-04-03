<?php

class Controller {

    public function view($view, $data = []) {
        extract($data);

        require "Config.php";
        if (!isset($data['title'])) $title = Config::get('app_name');
        require __DIR__ . "/../Views/layout/main.php";
    }
}

?>
