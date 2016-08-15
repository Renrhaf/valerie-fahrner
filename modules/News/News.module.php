<?php

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

class News extends Module{
    
    protected $default_model = 'News';
    
    public function __construct(){
        parent::__construct();
    }
}
?>
