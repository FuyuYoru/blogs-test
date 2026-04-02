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

    public static function getByCategory($categoryId, $sort, $page, $perPage)
    {
        $db = Database::getInstance();

        $offset = ($page - 1) * $perPage;
        $perPage = (int)$perPage;
        $offset = (int)$offset;

        // сортировка
        $orderBy = $sort === 'views' ? 'a.views DESC' : 'a.created_at DESC';

        $sql = "
        SELECT a.*
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id = :category_id
        ORDER BY $orderBy
        LIMIT $perPage OFFSET $offset
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute([':category_id' => $categoryId]);

        return $stmt->fetchAll();
    }

    public static function countByCategory($categoryId)
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("
        SELECT COUNT(*) as total
        FROM article_category
        WHERE category_id = ?
    ");
        $stmt->execute([$categoryId]);

        return $stmt->fetch()['total'];
    }

    public static function find(int $id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function incrementViews(int $id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE articles SET views = views + 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function related(int $id, int $limit = 3)
    {
        $db = Database::getInstance();
        $limit = (int)$limit;

        $sql = "
        SELECT DISTINCT a.*
        FROM articles a
        JOIN article_category ac ON a.id = ac.article_id
        WHERE ac.category_id IN (
            SELECT category_id FROM article_category WHERE article_id = :id
        )
        AND a.id != :id
        ORDER BY a.created_at DESC
        LIMIT $limit
    ";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
