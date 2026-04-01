<?php
require_once __DIR__ . '/../../core/Database.php';

class Category {
    public static function all() {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM categories")->fetchAll();
    }
}