<?php
require_once __DIR__ . '/../../core/Database.php';

class Category
{
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM categories")->fetchAll();
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
