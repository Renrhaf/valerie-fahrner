<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant un mot clé
 * \author renrhaf
 */
class Keyword extends \ObjectModel{
    
    /**
     * Constructeur de la classe
     */
    public function __construct(Array $data = NULL){
        $table = new \Table('keyword','mot clé');
        \Field::create('Identifiant', 'keyword_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Mot clé', 'keyword_name', \Field::STRING, true, 3, 32)->add_unique($table,'uk_name');
        $this->set_table($table);
        
        parent::__construct($data);
    }
    
    /**
     * Affichage
     */
    public function show(){ 
       $res = Array();
       $res['data'] = $this->get_values();
       // charger des stats
       // combien de fois utilisé ... etc
       $this->set_template('keyword.tpl');  
       $this->conf->set('site_description',  'Affichage des information du mot clé '.$this->get('keyword_name'));
       $this->conf->set('site_title', 'Mot clé : '.$this->get('keyword_name'));
       return $res;
    }
    
    /**
     * Insertion d'un mot clé
     */
    public function create(){
        if(parent::create()){
            if($this->conf->get('ajax')){
                echo($this->get('keyword_id'));
                exit;
            } else {
                notification('validation','Le mot clé '.$this->get('keyword_name').' a bien été ajouté.');
                redirect();
            }
        } else {
            if($this->conf->get('ajax')){
                echo('-1');
                exit;
            } else {
                notification('error','Erreur lors de l\'ajout du mot clé !');
                redirect();
            }
        }
    }

    /**
     * Récupère la liste des mots clés correspondant au motif
     * utilisé pour l'autocomplétion
     */
    public function getjson(){
        if(\CheckData::checkString($_POST['search'])){
            $query = 'SELECT * FROM keyword WHERE UPPER(keyword_name) LIKE "'.mb_strtoupper($_POST['search']).'%"';
            $data = $this->db->query($query);
            if(!$data){
                echo(json_encode(array('error' => 'noresult')));
            } else {
                echo(json_encode($data));
            }
            exit;
        } else {
            echo(json_encode(array('error' => 'Le mot clé contient des caractères interdits')));
            exit;
        }
    }
}
?>