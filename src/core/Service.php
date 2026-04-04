<?php

class Service {
    protected Database $database;

    public function __construct() {
        $this->database = new Database();
    }
}

?>
