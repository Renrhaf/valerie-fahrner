<?php
if(!defined('_G_INCLUDED')){
    die('Not included!');
}

/**
 * Superclasse des Modules
 */
abstract class MainModule extends MasterClass{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_default_model(){
        return $this->default_model;
    }
}
?>
