<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Superclasse des Modules
 */
abstract class Module extends MasterClass{
    
    public function __construct(){
        parent::__construct();
    }
    
    final public function get_default_model(){
        return $this->default_model;
    }
}
?>
