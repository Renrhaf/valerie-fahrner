<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php?model=Home">Votre espace</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&amp;action=showlist&amp;admin">Gestion des utilisateurs</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&amp;admin{if isset($data.user_id)}&amp;action=Editform&amp;pk={$data.user_id}{else}&amp;action=Createform{/if}">{if isset($data.user_id)}Modification d'un utilisateur : {$data.user_fname} {$data.user_lname}{else}Création d'un utilisateur{/if}</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<form action="index.php?model=User&amp;action={if isset($data.user_id)}update{else}create{/if}&amp;admin" method="POST" class="formulaire" id="formulaire">
    {if isset($data.user_id)}
        <h3>Modification d'un utilisateur</h3>
        <input type="hidden" id="user_id" name="user_id" value="{$data.user_id}" />
    {else}
        <h3>Création d'un utilisateur</h3>
    {/if}
    
    <label for="user_mail" required="required">Adresse email :</label>
    <input type="text" id="user_mail" name="user_mail" maxlength="128" class="validate[required,custom[email]]" value="{$data.user_mail|default: ''}" />
    
    <label for="user_fname" required="required">Prénom :</label>
    <input type="text" id="user_fname" name="user_fname" maxlength="64" class="validate[required]" value="{$data.user_fname|default: ''}" />
    
    <label for="user_lname" required="required">Nom :</label>
    <input type="text" id="user_lname" name="user_lname" maxlength="64" class="validate[required]" value="{$data.user_lname|default: ''}" />
    
    <label for="user_password" {if !isset($data.user_password)}required="required"{/if}>Mot de passe :</label>
    <input type="password" id="user_password" name="user_password" maxlength="64" class="validate[{if !isset($data.user_password)}required{else}optionnal{/if},minSize[6]]" />
    
    <label for="user_password_confirm" {if !isset($data.user_password)}required="required"{/if}>Confirmation :</label>
    <input type="password" id="user_password_confirm" name="user_password_confirm" maxlength="64" class="validate[{if !isset($data.user_password)}required{else}optionnal{/if},equals[user_password]]" />
    
    <label for="user_website">Site web :</label>
    <input type="text" id="user_website" name="user_website" maxlength="128" class="validate[optional,custom[url]]" value="{$data.user_website|default: ''}" />
    
    <label for="profession_id">Profession :</label>
    <select id="profession_id" name="profession_id">
        <option value="" selected="selected"></option>
        {foreach $data.professions as $id => $profession}
            <option value="{$id}" {if isset($data.profession_id) and $data.profession_id == $id}selected="selected"{/if}>{$profession}</option>
        {/foreach}
    </select>
    
    <input type="submit" value="Valider" />
    <a class="reset" href="{$smarty.server.HTTP_REFERER|default: "index.php?model=Home"}" title="Annuler">Annuler</a>
    <div style="clear:both;"></div>
</form>