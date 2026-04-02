{include file="header.tpl"}

<div class="page-content">
  {foreach $categories as $category}
    {include file="category-card.tpl" category=$category}
  {/foreach}
</div>

{include file="footer.tpl"}