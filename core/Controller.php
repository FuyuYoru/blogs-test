<?php

require_once __DIR__ . '/View.php';

class Controller {
    protected View $view;

    public function __construct() {
        $this->view = new View();
    }
}
