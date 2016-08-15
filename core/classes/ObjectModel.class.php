<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Super Objet définissant les propriétés et méthodes utiles pour tous les modèles d'objets
 * Important : doit être étendu par tous les objets de la base de données
 * @author renrhaf
 */
abstract class ObjectModel extends Model{

    /**
     * Objet Table contenant les infos sur la table et les champs 
     * -> Doit être définie dans tous les modèles qui héritent
     * -> Ne pas oublier d'utiliser ObjectModel::set_table()
     */
    private $table = NULL;
    
    /* Détermine si les données sont chargées */
    protected $data_loaded = false;

    /**
     * Constructeur de la classe ObjectModel
     * Il est possible de donner directement des données pour identifier de manière unique l'objet en base de données.
     * Dans ce cas, spécifiez dans $array les champs et les valeurs de la clé unique ou primaire.
     * @example new Object(Array('object_id' => 1));
     * @param Array $array - tableau associatif nomChamp => valeur
     */
    public function __construct(Array $array = NULL){
        parent::__construct();
        
        if($this->table == NULL){
            throw new Exception('L\'objet Table du modèle n\'a pas été définie, ou mal définie. Pensez à utiliser la méthode set_table pour la définir, car c\'est un attribut privé !');
        }
        
        if($array != NULL){
            $data_str = '';
            if($this->conf->get('debug')){
                $data_str = 'Array(';
                $i = 0; $nb = count($array);
                foreach($array as $key => $val){
                    $data_str .= '\''.$key.'\' => '.$val;
                    if($i < $nb-1) 
                        $data_str .= ', ';
                    $i++;
                }
                $data_str .= ')';
                Debug::add('ObjectModel : '.get_class($this), 'construction de l\'objet avec des données : '.$data_str);
            }
            
            foreach($array as $field_name => $field_value){
                $field = $this->table->get_field($field_name);
                $field->set_value($field_value);
            }            
            $this->load();
        }
    }
    
    /**
     * Vérifie si on peut identifier de manière unique un objet de ce type à partir des informations données dans l'URL (en GET). 
     * Si c'est le cas, les informations données sont assignées aux champs concernés pour un futur chargement de l'objet.
     * @warning ne lance pas la fonction ObjectModel::load() pour chercher les données dans la BDD.
     * @throws CantIdentifyObject - Lance une exception de ce type en cas de problème.
     */
    final public function init_from_url(){
        if($this->conf->get('debug')){
            Debug::add('ObjectModel : '.get_class($this), 'tentative d\'identifier une clé primaire ou unique passée en GET');
        }
            
        $res = false;
        // On vérifie si la clé primaire est bien définie dans l'URL
        if(isset($_GET['pk'])){
            // Un seul paramètre : cas d'un ID par exemple
            if(!is_array($_GET['pk']) && count($this->table->get_primary_key()) == 1){
                // On set la valeur
                $pk_fields = $this->table->get_primary_key();
                foreach($pk_fields as $field){
                    $field->set_value($_GET['pk']);
                }
                // Puis on vérifie sa cohérence
                $res = $this->table->is_primary_key_valid();
            
            // Plusieurs paramètres : clé primaire composée
            } elseif(count($this->table->get_primary_key()) == count($_GET['pk'])){
                $i = 0; $pk_fields = $this->table->get_primary_key();
                foreach($_GET['pk'] as $param){
                    $j = 0;
                    // On set les valeurs
                    foreach($pk_fields as $field){
                        if($i == $j){
                            $field->set_value($param); 
                            break;
                        }
                        $j++;
                    }
                    $i++;
                }
                // Puis on vérifie leur cohérence
                $res = $this->table->is_primary_key_valid(); 
            }
        // On vérifie si une clé unique est définie dans l'URL
        } elseif(isset($_GET['uk'])){            
            if(is_array($_GET['uk']) && count($_GET['uk']) > 1){
                $uk_name = $_GET['uk'][0];
                $uk_fields = $this->table->get_unique_key($uk_name);
                if(count($uk_fields) == (count($_GET['uk'])-1)){
                    $ignore_first = true; $i = 0;
                    foreach($_GET['uk'] as $param){
                        if(!$ignore_first){
                            $j = 0;
                            // On set les valeurs
                            foreach($uk_fields as $field){
                                if($i == $j){
                                    $field->set_value($param);
                                    break;
                                }
                                $j++;
                            }
                            $i++;
                        }
                        $ignore_first = false;
                    }
                    // Puis on vérifie leur cohérence
                    $res = $this->table->is_unique_key_valid($uk_name);
                }
            }
        }
        // Si on n'a pas trouvé de clé primaire ni de clé unique définie correctement
        if(!$res){
            throw new Exception\CantIdentifyObject($this);
        }
    }
    
