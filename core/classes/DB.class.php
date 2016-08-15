<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe d'accès à la base de données
 * Utilise PDO
 * @author Quentin
 */
final class DB {
    
    // instance unique de la classe, singleton
    private static $_instance = NULL;
    
    // instance de PDO
    private $conn = NULL;
    
    // instance de Config
    private $conf = NULL;
    
    // utilisés par les requêtes préparées
    private $last_prepared_request = NULL;  // String
    private $last_prepared_statement = NULL;// PDO statement
    
    // défini comment les données sont retournées
    private $fetch_mode = DB::ARRAY_ASSOC;
    
    // le meilleur fetch mode pour récupèrer une liste de valeurs
    const ONE_COLUM = PDO::FETCH_COLUMN;
    
    // le meilleur fetch mode pour récupèrer un tableau de type [id] => valeur
    const TWO_COLUMNS = PDO::FETCH_KEY_PAIR;
    
    // fetch mode qui récupère les données dans un tableau associatif
    const ARRAY_ASSOC = PDO::FETCH_ASSOC;
    
    // fetch mode qui créé des instances d'une classe spécifiée à partir des données récupérées 
    const OBJECT = PDO::FETCH_CLASS;
    
    // fetch mode qui met à jour les données d'une instance de classe
    const INSTANCE = PDO::FETCH_INTO;
    
    // utilisé par le fetch mode OBJECT et INSTANCE
    private $fetch_parameter = NULL;
    
    // compteur de requêtes
    private $count_request = NULL;
    
