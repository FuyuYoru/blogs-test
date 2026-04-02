{include file="header.tpl"}

<div class="page-content article-page">
  
  <h1>{$article.title}</h1>
  <img src="{$article.image}" alt="{$article.title}">
  <p>{$article.content}</p>
  <p>Views: {$article.views}</p>

  <h3>Similar articles</h3>
  <div class="articles">
    {foreach $similar as $art}
      {include file="article-card.tpl" article=$art}
    {/foreach}
  </div>
</div>
{include file="footer.tpl"}