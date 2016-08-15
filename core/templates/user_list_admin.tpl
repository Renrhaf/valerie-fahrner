<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&amp;action=showlist&amp;admin">Gestion des utilisateurs</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Gestion des utilisateurs</h3>

<div class="top_bottom_btns">
    <a style="float:left;" class="boutonW" href="index.php?model=User&amp;action=Createform&amp;admin" title="Créer un utilisateur">Créer un utilisateur</a>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=User&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>
    
<table class="admin_table">
    <thead>
        <tr>
            <th style="width:40px;" class="triable" onclick="order_by($(this),'user_id');"># {if isset($smarty.get.tri) and $smarty.get.tri == 'user_id'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_fname');">Prénom {if isset($smarty.get.tri) and $smarty.get.tri == 'user_fname'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_lname');">Nom {if isset($smarty.get.tri) and $smarty.get.tri == 'user_lname'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:200px;" class="triable" onclick="order_by($(this),'user_mail');">Email {if isset($smarty.get.tri) and $smarty.get.tri == 'user_mail'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th>Site web</th>
            <th style="width:150px;" class="triable" onclick="order_by($(this),'profession_name');">Profession {if isset($smarty.get.tri) and $smarty.get.tri == 'profession_name'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:100px;" class="triable" onclick="order_by($(this),'user_created');">Créée le {if isset($smarty.get.tri) and $smarty.get.tri == 'user_created'}<span class="tri_{$smarty.get.ord|default: 'asc'}"></span>{/if}</th>
            <th style="width:70px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    {foreach $data.users as $user}
        <tr>
            <td>{$user.user_id}</td>
            <td>{$user.user_fname}</td>
            <td>{$user.user_lname}</td>
            <td>{$user.user_mail}</td>
            <td>{$user.user_website|default: "non précisé"}</td>
            <td>{$user.profession_name|default: "non précisé"}</td>
            <td>{$user.user_created|date_format:"%d/%m/%Y <br/>à %Hh%M"}</td>
            <td class="commands">
                <div onclick="activate($(this), 'Core','User',{$user.user_id});" {if $user.user_active}title="Désactiver" class="btn_active"{else}title="Activer" class="btn_busy"{/if}></div>
                <a href="index.php?model=User&amp;action=Editform&amp;pk={$user.user_id}&amp;admin" title="Editer" class="btn_edit"></a>
                <div onclick="delet($(this), 'Core','User',{$user.user_id});" title="Supprimer" class="btn_delete"></div>
            </td>
        </tr>
    {/foreach}   
    </tbody>
</table>

<div class="top_bottom_btns">
    <a style="float:left;" class="boutonW" href="index.php?model=User&amp;action=Createform&amp;admin" title="Créer un utilisateur">Créer un utilisateur</a>
    {include file='core/templates/multipage.tpl' data=$data.multipage}
    <a style="float:right;" class="boutonW" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=User&amp;action=showlist&amp;admin"}" title="Retour">Retour</a>
    <div style="clear:both;"></div>
</div>