<div style="position:relative;">
<h3 class="page_title">{$data.page.page_title}</h3>

{if isset($smarty.session.user)}
<div class="commands" style="position:absolute;top:5px;right:0px;">
    <a href="index.php?model=Page&amp;action=Editform&amp;pk={$data.page.page_id}&amp;admin" title="Editer" class="btn_edit"></a>
</div>
{/if}
</div>


<div>
    {$data.page.page_content}
</div>

<h6 style="text-align:center; font-size:xx-small;">Dernière modification le {$data.page.page_updated|date_format:"%d/%m/%Y à %Hh%M"}</h6>