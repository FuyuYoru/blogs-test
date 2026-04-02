<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/Article.php';

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::find($id);

        // параметры сортировки
        $sort = $_GET['sort'] ?? 'date';
        $page = (int)($_GET['page'] ?? 1);
        $perPage = 5;

        $articles = Article::getByCategory($id, $sort, $page, $perPage);
        $total = Article::countByCategory($id);

        $pages = ceil($total / $perPage);

        $this->view->render('category', [
            'category' => $category,
            'articles' => $articles,
            'page' => $page,
            'pages' => $pages,
            'sort' => $sort,
        ]);
    }
}
