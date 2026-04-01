<?php
require_once __DIR__ . '/../../core/Database.php';

class Article
{
    public static function latestByCategory(int $categoryId, int $limit = 3)
    {
        $db = Database::getInstance();

        $sql = "
        SELECT a.*
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id = :cat_id
        ORDER BY a.created_at DESC
        LIMIT $limit
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute([':cat_id' => $categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
