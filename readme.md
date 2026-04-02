## 📂 Структура проекта

```
.
├── app/
│   ├── Controllers/     # Контроллеры (Home, Category, Article)
│   ├── Models/          # Модели (Category, Article)
│   └── Views/           # Smarty шаблоны
│
├── core/
│   ├── Router.php       # Роутинг (с поддержкой параметров)
│   ├── Controller.php   # Базовый контроллер
│   ├── View.php         # Работа со Smarty
│   └── Database.php     # Singleton PDO
│
├── public/
│   ├── index.php        # Точка входа
│   ├── css/             # Скомпилированные стили
│   └── images/          # Изображения
│
├── scss/                # SCSS стили
│
├── db/
│   └── init.sql         # Создание таблиц
│
├── docker/
│   ├── nginx.conf       # Конфиг nginx
│   └── php-entrypoint.sh # авто-сидинг
│
├── Dockerfile
├── docker-compose.yml
├── seed.php             # Скрипт заполнения БД
└── README.md
```

---

## 🚀 Запуск проекта

### 1. Клонировать репозиторий

```
git clone https://github.com/FuyuYoru/blogs-test.git
cd <project-folder>
```

---

### 2. Запустить Docker

```
docker-compose up -d --build
```

---

### 3. Доступ к сервисам

* Сайт:
  👉 http://localhost:8080

* phpMyAdmin:
  👉 http://localhost:8081

```
host: mysql
user: root
password: root
```

---

## 🌱 Сидинг данных

Сидинг запускается автоматически при старте контейнера PHP.

Создаются:

* категории
* статьи (по 5 на категорию)
* связи many-to-many

---

## 🎨 Стили (SCSS)

SCSS компилируется через Sass внутри контейнера:

```
docker exec -it blog_php bash
sass --watch scss/main.scss:public/css/main.css
```

---

## ⚙️ Архитектура

Проект реализован в стиле простого MVC:

* **Router** — обработка URL и параметров
* **Controller** — бизнес-логика
* **Model** — работа с БД (PDO)
* **View** — Smarty шаблоны

---

## 📄 Реализованные страницы

### Главная

* Категории с 3 последними статьями
* Кнопка "Все статьи"

### Категория

* Список статей
* Сортировка (дата / просмотры)
* Пагинация

### Статья

* Полный текст
* Счётчик просмотров
* Похожие статьи

---

## ➕ Дополнительно

* Используется Docker
* Используется SCSS
* Реализован сидинг данных
* Чистая структура без фреймворков

---

## 👤 Автор

Выполнено в рамках тестового задания.
