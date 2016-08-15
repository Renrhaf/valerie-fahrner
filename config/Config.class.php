<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Gestion des données de configuration du système
 */
class Config{
    /* L'instance unique de l'objet config */
    private static $_instance = null;
    /* Les différentes données de config sont stockées ici */
    private $config = array();
    /* Les données non transmises au template */
    private $secret = array('db_user' , 'db_password' , 'db_name' , 'db_server' , 'db_driver', 'db_salt');
    
    /* Constructeur privé car utilisation du design pattern singleton */
    private function __construct(){
        // Chargement des configurations du core depuis le fichier XML
        $this->load_core_config();
        
        // Chargement des données de l'url
        $server_protocol = explode('/', $_SERVER['SERVER_PROTOCOL']);
        $this->config['server_protocol'] = strtolower($server_protocol[0]);		
        $pos = strrpos($_SERVER['SCRIPT_NAME'] , '/');
        $site_url =  ($pos === false) ? $_SERVER['HTTP_HOST'].'/' : $_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'], 0 , $pos+1);
        $this->config['realpath'] = $this->config['server_protocol'].'://'.$site_url;
        $this->config['site_url'] = $site_url;
        
        // Chargement des données du navigateur
        $this->load_browser();
        
        // On regarde si chargement page en AJAX
        if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->config['ajax'] = true;
        } else {
            $this->config['ajax'] = false;
        }
    }
    
    /**
     * Récupération de l'instance de l'objet Config
     * \return Config Object 
     */
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new Config();
        }
        return self::$_instance;
    }
	
    /**
     * Charge les données de configuration principales à partir du fichier \c "config/config.xml"
     */
    private function load_core_config(){
        $xml = new XMLReader();
        if(!@$xml->open('config/config.xml')){
            throw new Exception('Le fichier config.xml est introuvable !');
        }
        $node = '';
        while($xml->read()){
            switch($xml->nodeType){
                case XMLReader::ELEMENT:
                    $node = $xml->name;
                    if($xml->isEmptyElement) $this->config[$node] = '';
                    break;
                case XMLReader::TEXT:
                    $this->config[$node] = $xml->value;
                    break;
                default:
                    break;
            }
        }
        
        if($this->get('debug')){
            Debug::add('Config','données de configurations globales chargées');
        }
    }

    /**
     * Charge les données de configuration du module
     * \param $module nom du module
     */
    public function load_module_config($module){
    	$xml = new XMLReader();
	if(!@$xml->open('modules/'.$module.'/config.xml')){
            throw new Exception('Le module demandé n\'existe pas !');
	}
        $module = strtolower($module);
        $this->config[$module] = Array();
	$node = '';
	while($xml->read()){
            switch($xml->nodeType){
		case XMLReader::ELEMENT:
                    $node = $xml->name;
                    if($xml->isEmptyElement) $this->config[$module][$node] = '';
                    break;
		case XMLReader::TEXT:
                    $this->config[$module][$node] = $xml->value;
                    break;
		default:
                    break;
            }
	}
        
        if($this->get('debug')){
            Debug::add('Config', 'données de configurations du module '.$module.' chargées');
        }
    }
    
    /**
     * Renvoie une donnée de config, ou une exception.
     * \throw Exception si la donnee n'existe pas.
     */
    public function get($field){
        if(!isset($this->config[$field])){
                throw new Exception('Config "'.$field.'" n\'existe pas !');
        } else {
                return $this->config[$field];
        }
    }

    /**
     * Renvoie toutes les données de config
     */
    public function get_config(){
        $result = array();
        foreach($this->config as $key => $value){
                if(!in_array($key , $this->secret)){
                        $result[$key] = $value;
                }
        }
        return $result;
    }

    /**
     * Modifie la valeur d'une donnée de configuration ou en insère une nouvelle
     * @param $field le nom de la donnée
     * @param $value la valeur pour cette donnée
     */
    public function set($field, $value){        
        if(is_array($value)){
            if(!isset($this->config[$field])){
                $this->config[$field] = array();
            }
            foreach($value as $key => $val){
                $this->config[$field][$key] = $val;
            }
        }else{
            // optimisation SEO
            if($field == 'site_description'){
                $value = trim(strip_tags($value));
                if(substr($value,-1,1) == '.') $value .= ' '.$this->get('site_description');
                else $value .= '. '.$this->get('site_description');
                $value = substr($value, 0, 157);
                if(strlen($value) == 157) $value .= '...';
            } elseif($field == 'site_title'){                
                $value = trim(strip_tags($value));
                if(substr($value,-1,1) == '-') $value .= ' '.$this->get('site_title');
                else $value .= ' - '.$this->get('site_title');
                $value = substr($value, 0, 67);
                if(strlen($value) == 67) $value .= '...';
            }
            
            $this->config[$field] = $value;
        }
        
        if($this->get('debug')){
            Debug::add('Config', 'nouvelle(s) donnée(s) : '.$field.' => '.(is_array($value)?implode(', ', $value):$value));
        }
    }
    
    /**
     * Ajoute des valeurs à une donnée de configuration
     * \param $field le nom de la donnée
     * \param $value la ou les valeurs pour cette donnée
     */
    public function add($field, $value){
        if(is_array($value)){
            if(!isset($this->config[$field])){
                $this->config[$field] = array();
            }
            foreach($value as $key => $val){
                $this->config[$field][$key] = $val;
            }
        }else{
            if(!isset($this->config[$field])){
                $this->config[$field] = $value;
            } else {
                if(!is_array($this->config[$field])){
                    $tmp = $this->config[$field];
                    $this->config[$field] = array();
                    array_push($this->config[$field], $tmp);
                    array_push($this->config[$field], $value);
                } else {
                    array_push($this->config[$field], $value);
                }
            }
        }
        
        if($this->get('debug')){
            Debug::add('Config', 'ajout de donnée(s) : '.$field.' => '.(is_array($value)?implode(', ', $value):$value));
        }
    }
   
    /**
     * Charge en session les informations du navigateur du client
     */
    private function load_browser(){
        if(!isset($_SESSION['browser'])){
            $_SESSION['browser'] = @get_browser(); // on efface le warning
        }
    }    
}

?>
