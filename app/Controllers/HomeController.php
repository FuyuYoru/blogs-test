<?php
require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../Models/Category.php';
require_once __DIR__ . '/../Models/Article.php';

class HomeController extends Controller {
    public function index() {
        $categories = Category::all();
        foreach ($categories as &$cat) {
            $cat['articles'] = Article::latestByCategory($cat['id'], 3);
        }

        $this->view->render('home', ['categories' => $categories]);
    }
}