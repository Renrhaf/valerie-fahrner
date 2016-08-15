<?php
/**
 * Exception lancée lorsque la requête SQL échoue
 * \author renrhaf
 */
class SQLRequestFailed extends Exception{

    /**
     * Constructeur de la classe SQLRequestFailed
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>