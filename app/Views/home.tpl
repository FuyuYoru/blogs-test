{foreach $categories as $category}
    <h2>{$category.name}</h2>
    <p>{$category.description}</p>
    <ul>
        {foreach $category.articles as $article}
            <li>{$article.title}</li>
        {/foreach}
    </ul>
    <a href="/category/{$category.id}">Все статьи</a>
{/foreach}