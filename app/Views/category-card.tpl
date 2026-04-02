<section class="category-section">
  <div class="category-title">
    <h2>{$category.name}</h2>
    <a href="/category/{$category.id}">View All</a>
  </div>
  <div class="articles">
    {foreach $category.articles as $article}
      {include file="article-card.tpl" article=$article}
    {/foreach}
  </div>
</section>