{* Ce template doit être inclus lors de la répartition sur plusieurs pages des éléments de la BDD *}

<form method="GET" action="index.php">
    {foreach $smarty.get as $name => $val}
        <input type="hidden" name="{$name}" value="{$val}" />
    {/foreach}
        
    {if $data.nb_pages > 1}
    <div class="multipage"> 
        {if $data.page-1 > 0}
        <button class="boutonW" value="{$data.page-1}" onclick="$(this).next('select').find('option:selected').prev('option').attr('selected', 'selected');">
           Page précédente
        </button>
        {else}
        <input type="button" class="boutonI" value="Page précédente" />
        {/if}
        <select name="page" class="select" style="padding:2px 1px 3px 1px;width:85px;" onchange="$(this).parents('form').submit();">
            {section name=pages start=1 loop=$data.nb_pages+1 step=1}
            <option value="{$smarty.section.pages.index}" {if $smarty.section.pages.index == $data.page}selected="selected"{/if}>Page {$smarty.section.pages.index}</option>
            {/section}
        </select>

        {if $data.page+1 <= $data.nb_pages}
        <button class="boutonW" value="{$data.page+1}" onclick="$(this).prev('select').find('option:selected').next('option').attr('selected', 'selected');">
            Page suivante
        </button>
        {else}
        <input type="button" class="boutonI" value="Page suivante" />
        {/if}
    </div>
    {/if}
        
</form>