    /**
     * Renvoi la partie d'URL permettant d'identifier cet objet (passage en GET).
     * Charge les données de l'objet puis utilise la clé primaire.
     * @return String - à insérer dans l'URL pour pouvoir identifier l'objet
     */
    final public function build_init_url(){
        $data = Array();
        $data['pk'] = Array();
        $this->load();
        $pk_fields = $this->table->get_primary_key();
        foreach($pk_fields as $field){
            $data['pk'][] = $field->get_value();
        }
        return http_build_query($data, 'var', '&amp;');
    }
    
    /**
     * Lance le chargement des données de la BDD de cet objet.
     * @see Table::get_data()
     */
    final public function load(){
        if(!$this->data_loaded){
            if($this->conf->get('debug')){
                Debug::add('ObjectModel : '.get_class($this), 'chargement des données de l\'objet '.$this->table->get_display_name().' en base de données');
            }
            
            if(!$this->table->is_able_to_identify_object()){
                throw new Exception\CantIdentifyObject($this);
            }
            
            if(!$this->table->get_data()){
                throw new Exception\ObjectNotExists($this->table);
            }
            $this->data_loaded = true;
        }
    }
    
    /**
     * Supprime l'objet de la base de données
     * @return Boolean
     */
    public function delete(){
        if($this->conf->get('debug')){
            Debug::add('ObjectModel : '.get_class($this), 'suppression de l\'objet '.$this->table->get_display_name());
        }
        
        return $this->table->delete_data();
    }
    
    /**
     * Sauvegarde l'objet dans la base de donnée
     * @return Boolean
     */
    public function update(){
        if($this->conf->get('debug')){
            Debug::add('ObjectModel : '.get_class($this), 'mise à jour de l\'objet '.$this->table->get_display_name());
        }
        
        $res = $this->table->save_data();
        if(!$res){
            $messages = $this->table->get_error_messages();
            foreach($messages as $message){
                notification('error',$message);
            }
        }
        return $res;
    }
    
    /**
     * Insère l'objet dans la base de données
     * @return Boolean
     */
    public function create(){
        if($this->conf->get('debug')){
            Debug::add('ObjectModel : '.get_class($this), 'création d\'un nouvel objet '.$this->table->get_display_name());
        }
        
        $res = $this->table->insert_data();
        if(!$res){
            $messages = $this->table->get_error_messages();
            foreach($messages as $message){
                notification('error',$message);
            }
        }
        return $res;
    }
    
    /**
     * Activation ou désactivation de l'objet
     * @param int $new_value 0 = inactif, 1 = actif
     * @return Boolean
     */
    public function activate($new_value){
        try{
            $field = $this->table->get_field($this->table->get_name().'_active');
            $field->set_value($new_value);
            return $this->table->save_data();
        } catch(Exception $e){
            throw new Exception\ActionNotAllowed(new Action\Activate($this), $this);
        }
    }
      
    /**
     * Renvoi le champ de nom donné
     * @param String $field_name
     * @return Field
     */
    final public function get_field($field_name){
        return $this->table->get_field($field_name);
    }
    
    /**
     * Renvoi la valeur du champ de nom donné
     * @param String $field_name
     * @return Mixed 
     */
    final public function get($field_name){
        return $this->table->get_field($field_name)->get_value();
    }
    
    /**
     * Défini la valeur du champ de nom donné
     * @param String $field_name
     * @param Mixed $value 
     */
    final public function set($field_name, $value){
        $this->table->get_field($field_name)->set_value($value);
    }
    
    /**
     * Renvoi la table du modèle
     * @return Table 
     */
    final public function get_table(){
        return $this->table;
    }
    
    /**
     * Défini la table du modèle
     * @param Table $table 
     */
    final public function set_table(Table $table){
        $this->table = $table;
    }
    
    /**
     * Renvoi toutes les données de l'objet
     * @return Array
     */
    public function get_values(){
        if(!$this->data_loaded)
            $this->load_data();
        return $this->table->get_values();
    }
    
    /**
     * Réinitialise la table et vide les valeurs
     */
    final public function reset(){
        if($this->conf->get('debug')){
            Debug::add('ObjectModel : '.get_class($this), 'réinitialisation des données de l\'objet '.$this->table->get_display_name());
        }
        
        $this->table->reset();
        $this->data_loaded = false;
    }
    
