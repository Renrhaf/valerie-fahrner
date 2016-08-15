<div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="contactez-nous">Formulaire de contact</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Formulaire de contact</h3>

<form action="index.php?model=contact&amp;action=send" method="post" style="margin:10px 10px 0px 10px;">
    <div>
        <p>
            <label for="mail" class="label"><span class="mail_icon"></span>Adresse e-mail</label><br/>
            <input name="mail" maxlength="320" type="text" tabindex="3" class="input" style="width:960px;" value="{if isset($data.mail)}{$data.mail}{else}{if isset($smarty.post.mail)}{$smarty.post.mail}{/if}{/if}" />
        </p>

        <p>
            <label id="label_message" for="message" class="label"><span class="comment_icon"></span>Message</label><br/>
            <textarea id="message" name="message" tabindex="4" class="input" style="width:960px;height:150px;">{if isset($data.message)}{$data.message}{else}{if isset($smarty.post.message)}{$smarty.post.message}{/if}{/if}</textarea>
        </p>

        <p>
            <input class="boutonB" type="submit" value="Envoyer" />
            <input class="boutonW" type="reset" value="Effacer" style="float:right;" />
        </p>
    </div>
</form>