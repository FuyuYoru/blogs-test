{include file="header.tpl"}

<div class="page-content">
  <h2>{$category.name}</h2>
  <p>{$category.description}</p>
  
  <div class="articles">
    {foreach $articles as $article}
      {include file="article-card.tpl" article=$article}
    {/foreach}
  </div>
  
  <div class="pagination">
    {if $prevPage}
      <a href="/category/{$category.id}?page={$prevPage}">Previous</a>
    {/if}
    {if $nextPage}
      <a href="/category/{$category.id}?page={$nextPage}">Next</a>
    {/if}
  </div>
</div>


{include file="footer.tpl"}