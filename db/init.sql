CREATE DATABASE IF NOT EXISTS blog_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE blog_test;

-- Таблица категорий
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Таблица статей
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    content TEXT NOT NULL,
    image VARCHAR(255),
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Связь статьи и категории (многие ко многим)
CREATE TABLE IF NOT EXISTS article_category (
    article_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY(article_id, category_id),
    FOREIGN KEY(article_id) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE
);