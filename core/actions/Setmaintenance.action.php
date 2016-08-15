<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Mise en maintenance du site ou remise en ligne
 */
final class SetMaintenance extends Action{
    
    private $method_name = 'set_maintenance';
    private $display_name = 'Mise en maintenance/Remise en ligne';
    
    public function __construct(\Model $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }        
    }
    
    public function perform(){
        // vérifications du status
        if(!isset($_GET['status'])){
            throw new \Exception('Il faut passer en GET le paramètre status');
        }
        
        if($_GET['status'] != 0 && $_GET['status'] != 1){
            throw new \Exception('Le paramètre status doit être égal à 1 ou 0');
        }
        
        if($_GET['status'] == 1 && (!isset($_GET['estimated']) || $_GET['estimated'] == '')){
            throw new \Exception('Il faut passer en GET le paramètre estimated');
        }
        
        $estimated = (isset($_GET['estimated'])?$_GET['estimated']:'2 heures');
        
        $this->model->set_maintenance($_GET['status'], $estimated);
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}


?>
