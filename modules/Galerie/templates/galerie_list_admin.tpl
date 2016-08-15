<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin">Gestion des galeries</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des galeries</h3>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=Createform&amp;admin" title="Créer une galerie">Créer une galerie</a>    
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>

<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'galerie_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'galerie_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'galerie_title');">Titre {if isset($smarty.get.tri) and $smarty.get.tri == 'galerie_title'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th class="triable" onclick="order_by($(this),'galerie_description');">Description {if isset($smarty.get.tri) and $smarty.get.tri == 'galerie_description'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'galerie_created');">Créée le {if isset($smarty.get.tri) and $smarty.get.tri == 'galerie_created'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;">Images</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.galeries as $galerie}
        {assign var='id' value=$galerie.galerie_id}
        <tr {if $galerie@iteration is even}class="odd" {/if}>
            <td>{$id}</td>
            <td><p>{$galerie.galerie_title}</p></td>
            <td><p style="text-align:justify;">{$galerie.galerie_description|default: "non renseignée"}</p></td>
            <td><p>{$galerie.galerie_created|date_format:"%d/%m/%Y <br/>à %Hh%M"}<br/>par <a href="index.php?model=User&amp;pk={$galerie.user_id}&amp;admin" title="Consulter le profil">{$galerie.user_fname} {$galerie.user_lname}</a></p></td>
            <td><p><a class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;pk={$id}&amp;action=manage&amp;admin" title="Gérer les images">Gérer les images</a></p></td>
            <td class="commands">
                <div onclick="activate($(this), 'Galerie','Galerie',{$id});" {if $galerie.galerie_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?module=Galerie&amp;model=Galerie&amp;action=Editform&amp;pk={$id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Galerie','Galerie',{$id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;margin-right:7px;" class="boutonW" href="index.php?module=Galerie&amp;model=Galerie&amp;action=Createform&amp;admin" title="Créer une galerie">Créer une galerie</a>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?module=Galerie&amp;model=Galerie&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>