    /**
     * @TODO à partir d'ici : faire quelquechose pour mieux organiser ces fonctions
     * elles ne devraient pas se trouver ici je pense
     * -> Utiliser des interfaces ? héritage ?
     * -> Multipage : uniquement utilisé avec l'action showlist ?
     *                non, pas forcement : trouver autre chose
     */
    
    /**
     * Génére les données nécessaires à la gestion du multipage
     * @param int $total_number le nombre total d'élements à paginer
     * Ce paramètre doit être calculé en utilisant une requête du type COUNT(*)
     * @return Array $data tableau contenant les données du multipage
     */
    protected function get_multipage_data($total_number){
        $data = Array();
        $data['total'] = $total_number;
        $data['nb_per_page'] = $this->conf->get('elem_per_page');
        
        if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1)
            $data['page'] = $_GET['page'];
        elseif(isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 1)
            $data['page'] = $_POST['page'];
        else
            $data['page'] = 1;
        
        $data['start'] = ($data['page'] - 1) * $data['nb_per_page'];
        $data['nb_pages'] = ceil($data['total'] / $data['nb_per_page']);
        return $data;
    }
    
    /**
     * Rajoute les clauses ORDER BY et LIMIT pour les listes d'objets paginées
     * @param String $query la requête SQL, sans clauses ORDER BY et LIMIT
     * @param Array $data le tableau renvoyé par get_multipage_data()
     * @return string la requête à envoyer au serveur SQL
     */
    protected function add_order_limit($query, $data, $possible_fields = Array()){
        if(isset($_GET['tri']) && isset($_GET['ord'])){
            $found = false;
            $fields = $this->table->get_fields();

            foreach($fields as $field){
                if($field->get_name() == $_GET['tri']){
                    $found = true;
                    break;
                }
            }
            
            if($possible_fields != Array()){
                if(in_array($_GET['tri'], $possible_fields)){
                    $found = true;
                }
            }

            if($found){
                $tmp = strtoupper($_GET['ord']);
                if($tmp != 'ASC' && $tmp != 'DESC'){
                    $tmp = 'ASC';
                }
                $query .= ' ORDER BY '.$_GET['tri'].' '.$tmp;
            }
        }
        $query .= ' LIMIT '.$data['start'].', '.$data['nb_per_page'];
        return $query;
    }
    
    /**
     * Récupère les mots clés associés à cet objet
     * Il faut respecter le format xxxxx_keyword pour la table de liaison
     * @return Array les mots clés associés
     */
    protected function get_keywords(){
        $res = Array();
        
        // on récupère la clé primaire
        $pk = NULL;
        $tmp = $this->table->get_primary_key();
        foreach($tmp as $k){
            $pk = $k;
            break;
        }
        
        // on récupère les mots clés associés
        $this->db->setFetchMode(DB::TWO_COLUMNS);
        $res = $this->db->preparedQuery('SELECT keyword_id, keyword_name FROM keyword NATURAL JOIN '.$this->table->get_name().'_keyword NATURAL JOIN '.$this->table->get_name().' WHERE '.$pk->get_name().' = ?', Array($pk->get_value()));
        $this->db->setFetchMode(\DB::ARRAY_ASSOC);
        return $res;
    }
    
    /**
     * Insère les mots clés passés en POST
     * Il faut respecter le format xxxxx_keyword pour la table de liaison
     */
    protected function insert_keywords(){
        // on récupère la clé primaire
        $pk = NULL;
        $tmp = $this->table->get_primary_key();
        foreach($tmp as $k){
            $pk = $k;
            break;
        }
        
        // on supprime tous les mots clés associés
        $query = 'DELETE FROM '.$this->table->get_name().'_keyword WHERE '.$pk->get_name().' = ?';
        $this->db->preparedQuery($query, Array($pk->get_value()));
        
        // et on insère tous les mots clés passés en POST
        if(isset($_POST['keywords']) && count($_POST['keywords']) > 0){
            $query = 'INSERT INTO '.$this->table->get_name().'_keyword('.$pk->get_name().', keyword_id) VALUES';
            $params = Array();
            $i = 0; $nb = count($_POST['keywords']);
            foreach($_POST['keywords'] as $keyword_id){
                $query .= '(?,?)';
                $params[] = $pk->get_value();
                $params[] = $keyword_id;
                if($i < $nb-1){
                    $query .= ',';
                }
                $i++;
            }
            $kinserted = $this->db->preparedQuery($query, $params);
            if($kinserted != $nb){
                notification('error','Attention, tous les mots clés n\'ont pas été enregistrés suite à une erreur.');
            }
        }
    }
}
?>