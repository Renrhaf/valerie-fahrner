<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

class Core extends Module{
    
    protected $default_model = 'Index';
    
    public function __construct(){
        parent::__construct();
    }
}
?>
