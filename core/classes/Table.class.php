<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe générique décrivant une table de la base de données
 * Elle contient un tableau d'objets Field pour chaque champ
 */
final class Table{
    
    /* Le nom de la table */
    protected $name;
    /* Nom des objets de cette table utilisé pour l'affichage utilisateur */
    protected $display_name;
    /* Tableau des champs */
    protected $fields;
    /* Champs de la clé primaire */
    protected $primary_key;
    /* Tableau des clés uniques */
    protected $unique_keys;
    /* Récapitulatif des erreurs si champs non valides */
    protected $error_messages = Array();
    
    /**
     * Construit un objet Table avec le nom spécifié
     * @param String $name 
     */
    public function __construct($name, $display_name){
        $this->name = $name;
        $this->display_name = $display_name;
        $this->fields = Array();
        $this->primary_key = Array();
        $this->unique_keys = Array();
    }
    
    /**
     * Ajoute le champ en tant que champ de la clé primaire
     * @param Field $primary_key 
     */
    public function add_primary_key(Field $primary_key_field){
        $this->primary_key[$primary_key_field->get_name()] = $primary_key_field;
    }
    
    /**
     * Ajoute le champ en tant que champ d'une clé unique nommée
     * @param Field $unique_key
     * @param String $key_name le nom de la clé unique, pour les clés sur plusieurs champs
     */
    public function add_unique_key(Field $unique_key_field, $key_name){
        if(!isset($this->unique_keys[$key_name])){
            $this->unique_keys[$key_name] = Array();
            $this->unique_keys[$key_name][$unique_key_field->get_name()] = $unique_key_field;
        } else {
            $this->unique_keys[$key_name][$unique_key_field->get_name()] = $unique_key_field;
        }
    }
    
    /**
     * Réinitialise toutes les valeurs des champs
     */
    public function reset(){
        $this->error_messages = Array();
        foreach($this->fields as $field){
            $field->reset();
        }
    }
    
    /**
     * Ajoute le champ à la liste des champs de la table
     * NOTE : cette fonction est appelée par add_unique et add_primary
     * @param Field $f 
     */
    public function add_field(Field $f){
        $this->fields[$f->get_name()] = $f;
    }
    
    /**
     * Renvoi la liste des champs de la table
     * @return Array
     */
    public function get_fields(){
        return $this->fields;
    }
    
    /**
     * Renvoi le nom de l'objet pour afficher à l'utilisateur
     * @return String
     */
    public function get_display_name(){
        return $this->display_name;
    }
    
    /**
     * Renvoi les champs avec leur valeur dans un tableau associatif
     * @return Array
     */
    public function get_values(){
        $res = Array();
        foreach($this->fields as $field){
            $res[$field->get_name()] = $field->get_value();
        }
        return $res;
    }
    
    /**
     * Renvoi la liste des champs de la clé primaire de la table
     * @return Array
     */
    public function get_primary_key(){
        return $this->primary_key;
    }
    
    /**
     * Vérifie si la clé primaire contient des données valides
     * @return Boolean 
     */
    public function is_primary_key_valid(){
        $result = true;
        foreach($this->primary_key as $field){            
            if(!Field::check($field)){
                $this->error_messages[] = $field->get_message();
                $result = false; break;
            }
        }
        return $result;
    }
    
    /**
     * Renvoi un tableau de champs composant les clés uniques de la table
     * @return Array
     */
    public function get_unique_keys(){
        return $this->unique_keys;
    }
    
    /**
     * Renvoi un tableau des champs composant la clé unique demandée
     * @param String $key_name
     * @return Array 
     */
    public function get_unique_key($key_name){
        if(isset($this->unique_keys[$key_name]))
            return $this->unique_keys[$key_name];
        else
            throw new Exception('La clé unique nommée '.$key_name.' n\'existe pas dans la table '.$this->name);
    }
    
