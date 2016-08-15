<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="index.php">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="index.php?model=User&action=showlist">Liste des utilisateurs</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Liste des utilisateurs</h3>

{foreach $data.users as $user}
    <div class="galerie" id="galerie_{$user.user_id}">
        <div class="galerie_header">
            {$user.user_fname} {$user.user_lname}
        </div>
    </div>
{/foreach}

