{*
* 2017-2018 Zemez
*
* JX Blog
*
* NOTICE OF LICENSE
*
* This source file is subject to the General Public License (GPL 2.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/GPL-2.0
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade the module to newer
* versions in the future.
*
*  @author    Zemez (Alexander Grosul)
*  @copyright 2017-2018 Zemez
*  @license   http://opensource.org/licenses/GPL-2.0 General Public License (GPL 2.0)
*}

{extends file=$layout}

{block name='content'}
  <section id="main">
    <h1>{$tag->tag}</h1>
    {if $posts}
      {include file="module:jxblog/views/templates/front/_partials/post-miniature.tpl"}
      {if $pagination}
        {include file="module:jxblog/views/templates/front/_partials/pagination.tpl"}
      {/if}
    {else}
      <p>{l s='There are no posts' mod='jxblog'}</p>
    {/if}
  </section>
{/block}