    /**
     * Vérifie si la clé unique de nom donné contient des données valides
     * @return Boolean
     */
    public function is_unique_key_valid($uk_name){
        if(!isset($this->unique_keys[$uk_name])){
            throw new Exception('La clé unique nommée '.$uk_name.' n\'existe pas dans la table '.$this->name);
        }
        
        $result = true;
        foreach($this->unique_keys[$uk_name] as $field){
            if(!Field::check($field)){
                $this->error_messages[] = 'Clé unique ('.$uk_name.') : '.$field->get_message();
                $result = false; break;
            }
        }
        return $result;
    }
    
    /**
     * Vérifie si on dispose des données nécessaires pour identifier un objet de la BDD que ce soit par la clé primaire
     * ou par une des clés uniques définies sur la table.
     * @return Boolean
     */
    public function is_able_to_identify_object(){
        if($this->is_primary_key_valid()){
            return true;
        } else {
            $valid = false;
            foreach($this->unique_keys as $uk_name => $uk_fields){
                if($this->is_unique_key_valid($uk_name)){
                    $valid = true; break;
                }
            }
            return $valid;
        }
    }
    
    /**
     * Renvoi le nom de la table
     * @return String
     */
    public function get_name(){
        return $this->name;
    }
    
    /**
     * Renvoi la liste des messages d'erreur provenant de la validation
     * @return Array
     */
    public function get_error_messages(){
        return $this->error_messages;
    }
    
    /**
     * Renvoi le champ de nom donné
     * @return Field
     */
    public function get_field($field_name){
        if(isset($this->fields[$field_name]))
            return $this->fields[$field_name];
        else
            throw new Exception('Le champ '.$field_name.' n\'existe pas dans la table '.$this->name);
    }
    
    /**
     * Vérifie que les données associées aux champs sont valides
     * @return Boolean
     */
    public function check_fields(){
        $result = true;
        foreach($this->fields as $field){
            if($field->has_been_set() && !Field::check($field)){
                $this->error_messages[] = $field->get_message();
                $result = false;
            }
        }
        return $result;
    }
    
    /**
     * Vérifie que la table ne contient pas encore de n-uplet
     * correspondant aux données des clés uniques
     * @return Boolean 
     */
    public function check_unique_keys(){
        $result = true;
        $query = 'SELECT * FROM '.$this->name.' WHERE (';
        $params = Array();
        $i = 0; $nb = count($this->unique_keys);
        foreach($this->unique_keys as $name => $ukey){
            $j = 0; $nb2 = count($ukey);
            foreach($ukey as $field){
                $tmp = $field->get_on_select();
                if(isset($tmp)){
                    $tmp = str_replace('?', $field->get_name(), $tmp);
                    $query .= $tmp.' = ? ';
                    $params[] = $field->get_value();
                } else {
                    $query .= $field->get_name().' = ? ';
                    $params[] = $field->get_value();
                }

                if($j < $nb2-1){
                    $query .= 'AND ';
                } 
                $j++;
            }
            
            if($i < $nb-1){
                $query .= ') OR (';
            } 
            $i++;
        }
        $query .= ')';

        if($params != Array()){
            $data = DB::getInstance()->preparedQuery($query, $params, DB::SINGLE_ROW);

            if($data != false){
                // on cherche les champs ne respectant pas la/les clé(s) unique(s)
                $fields = Array();
                foreach($this->unique_keys as $name => $ukey){
                    $i = 0; $nb = count($this->unique_keys);
                    foreach($ukey as $field){
                        if($field->get_value() == $data[$field->get_name()]){
                            $fields[] = $field->get_display_name();
                        }
                    }
                }
                
                $nb = count($fields);
                if($nb > 0){
                    if($nb > 1){ 
                        $message = 'Attention, les champs '; 
                    } else {
                        $message = 'Attention, le champ ';
                    }
                    
                    $i = 0;
                    foreach($fields as $field){
                        $message .= $field;
                        
                        if($i < $nb-2){
                            $message .= ', ';
                        } else if($i < $nb-1){
                            $message .=' et ';
                        }
                        $i++;
                    }
                    
                    if($nb > 1){ 
                        $message .= ' doivent être uniques. Un(e) '.$this->display_name.' correspondant à ces données existe déjà.'; 
                    } else {
                        $message .= ' doit être unique. Un(e) '.$this->display_name.' correspondant à cette donnée existe déjà.';
                    }

                    $this->error_messages[] = $message;
                } else {
                    $this->error_messages[] = 'Attention, une clé unique n\'a pas été respectée !';
                }
                $result = false;
            }
        }
        return $result;
    }  
    
