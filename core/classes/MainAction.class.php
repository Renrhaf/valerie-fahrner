<?php
if(!defined('_G_INCLUDED')){
    die('Not included!');
}

/**
 * Superclasse des Actions ou contrôleurs
 */
abstract class MainAction extends MasterClass{
    
    public function __construct(){
        parent::__construct();
    }
    
}
?>