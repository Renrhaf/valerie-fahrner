<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Connexion d'un utilisateur
 */
final class Login extends Action{
    
    private $method_name = 'login';
    private $display_name = 'se connecter à';
    
    public function __construct(\Model $model){
        parent::__construct($model);
    }
    
    public function perform(){
        $continue = true;
        
        // vérifications de l'email et du mot de passe
        if(!isset($_POST['mail']) || empty($_POST['mail'])){
            notification('error','L\'email n\'a pas été précisé');
            $continue = false;
        }
        
        if(!isset($_POST['password']) || empty($_POST['password'])){
            notification('error','Le mot de passe n\'a pas été précisé');
            $continue = false;
        }
        
        if($continue && !\CheckData::checkEmail($_POST['mail'])){
            notification('error','L\'email n\'est pas valide');
            $continue = false;
        }
        
        if($continue && !\CheckData::checkPassword($_POST['password'])){
            notification('error','Le mot de passe n\'est pas valide');
            $continue = false;
        }
        
        // si on a passé tous les tests
        if($continue){
            // on lance la méthode login
            $result = $this->model->login($_POST['mail'], $_POST['password']);
            if($result){
                notification('validation','Connexion réussie ! Bienvenue, '.$_SESSION['user']['user_fname'].' '.$_SESSION['user']['user_lname']);
                redirect($this->model->get_redirection());
            }
        } else {
            redirect();
        }
    }
    
    public function get_method_name(){
        return $this->method_name;
    }
    
    public function get_display_name(){
        return $this->display_name;
    }
}


?>
