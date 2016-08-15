<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe définissant un champ d'une table de la base de données
 * Utilisé dans chaque modèle pour décrire les champs de la table
 * 
 * Utilisation : Field::create('nom du champ', 'nom_champ', type, [required], [min], [max])->add_primary($table)
 * + on_insert(fonction SQL lors du SELECT)                                                 ->add_unique($table, $nom_cle)
 * + on_select(fonction SQL lors de l'INSERT ou UPDATE)                                     ->add($table)
 * 
 * @TODO Adapter pour les fonctions SQL plus complexes, calculs etc ?
 * @TODO Ajouter des types plus restreints : Email, IP,... voir spécifier Regex
 */
final class Field{
    
    /* Le nom du champ */
    protected $name;
    /* La valeur du champ */
    protected $value;
    /* Le type du champ */
    protected $type;
    /* Taille/valeur maximale */
    protected $max;
    /* Taille/valeur minimale */
    protected $min;
    /* Champ obligatoire */
    protected $required;
    /* Fonctions à appliquer à la selection */
    protected $apply_on_select;
    /* Fonctions à appliquer à l'insertion/modif */
    protected $apply_on_insert;
    /* Nom utilisé pour l'affichage utilisateur */
    protected $display_name;
    
    /* Utilisé pour éviter de vérifier plusieurs fois les données */
    protected $is_valid;
    protected $is_already_checked;
    protected $has_been_set;
    /* Message à l'utilisateur si champ non valide */
    protected $message;
    
    /* Types disponibles */
    const STRING = 1;
    const INT = 2;
    const NUMBER = 3;
    const DATE = 4;         // format : jj/mm/yyyy
    const TIMESTAMP = 5;    // format : jj/mm/yyyy hh:mm:ss
    const HTML = 6;
    /* Types plus spécifiques */
    const MAIL = 7;
    const URL = 8;
    
    /**
     * Constructeur de la classe Field - privé - utilisez Field::create
     * @param String $display_name le nom du champ pour l'utilisateur
     * @param String $name le nom du champ en BDD
     * @param Constant $type un des types défini dans Field
     * @param Boolean $required si le champ est obligatoire
     * @param Mixed $min taille/valeur/date minimale autorisée
     * @param Mixed $max taille/valeur/date maximale autorisée
     */
    private function __construct($display_name, $name, $type, $required = NULL, $min = NULL, $max = NULL){
        $this->display_name = $display_name;
        $this->name = $name;
        $this->type = $type;
        
        if(isset($required)){ $this->required = $required; }
        if(isset($min)){ $this->min = $min; }
        if(isset($max)){ $this->max = $max; }
        $this->is_already_checked = false;
        $this->has_been_set = false;
    }
    
    /**
     * Constructeur de la classe Field
     * @param String $display_name le nom du champ pour afficher à l'utilisateur
     * @param String $name le nom du champ dans la base de données
     * @param Constant $type un des types défini dans Field
     * @param Boolean $required si le champ est obligatoire
     * @param Mixed $min taille/valeur/date minimale autorisée
     * @param Mixed $max taille/valeur/date maximale autorisée
     */
    public static function create($display_name, $name, $type, $required = NULL, $min = NULL, $max = NULL){
        return new Field($display_name, $name, $type, $required, $min, $max);
    }
    
    /**
     * Réinitialise le champ
     * @return Field
     */
    public function reset(){
        $this->is_already_checked = false;
        $this->has_been_set = false;
        $this->value = NULL;
        $this->is_valid = NULL;
        $this->message = NULL;
        return $this;
    }
    
    /**
     * Renvoi le nom du champ
     * @return String 
     */
    public function get_name(){
        return $this->name;
    }
    
    /**
     * Met en place la taille/valeur/date maximum autorisée
     * @param Mixed $max 
     * @return Field
     */
    public function set_max($max){
        $this->max = $max;
        return $this;
    }
    
    /**
     * Renvoi le maximum autorisé
     */
    public function get_max(){
        return $this->max;
    }
    
    /**
     * Met en place la taille/valeur/date minimum autorisée
     * @param Mixed $min 
     * @return Field
     */
    public function set_min($min){
        $this->min = $min;
        return $this;
    }
    
    /**
     * Renvoi le minimum autorisé
     */
    public function get_min(){
        return $this->min;
    }
    
    /**
     * Défini la valeur de ce champ
     * @param Mixed $value 
     * @return Field
     */
    public function set_value($value){
        if($value === '')
            $value = NULL;
        
        $this->value = $value;
        $this->is_already_checked = false;
        $this->has_been_set = true;
        return $this;
    }
    
    /**
     * Le champ a t'il été spécifié ?
     * @return Boolean
     */
    public function has_been_set(){
        return $this->has_been_set;
    }
    
    /**
     * Supprime la valeur du champs et le signale comme non assigné
     * @return Field 
     */
    public function unset_value(){
        $this->has_been_set = false;
        $this->value = NULL;
        $this->is_already_checked = false;
        return $this;
    }
    
    /**
     * Renvoi la valeur de ce champ
     * @return Mixed 
     */
    public function get_value(){
        return $this->value;
    }
    
    /**
     * Défini le champ comme obligatoire ou non
     * @param Boolean $bool
     * @return Field
     */
    public function set_required($bool){
        $this->required = $bool;
        return $this;
    }
    
    /**
     * Défini la ou les fonctions à appliquer au SELECT
     * @param String $functions
     * @example 'HEX', 'UPPERCASE(?)'
     * @return Field
     */
    public function on_select($functions){
        $this->apply_on_select = $functions;
        return $this;
    }
    
    /**
     * Renvoi les fonctions à appliquer au SELECT
     * @return String 
     */
    public function get_on_select(){
        return $this->apply_on_select;
    }
    
    /**
     * Défini la ou les fonctions à appliquer au INSERT/UPDATE
     * @param String $functions
     * @example 'UNHEX', 'UPPERCASE(?)'
     * @return Field
     */
    public function on_insert($functions){
        $this->apply_on_insert = $functions;
        return $this;
    }
    
    /**
     * Renvoi les fonctions à appliquer à l'INSERT ou UPDATE
     * @return String 
     */
    public function get_on_insert(){
        return $this->apply_on_insert;
    }
    
    /**
     * Renvoi le type du champ
     * @return Int 
     */
    public function get_type(){
        return $this->type;
    }
    
    /**
     * Renvoi un booléen indiquant si le champ est obligatoire ou non
     * @return Boolean 
     */
    public function is_required(){
        if(isset($this->required) && $this->required)
            return true;
        else
            return false;
    }
    
    /**
     * Renvoi un booléen indiquant si la donnée du champ est valide
     * @return Boolean
     */
    public function is_valid(){
        return $this->is_valid;
    }
    
    /**
     * Défini si la donnée du champ est valide
     * Permet de passer outre les vérifications
     * @param Boolean $bool 
     * @return Field
     */
    public function set_valid($bool){
        $this->is_valid = $bool;
        $this->is_already_checked = true;
        return $this;
    }
    
    /**
     * Renvoi un booléen indiquant si la donnée à déjà été vérifiée
     * @return Boolean
     */
    public function is_already_checked(){
        return $this->is_already_checked;
    }
    
    /**
     * Renvoi les messages décrivant les erreurs lors de la vérification des données
     * @return String les différents erreurs de cohérence des données
     */
    public function get_message(){
        return $this->message;
    }
    
    /**
     * Défini le message décrivant les erreurs de cohérence des données
     * @param String $message
     * @return Field 
     */
    public function set_message($message){
        $this->message = $message;
        return $this;
    }
    
    /**
     * Renvoi le nom du champ compréhensible pour l'utilisateur
     * @return String 
     */
    public function get_display_name(){
        return $this->display_name;
    }
    
    /**
     * Vérifie que les données sont valides
     * @param Field $f
     * @return Boolean 
     */
    public static function check(Field $f){ 
        $result = true;
        $message = '';
        
        if($f->is_already_checked()){
            $result = $f->is_valid();
        } else {
            if($f->is_required() && $f->get_value() === NULL){
                $message .= 'Le champ '.$f->get_display_name().' est requis<br/>';
                $result = false;
            } else {
                if($f->get_value() != NULL){
                    $value = $f->get_value();
                    $mini = $f->get_min();
                    $maxi = $f->get_max();

                    switch($f->get_type()){

                        case Field::STRING :
                            // On encode les balises HTML
                            $f->set_value(htmlspecialchars($value, ENT_COMPAT));

                            if(isset($mini) && strlen($value) < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille inférieure à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && strlen($value) > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille supérieure à '.$maxi.'<br/>';
                                $result = false; break;
                            }
                            break;

                        case Field::INT :
                            if(!is_numeric($value) || $value != round($value)){
                                $message .= 'Le champ '.$f->get_display_name().' doit être un entier<br/>';
                                $result = false; break;
                            } else {
                                $value = (int) $value;
                                $f->set_value($value);
                            }

                            if(isset($mini) && $value < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas être inférieur à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && $value > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas être supérieur à '.$maxi.'<br/>';
                                $result = false; break;
                            }
                            break;

                        case Field::NUMBER :
                            if(!is_numeric($value)){
                                $message .= 'Le champ '.$f->get_display_name().' doit être un entier<br/>';
                                $result = false; break;
                            }

                            if(isset($mini) && $value < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas être inférieur à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && $value > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas être supérieur à '.$maxi.'<br/>';
                                $result = false; break;
                            }
                            break;

                        case Field::DATE :
                            if(!CheckData::checkDate($value)){
                                $value = CheckData::convertDBDDToFramework($value);
                                if(!CheckData::checkDate($value)){
                                    $message .= 'Le champ '.$f->get_display_name().' ne contient pas une date valide<br/>';
                                    $result = false; break;
                                }
                            }

                            $date = DateTime::createFromFormat('d/m/Y', $value);
                            if(isset($mini)){
                                if(strtoupper($mini) == 'NOW'){
                                    $min = date('d/m/Y');
                                } else {
                                    $min = DateTime::createFromFormat('d/m/Y', $mini);
                                }

                                if($date < $min){
                                    $message .= 'Le champ '.$f->get_display_name().' ne doit pas être antérieur à '.$mini.'<br/>';
                                    $result = false; break;
                                }
                            }

                            if(isset($maxi)){
                                if(strtoupper($maxi) == 'NOW'){
                                    $max = date('d/m/Y');
                                } else {
                                    $max = DateTime::createFromFormat('d/m/Y', $maxi);
                                }

                                if($date > $max){
                                    $message .= 'Le champ '.$f->get_display_name().' ne doit pas être postérieur à '.$maxi.'<br/>';
                                    $result = false; break;
                                }
                            }
                            break;

                        case Field::TIMESTAMP :
                            if(!CheckData::checkTimestamp($value)){
                                $value = CheckData::convertTBDDToFramework($value);
                                if(!CheckData::checkTimestamp($value)){
                                    $message .= 'Le champ '.$f->get_display_name().' ne contient pas une date et heure du jour valide<br/>';
                                    $result = false; break;
                                }
                            }

                            $date = DateTime::createFromFormat('d/m/Y H:i:s', $value);
                            if(isset($mini)){
                                if(strtoupper($mini) == 'NOW'){
                                    $min = date('d/m/Y H:i:s');
                                } else {
                                    $min = DateTime::createFromFormat('d/m/Y H:i:s', $mini);
                                }

                                if($date < $min){
                                    $message .= 'Le champ '.$f->get_display_name().' ne doit pas être antérieur à '.$mini.'<br/>';
                                    $result = false; break;
                                }
                            }

                            if(isset($maxi)){
                                if(strtoupper($maxi) == 'NOW'){
                                    $max = date('d/m/Y H:i:s');
                                } else {
                                    $max = DateTime::createFromFormat('d/m/Y H:i:s', $maxi);
                                }

                                if($date > $max){
                                    $message .= 'Le champ '.$f->get_display_name().' ne doit pas être postérieur à '.$maxi.'<br/>';
                                    $result = false; break;
                                }
                            }
                            break;

                        case Field::HTML :
                            // Purification du HTML - TODO ! il faut garder style et script...
                            /**
                             Controller::load_HTMLpurifier();
                            // 1. définir la configuration  
                            $config = HTMLPurifier_Config::createDefault();  
                            $config->set('Core.Encoding', 'UTF-8');  
                            $config->set('HTML.Doctype', 'XHTML 1.0 Transitional');  
                            $config->set('HTML.TidyLevel', 'heavy');  
                            $config->set('HTML.Trusted', true);
                            $config->set('CSS.Trusted', true);
                            $config->set('HTML.SafeObject', true);
                            $config->set('Output.FlashCompat', true);
                            // les balises autorisées  
                             $config->set('HTML.Allowed', 'style');  
                            // ou encore celles interdites  
                            // $config->set('HTML', 'ForbiddenElements', 'iframe');  
                            
                            $purifier = new HTMLPurifier($config);
                            $value = $purifier->purify($value);
                            $f->set_value($value);
                             *
                             */

                            if(isset($mini) && strlen($value) < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille inférieure à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && strlen($value) > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille supérieure à '.$maxi.'<br/>';
                                $result = false; break;   
                            }
                            break;
                            
                        case Field::MAIL :
                            if(!CheckData::checkEmail($value)){
                                $message .= 'Le champ '.$f->get_display_name().' ne contient pas une adresse email valide<br/>';
                                $result = false; break;
                            }
                            
                            if(isset($mini) && strlen($value) < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille inférieure à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && strlen($value) > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille supérieure à '.$maxi.'<br/>';
                                $result = false; break;      
                            }
                            break;
                            
                        case Field::URL :
                            if(!CheckData::checkUrl($value)){
                                $message .= 'Le champ '.$f->get_display_name().' ne contient pas une url valide<br/>';
                                $result = false; break;
                            }
                            
                            if(isset($mini) && strlen($value) < $mini){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille inférieure à '.$mini.'<br/>';
                                $result = false; break;
                            }

                            if(isset($maxi) && strlen($value) > $maxi){
                                $message .= 'Le champ '.$f->get_display_name().' ne doit pas avoir une taille supérieure à '.$maxi.'<br/>';
                                $result = false; break;     
                            }
                            break;

                        default :
                            $result = true;
                            break;
                    }
                } 
            }
        }
        $f->set_message($message);
        $f->set_valid($result);
        return $result;
    }
    
    /**
     * Ajoute ce champ à la table donnée
     * @param Table $t
     * @return Field
     */
    public function add(Table $t){
        $t->add_field($this);
        return $this;
    }
    
    /**
     * Ajoute ce champ à la table donnée en tant que clé primaire
     * @param Table $t
     * @return Field
     */
    public function add_primary(Table $t){
        $t->add_primary_key($this);
        $t->add_field($this);
        return $this;
    }
    
    /**
     * Ajoute ce champ à la table donnée en tant que clé primaire
     * @param Table $t
     * @param String $key_name le nom de la clé unique (si clé sur plusieurs champs)
     * @return Field
     */
    public function add_unique(Table $t, $key_name){
        $t->add_unique_key($this, $key_name);
        $t->add_field($this);
        return $this;
    }
}
?>