    // constantes 
    const SINGLE_ROW = 1;
    const MUTI_ROWS = 2;
    
	
    /**
     * Constructeur privé car singleton
     */
    private function __construct(){
        $this->conf = Config::getInstance();
        try {
            $this->conn = new PDO('mysql:dbname='.$this->conf->get('db_name').';host='.$this->conf->get('db_server'), $this->conf->get('db_user'), $this->conf->get('db_password'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch(PDOException $e){
            throw new Exception\DBConnectFailed($e->getMessage());
        }
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->fetch_mode);
        $this->count_request = 0;
        
        if($this->conf->get('debug')){
            Debug::add('DB', 'connexion à la base de données réussie');
        }
    }
	
    /**
     * Méthode singleton 
     * Si l'instance de la classe existe déjà, on la renvoie
     * Sinon on créé l'instance de classe
     */
    public static function getInstance(){
        if(is_null(self::$_instance)) {
                self::$_instance = new DB();
        }
        return self::$_instance;
    }	         
    
    /**
     * Modifie la façon dont les données résultantes sont renvoyées
     * @param Constant $mode une des constantes de la classe DB
     * @param String $param le nom de la classe qu'on souhaite créer
     */
    public function setFetchMode($mode, $param = ''){
        if($mode == DB::OBJECT || $mode == DB::INSTANCE){
            if($param == ''){
                throw Exception('Aucun paramètre précisé...');
            }
            $this->fetch_parameter = $param;
        }       
        $this->fetch_mode = $mode;
    }
    
    /**
     * Retourne le nombre de requêtes lancées
     * @return Int le nombre de requêtes
     */
    public function getNumberRequest(){
        return $this->count_request;
    }
    
    /**
     * Démarre une transaction avec la base de données
     */
    public function beginTransaction(){
        $this->conn->beginTransaction();
    }
    
    /**
     * Enregistre les actions réalisées pendant la transaction
     */
    public function commit(){
        if(method_exists($this->conn, "inTransaction") && $this->conn->inTransaction()){
            $this->conn->commit();
        } else {
            try{
                $this->conn->commit();
            } catch(Exception $e){
                
            }
        }
    }
    
    /**
     * Annule les actions réalisées pendant la transaction
     */
    public function rollBack(){
        if(method_exists($this->conn, "inTransaction") && $this->conn->inTransaction()){
            $this->conn->rollBack();
        } else {
            try{
                $this->conn->rollBack();
            } catch(Exception $e){
                
            }
        }
    }
    
    /**
     * Retourne l'identifiant de la dernière ligne insérée
     * @return Int l'id 
     */
    public function lastInsertId(){
        return $this->conn->lastInsertId();
    }
    
    /**
     * Retourne le dernier message d'erreur
     * @return Array
     */
    public function errorInfo(){
        return $this->conn->errorInfo();
    }
    
    /**
     * Execute une requête SQL effectuant des modifications et renvois le nombre de lignes
     * @param String $queryString la requête SQL à executer
     * @return Int nombre de ligne modifiées/insérées
     */
    public function exec($queryString){
        $nb = $this->conn->exec($queryString); 
        $this->count_request++;
        
        if($this->conf->get('debug')){
            Debug::add('DB', 'exec('.$queryString.') => '.$nb.' ligne(s) affectée(s)');
        }
        
        return $nb;
    }
    
    /**
     * Execute une requête SQL de type Select - utilisation pour requêtes uniques
     * @param String $queryString la requête SQL
     * @return Array les données de la base 
     */
    public function query($queryString, $mode = DB::MUTI_ROWS){
        $statement = $this->conn->query($queryString);

        if($this->fetch_mode == DB::INSTANCE){
            $statement->setFetchMode(PDO::FETCH_INTO, $this->fetch_parameter);
            $results = $statement->fetch();
        } else {
            if($this->fetch_mode == DB::OBJECT){
                $results = $statement->fetchAll($this->fetch_mode,$this->fetch_parameter);
            } else {
                $results = $statement->fetchAll($this->fetch_mode);
            }
        }
        
        $statement->closeCursor(); 
        if($mode == DB::SINGLE_ROW && isset($results[0])){
            $results = $results[0];
        }
        $this->count_request++;
        
        if($this->conf->get('debug')){
            Debug::add('DB', 'query('.$queryString.') => '.(isset($results[0]) && is_array($results[0])?count($results):'1').' ligne(s) retournée(s)');
        }

        return $results;
    }
    
    /**
     * Execute une requête préparées - meilleures performances pour appels multiples
     * @param String $queryString la requête SQL
     * @param Array $params les variables de la requête
     */
    public function preparedQuery($queryString, Array $params, $mode = DB::MUTI_ROWS){
        $used_last_prepared = true;
        if($this->last_prepared_request != NULL){
            if($this->last_prepared_request != $queryString){
                $this->last_prepared_request = $queryString;
                $tmp = $this->conn->prepare($queryString);
                if(!$tmp){
                    throw Exception\SQLRequestFailed('La préparation de la requete a échoué ! ('.$queryString.')');
                }
                $this->last_prepared_statement = $tmp;
                $used_last_prepared = false;
            }
        } else {
            $this->last_prepared_request = $queryString;
            $tmp = $this->conn->prepare($queryString);
            if(!$tmp){
                throw Exception\SQLRequestFailed('La préparation de la requete a échoué ! ('.$queryString.')');
            }
            $this->last_prepared_statement = $tmp;
            $used_last_prepared = false;
        }
        
        $test = $this->last_prepared_statement->execute($params);
        if(!$test){
            throw Exception\SQLRequestFailed('Erreur lors de l\'execution de la requête');
        }
        
        if(strtoupper(substr($queryString, 0, 6)) != 'SELECT'){
            $results = $this->last_prepared_statement->rowCount();
        } else {
            if($this->fetch_mode == DB::INSTANCE){
                $this->last_prepared_statement->setFetchMode(PDO::FETCH_INTO, $this->fetch_parameter);
                $results = $this->last_prepared_statement->fetch();
            } else {
                if($this->fetch_mode == DB::OBJECT){
                    $results = $this->last_prepared_statement->fetchAll($this->fetch_mode,$this->fetch_parameter);
                } else {
                    $results = $this->last_prepared_statement->fetchAll($this->fetch_mode);
                }
            }
        }
        
        $this->last_prepared_statement->closeCursor();
        if($mode == DB::SINGLE_ROW && isset($results[0])){
            $results = $results[0];
        }
        
        $this->count_request++;
        if($this->conf->get('debug')){
            Debug::add('DB', 'preparedQuery('.$queryString.', Array('.implode(', ', $params).')) => '.(isset($results[0]) && is_array($results[0])?count($results):'1').' ligne(s) retournée(s)'.($used_last_prepared?' (utilisation de la dernière requête préparée)':' (préparation de la requête)'));
        }
        
        return $results;
    }
}
?>
