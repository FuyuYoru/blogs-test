<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Article.php';
require_once __DIR__ . '/../Models/Category.php';

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            http_response_code(404);
            echo "Статья не найдена";
            return;
        }

        // Увеличиваем счётчик просмотров
        Article::incrementViews($id);

        // Получаем 3 похожие статьи из тех же категорий
        $related = Article::related($id, 3);

        $this->view->render('article', [
            'article' => $article,
            'similar' => $related
        ]);
    }
}