    /**
     * Détermine si une clé unique a une valeur différente en local et dans la BDD
     * Utilisé avant la sauvegarde en base de données
     * @return boolean 
     */
    public function unique_key_changed(){
        $result = false;

        if(isset($this->unique_keys) && count($this->unique_keys) > 0){
            $query = 'SELECT '; 
            $params = Array();
            foreach($this->unique_keys as $name => $ukey){
                $i = 0; $nb = count($ukey);
                foreach($ukey as $field){
                    $query .= $field->get_name();
                    if($i < $nb-1){
                        $query .= ', ';
                    } 
                    $i++;
                }
            }
            $query .= ' FROM '.$this->name.' WHERE (';
            $i = 0; $nb = count($ukey);
            foreach($this->primary_key as $name => $pkey){
                $tmp = $pkey->get_on_select();
                if(isset($tmp)){
                    $tmp = str_replace('?', $pkey->get_name(), $tmp);
                    $query .= $tmp.' = ? ';
                    $params[] = $pkey->get_value();
                } else {
                    $query .= $pkey->get_name().' = ? ';
                    $params[] = $pkey->get_value();
                }

                if($i < $nb-1){
                    $query .= 'AND ';
                } 
                $i++;
            }
            $query .= ')';
            
            $data = DB::getInstance()->preparedQuery($query, $params, DB::SINGLE_ROW);
            foreach($this->unique_keys as $name => $ukey){
                foreach($ukey as $field){
                    if($field->get_value() != $data[$field->get_name()]){
                        $result = true;
                    }
                }
            }
        }
        return $result;
    }
    
    /**
     * Utilise les informations des champs pour charger un objet de la BDD
     * 
     * Priorité de récupèration :
     * 1. Selon la clé primaire
     * 2. Selon les clés uniques
     * 3. En utilisant toutes les données à disposition
     * 
     * Note : Seule la première ligne est chargée si plusieurs
     * lignes sont selectionnées par la requête.
     * 
     * @TODO le filtrage est déjà possible... permettre le tri/limite
     * @return Boolean
     */
    public function get_data(){       
        $tmp = $this->format_sql_select();
        $data = DB::getInstance()->preparedQuery($tmp['sql'], $tmp['params'], DB::SINGLE_ROW);
        if(!$data){
            return false;
        } else {
            foreach($data as $name => $value){
                $this->fields[$name]->set_value($value);
            }
            return true;
        }
    }
    
