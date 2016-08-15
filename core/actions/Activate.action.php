<?php
namespace Action;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Activation/désactivation d'un objet en BDD
 * La table de la BDD doit suivre la convention 'nomtable_active' pour le champ actif/inactif
 * 
 * Nécessite le passage en GET de :
 * - un moyen d'identifier l'objet de manière unique (clé primaire ou unique)
 * - 'val' : la nouvelle valeur déterminant si l'objet doit être activé/désactivé
 * 
 * Pour plus d'informations sur le passage en GET de clé primaire/unique
 * @see ObjectModel::init_from_url();
 * @see ObjectModel::build_init_url();
 * @see Exception\CantIdentifyObject
 */
final class Activate extends Action{
    
    private $method_name = 'activate';
    private $display_name = 'activer/désactiver';
    
    public function __construct(\ObjectModel $model){
        parent::__construct($model);
        
        // on vérifie le droit d'accès
        if($this->model->get_mode() == \Model::FRONTEND || ($this->model->get_mode() == \Model::BACKEND && !isset($_SESSION['user']))){
            throw new \Exception\AccessDenied('Vous devez être connecté et en mode BACKEND');
        }
        
        // on initialise le modèle avec les données passées en GET
        $this->model->init_from_url(); // @throws CantIdentifyObject
    }
    
    public function perform(){        
        // on vérifie le status actif ou non passé en GET
        if(!isset($_GET['val'])){
            throw new \Exception('Il faut passer en GET le paramètre val');
        }
        
        if($_GET['val'] != 0 && $_GET['val'] != 1){
            throw new \Exception('le paramètre val doit être égal à 0 ou 1');
        }

        $result = $this->model->activate($_GET['val']);
        if($this->conf->get('ajax')){            
            if($result){
                if($_GET['val'] == 1){
                    echo(json_encode(Array('validation' => 'Activation effectuée'))); exit;
                } else {
                    echo(json_encode(Array('validation' => 'Désactivation effectuée'))); exit;
                }
            } else {
                $errors = Array();
                $messages = $this->model->get_table()->get_error_messages();
                foreach($messages as $message){
                    $errors[] = $message;
                }
                echo(json_encode(Array('error' => $errors))); exit;
            }
        } else {
            return $result;
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
