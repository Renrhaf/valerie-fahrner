<?php
/**
 * Affichage d'un objet, d'une page... mais PAS avec un ID
 * TOUTES les vérifications doivent être effectuée dans la fonction du modèle
 * @TODO supprimer cette classe...
 */
class Showother extends MainAction{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function do_action(MainModel $model){
        $result = NULL;

        // on lance la méthode showother
        if(method_exists($model, 'showother')){
            $result = $model->showother();
        } else {
            if($this->conf->get('ajax')){
                echo(json_encode(Array('error' => 'Action non autorisée')));
                exit;
            } else {
                notification('error','Action non autorisée');
                redirect();
            }
        }
        
        return $result;        
    }
}

?>
