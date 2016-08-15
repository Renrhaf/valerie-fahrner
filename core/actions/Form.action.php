<?php
/**
 * Affichage d'un formulaire
 */
class Form extends MainAction{
    
    public function __construct(){
        parent::__construct();
    }
    
    /**
     * Affiche le formulaire de création/édition d'un objet
     * Si édition, nécéssite de passe en GET la variable :
     * - id : l'identifiant unique de l'objet
     * Les clés primaires et uniques multiples ne sont pas supportées
     * @param Object $model le modèle initialisé
     */
    public function do_action($model){
        $result = NULL;
        
        // on vérifie le droit d'accès
        if($model->get_mode() == MainModel::FRONTEND){
            if($this->conf->get('ajax')){
                echo(json_encode(Array('error' => 'Vous n\'avez pas les droits nécessaires')));
                exit;
            } else {
                notification('error','Vous n\'avez pas les droits nécessaires');
                redirect();
            }
        }
        
        if(isset($_GET['id'])){
            // on vérifie l'id passé en GET
            if(!CheckData::checkId($_GET['id'])){
                if($this->conf->get('ajax')){
                    echo(json_encode(Array('error' => 'ID non valide')));
                    exit;
                } else {
                    notification('error','ID non valide');
                    redirect();
                }
            }
        }
        
        // on lance la méthode form
        if(method_exists($model, 'form')){
            if(isset($_SERVER['HTTP_REFERER'])){
                // on mémorise la page précédente pour redirection après action Create
                $_SESSION['EDIT_REFERER'] = $_SERVER['HTTP_REFERER'];
            }
            $result = $model->form();
        } else {
            if($this->conf->get('ajax')){
                echo(json_encode(Array('error' => 'Action non autorisée')));
                exit;
            } else {
                notification('error','Action non autorisée');
                redirect();
            }
        }
        
        // on charge les fichiers de formValidator
        Controller::load_form_validator();
        return $result;            
    }
}

?>
