<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Smarty\Smarty;

class View
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(__DIR__ . '/../app/Views/');
        $this->smarty->setCompileDir(__DIR__ . '/../storage/templates_c/');
    }

    public function render($template, $data = [])
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->display($template . '.tpl');
    }
}
