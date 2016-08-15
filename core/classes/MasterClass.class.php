<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Superclasse de toutes les classes
 * 
 * Initialise les configurations et la base de données
 */
abstract class MasterClass{
    
    // Instance de Config
    protected $conf = NULL;
    // Instance de DB
    protected $db = NULL;
    
    /**
     * Constructeur de la classe MasterClass
     */
    public function __construct(){
        // initalisation des configurations
        $this->conf = Config::getInstance();
        // initialisation de la base de données
        $this->db = DB::getInstance();
    }
}

?>
