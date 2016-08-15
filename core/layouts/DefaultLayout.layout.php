<?php 
namespace Layout;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?');

/**
 * Mise en page par défaut, avec header, menu, page et footer
 * Voir global.tpl
 */
class DefaultLayout extends \Layout {
    
    public function __construct(){
        parent::__construct();
        $this->template = 'global.tpl';
        
        if(!$this->conf->get('ajax')){
            // on ajoute le CSS
            $this->conf->add('css','core/css/page.css');
            $this->conf->add('css','core/css/styles.css');
            if(!isset($_SESSION['user']))
                $this->conf->add('css','core/css/login.css');
            else
                $this->conf->add('css','core/css/backoffice.css');

            // on ajoute le JS
            if(!isset($_SESSION['user']))
                $this->conf->add('async_js','core/js/login.js');
            else
                $this->conf->add('async_js','core/js/backoffice.js');
        }
    }

    /**
     * Ajout des données relatives à ce layout
     */
    public function build(){
        // on transmet les données du menu à Smarty
        if(!$this->conf->get('ajax')){
            $m = new \Core\Menu();
            $this->assign('menu', $m->show());
        }
    }
}
?>