<h3 class="page_title">Un problème est survenu :</h3>
   
{if isset($data.simple)}
    <div class="ptext" style="margin-left:50px;margin-right:50px;">{$data.simple}</div>
{else}
    <p class="ptext" style="margin-left:50px;margin-right:50px;">{$data.message}</p>
{/if}
        
<div class="top_bottom_btns">    
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>