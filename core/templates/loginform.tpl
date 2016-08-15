<img id="backImg" src="core/images/space.jpg" style="display:none;" />
<div id="login-embedded" style="display: none;">
    <a rel="nofollow" id="close-login" href="#" title="fermer"></a>
    <div id="embedded-login">
        <h3 id="TemLog">Accès à votre espace personnel</h3>

        <form name="loginForm" action="index.php?model=User&amp;action=Login" method="post" id="loginForm">
            <div>
                <p>
                    <label id="label_mail" for="mail" class="label">Adresse e-mail</label>
                    <input id="mail" value="" name="mail" maxlength="320" type="text" tabindex="1" class="input" />
                </p>

                <p id="passP">
                    <label id="label_password" for="password" class="label">Mot de passe</label>
                    <input id="password" name="password" maxlength="16" type="password" tabindex="2" autocomplete="off" class="input" />
                </p>

                <p style="margin-top:5px;">
                    <input id="submitButton" class="boutonB" type="submit" value="Se connecter" />
                    <input id="forgotPassword" class="boutonW" type="reset" style="text-align:center; float:right;" value="Identifiants oubliés ?" onclick="into_forgot_form(); return false;">
                </p>
                <div style="clear:both;"></div>
            </div>
        </form>
    </div>
</div>
<div id="blackout" style="display: none;"></div>