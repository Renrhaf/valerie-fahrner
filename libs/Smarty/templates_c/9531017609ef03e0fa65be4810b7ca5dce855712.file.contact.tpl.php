<?php /* Smarty version Smarty-3.1.7, created on 2012-06-04 13:07:50
         compiled from "core/templates/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17087031574fad72ecdb4368-87517586%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9531017609ef03e0fa65be4810b7ca5dce855712' => 
    array (
      0 => 'core/templates/contact.tpl',
      1 => 1338806903,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17087031574fad72ecdb4368-87517586',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_4fad72ecf0deb',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fad72ecf0deb')) {function content_4fad72ecf0deb($_smarty_tpl) {?><div id="site_path">
    <span class="path"><span class="pathS"></span><a class="pathB" href="">Accueil</a><span class="pathE"></span></span>
    <span class="path"><span class="pathSNF"></span><a class="pathB" href="contactez-nous">Formulaire de contact</a><span class="pathE"></span></span>
    <div style="clear:both;"></div>
</div>

<h3 class="page_title">Formulaire de contact</h3>

<form action="index.php?model=contact&amp;action=send" method="post" style="margin:10px 10px 0px 10px;">
    <div>
        <p>
            <label for="mail" class="label"><span class="mail_icon"></span>Adresse e-mail</label><br/>
            <input name="mail" maxlength="320" type="text" tabindex="3" class="input" style="width:960px;" value="<?php if (isset($_smarty_tpl->tpl_vars['data']->value['mail'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['mail'];?>
<?php }else{ ?><?php if (isset($_POST['mail'])){?><?php echo $_POST['mail'];?>
<?php }?><?php }?>" />
        </p>

        <p>
            <label id="label_message" for="message" class="label"><span class="comment_icon"></span>Message</label><br/>
            <textarea id="message" name="message" tabindex="4" class="input" style="width:960px;height:150px;"><?php if (isset($_smarty_tpl->tpl_vars['data']->value['message'])){?><?php echo $_smarty_tpl->tpl_vars['data']->value['message'];?>
<?php }else{ ?><?php if (isset($_POST['message'])){?><?php echo $_POST['message'];?>
<?php }?><?php }?></textarea>
        </p>

        <p>
            <input class="boutonB" type="submit" value="Envoyer" />
            <input class="boutonW" type="reset" value="Effacer" style="float:right;" />
        </p>
    </div>
</form><?php }} ?>