<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Envoi d'un mail ou d'une information
 */
class Send extends Action{
    
    private $method_name = 'send';
    private $display_name = 'envoyer';
    
    public function __construct(\Model $model){
        parent::__construct($model);
    }
    
    public function perform(){
        $result = NULL;
        $result = $this->model->send();
        return $result;        
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}

?>