    /**
     * Sauvegarde les données dans la BDD
     * La clé primaire ou une clé unique doit être spécifiée
     * Cette fonction ne permet pas la mise à jour d'une clé primaire
     * Pour une mise à jour d'un clé unique, renseigner la clé primaire
     * @return Boolean
     */
    public function save_data(){  
        // on vérifie que les données indiquées sont valides
        if($this->check_fields()){
            // on regarde si on a changé une clé unique
            if($this->unique_key_changed()){
                // si une clé unique va être modifiée on regarde si elle n'est pas violée
                if(!$this->check_unique_keys()){
                    return false;
                }
            }
            
            // on vérifie qu'on a une clé primaire ou unique spécifiée
            $tmp = $this->format_sql_update();
            if($tmp['sql'] != ''){
                DB::getInstance()->commit();
                $data = DB::getInstance()->preparedQuery($tmp['sql'], $tmp['params'], DB::SINGLE_ROW);
                if($data === false){
                    notification('error', ucfirst($this->display_name).' : échec des modifications');
                    DB::getInstance()->rollBack();
                    return false;
                } else {
                    notification('validation',  ucfirst($this->display_name).' : modifications sauvegardées');
                    DB::getInstance()->commit();
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Insère les données dans la BDD
     * @return Boolean
     */
    public function insert_data(){           
        if($this->check_fields() && $this->check_unique_keys()){
            $tmp = $this->format_sql_insert();
            DB::getInstance()->commit();
            $data = DB::getInstance()->preparedQuery($tmp['sql'], $tmp['params'], DB::SINGLE_ROW);
            if(!$data){
                DB::getInstance()->rollBack();
                return false;
            } else {
                DB::getInstance()->commit();
                if(count($this->primary_key) == 1){
                    foreach($this->primary_key as $pk){
                        $pk->set_value(DB::getInstance()->lastInsertId());
                        break;
                    }
                }
                return true;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Supprime les données dans la BDD
     * @return Boolean
     */
    public function delete_data(){
        $tmp = $this->format_sql_delete();
        $data = DB::getInstance()->preparedQuery($tmp['sql'], $tmp['params'], DB::SINGLE_ROW);
        if(!$data){
            return false;
        } else {
            foreach($this->fields as $name => $value){
                $this->fields[$name]->set_value(NULL);
            }
            return true;
        }
    }
    
    /**
     * Met en forme les champs pour la clause Select
     * @return String
     */
    private function format_select_clause(){
        $query = '';
        $i = 0; $nb = count($this->fields);
        foreach($this->fields as $field){
            $tmp = $field->get_on_select();
            if(isset($tmp)){
                $tmp = str_replace('?', $field->get_name(), $tmp);
                $query .= $tmp.' AS '.$field->get_name();
            } else {
                $query .= $field->get_name();
            }

            if($i < $nb-1){
                $query .= ', ';
            } 
            $i++;
        }
        return $query;
    }
    
    /**
     * Met en forme les champs pour la clause Where
     * Priorité :
     * 1. Selon la clé primaire
     * 2. Selon les clés uniques
     * 3. En utilisant toutes les données
     * @return Array('sql' => $sql, 'params' => $params)
     */
    private function format_where_clause($if_no_pk_uk_data = true){
        $query = '';
        $params = Array();
        
        // tableau des champs à utiliser dans WHERE
        $condFields = Array();
        
        // on cherche si la clé primaire est définie
        $get_by_primary_key = true;
        foreach($this->primary_key as $pkey){
            if(!Field::check($pkey)){
                $get_by_primary_key = false;
            }
        }
        
        if($get_by_primary_key){
            $condFields = $this->primary_key;
        } else {
            // pas de clé primaire utilisable
            // on cherche une clé unique définie
            $get_by_unique_keys = true;
            $unique_key_name = ''; 
            foreach($this->unique_keys as $key_name => $fields){
                $unique_key_name = $key_name;
                // si chaque champ de la clé est défini
                foreach($fields as $field){
                    if(!Field::check($field)){
                        $get_by_unique_keys = false;
                    }
                }
                // on a trouvé une clé unique définie
                if($get_by_unique_keys){
                    break;
                }
            }
            
            if($get_by_unique_keys && isset($this->unique_keys[$unique_key_name])){
                $condFields = $this->unique_keys[$unique_key_name];
            } else {
                if($if_no_pk_uk_data){
                    // pas de clé unique utilisable
                    // on cherche les champs qui ont une valeur
                    foreach($this->fields as $field){
                        $tmp = $field->get_value();
                        if(isset($tmp) && Field::check($field)){
                            $condFields[] = $field;
                        }
                    }
                }
            }
        }
        
        // on formate les champs
        $i = 0; $nb = count($condFields);
        foreach($condFields as $field){
            $tmp = $field->get_on_select();
            if(isset($tmp)){
                $tmp = str_replace('?', $field->get_name(), $tmp);
                $query .= $tmp.' = ? ';
                $params[] = $field->get_value();
            } else {
                $query .= $field->get_name().' = ? ';
                $params[] = $field->get_value();
            }

            if($i < $nb-1){
                $query .= 'AND ';
            } 
            $i++;
        }
        
        return Array('sql' => $query, 'params' => $params);
    }
    
    /**
     * Met en forme la requête SELECT
     * @return Array('sql' => $sql, 'params' => $params)
     */
    private function format_sql_select(){
        $tmp = $this->format_where_clause();
        $query = 'SELECT '.$this->format_select_clause().' FROM '.$this->name;
        if($tmp['sql'] != ''){ $query .= ' WHERE '.$tmp['sql']; }
        $params = $tmp['params'];
        return Array('sql' => $query, 'params' => $params);
    }
    
    /**
     * Met en forme la requête INSERT
     * @return Array('sql' => $sql, 'params' => $params)
     */
    private function format_sql_insert(){
        $tmp = $this->format_where_clause();
        $query = 'INSERT INTO '.$this->name.'(';
        $params = Array();
        
        $insertFields = Array();
        foreach($this->fields as $field){
            $value = $field->get_value();
            if(isset($value) && Field::check($field)){
                $insertFields[] = $field;
            }
        }
        
        $i = 0; $nb = count($insertFields);
        foreach($insertFields as $field){
            $query .= $field->get_name();
            if($i < $nb-1){
                $query .= ', ';
            }
            $i++;
        }
        
        $query .= ') VALUES(';
        
        $i = 0;
        foreach($insertFields as $field){
            $tmp = $field->get_on_insert();
            if(isset($tmp)){
                $query .= $tmp;
                $params[] = $field->get_value();
            } else {
                $query .= '?';
                $params[] = $field->get_value();
            }
            
            if($i < $nb-1){
                $query .= ', ';
            }
            $i++;
        }
        
        $query .= ')';
        
        return Array('sql' => $query, 'params' => $params);
    }
    
    /**
     * Met en forme la requête UPDATE
     * @return Array('sql' => $sql, 'params' => $params)
     */
    private function format_sql_update(){
        $where = $this->format_where_clause(false);
        
        $query = 'UPDATE '.$this->name.' SET ';
        $params = Array();
        
        $setFields = Array();
        foreach($this->fields as $field){
            if($field->has_been_set() && Field::check($field)){
                $setFields[] = $field;
            }
        }
        
        $i = 0; $nb = count($setFields);
        foreach($setFields as $field){
            $tmp = $field->get_on_insert();
            if(isset($tmp)){
                $query .= $field->get_name().' = '.$tmp;
                $params[] = $field->get_value();
            } else {
                $query .= $field->get_name().' = ?';
                $params[] = $field->get_value();
            }
            
            if($i < $nb-1){
                $query .= ', ';
            }
            $i++;
        }
        
        if($where['sql'] != ''){ 
            $query .= ' WHERE '.$where['sql']; 
            $params = array_merge($params,$where['params']);
            return Array('sql' => $query, 'params' => $params);
        } else {
            return Array('sql' => '', 'params' => Array());
        }
    }
    
    /**
     * Met en forme la requête DELETE
     * @return Array('sql' => $sql, 'params' => $params)
     */
    private function format_sql_delete(){
        $tmp = $this->format_where_clause();
        $query = 'DELETE FROM '.$this->name;
        if($tmp['sql'] != ''){ $query .= ' WHERE '.$tmp['sql']; }
        $params = $tmp['params'];
        return Array('sql' => $query, 'params' => $params);
    }
}
?>