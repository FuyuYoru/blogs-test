<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/core/Database.php';

$db = Database::getInstance();

// --- Категории ---
$categories = [
    ['name' => 'Технологии', 'description' => 'Статьи про IT и гаджеты'],
    ['name' => 'Путешествия', 'description' => 'Советы и истории о поездках'],
    ['name' => 'Кулинария', 'description' => 'Рецепты и советы по готовке'],
    ['name' => 'Спорт', 'description' => 'Новости спорта и тренировки'],
    ['name' => 'Наука', 'description' => 'Статьи о науке и открытиях'],
];

$categoryIds = [];

foreach ($categories as $cat) {
    $stmt = $db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
    $stmt->execute([
        ':name' => $cat['name'],
        ':description' => $cat['description'],
    ]);
    $categoryIds[] = $db->lastInsertId();
}

$imageFiles = glob(__DIR__ . '/public/images/*.jpg');


// --- Генерация статей ---
foreach ($categoryIds as $catId) {
    for ($i = 1; $i <= 5; $i++) {
        $title = "Статья {$i} категории {$categories[$catId-1]['name']}";
        $description = "Короткое описание {$title}";
        $content = "Полный текст статьи {$title}. Lorem ipsum dolor sit amet, consectetur adipiscing elit.";
        $image = '/images/' . basename($imageFiles[array_rand($imageFiles)]);

        $stmt = $db->prepare("INSERT INTO articles (title, description, content, image) VALUES (:title, :description, :content, :image)");
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':content' => $content,
            ':image' => $image,
        ]);
        $articleId = $db->lastInsertId();

        // Привязываем к категории
        $stmt = $db->prepare("INSERT INTO article_category (article_id, category_id) VALUES (:article_id, :category_id)");
        $stmt->execute([
            ':article_id' => $articleId,
            ':category_id' => $catId,
        ]);
    }
}

echo "Seed выполнен! Добавлено " . count($categoryIds)*5 . " статей.\n";