<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Déconnexion d'un utilisateur
 */
final class Logout extends Action{
    
    private $method_name = 'logout';
    private $display_name = 'se déconnecter';
    
    public function __construct(\Model $model){
        parent::__construct($model);
    }
    
    public function perform(){
        if(isset($_SESSION['user'])){
            $this->model->logout();
            notification('validation','Déconnexion effectuée ! Au revoir, '.$_SESSION['user']['user_fname'].' '.$_SESSION['user']['user_lname']);
            unset($_SESSION['user']);
        } else {
            notification('error','Vous n\'êtes pas (ou plus) connecté !');
        }
        redirect();
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}


?>
