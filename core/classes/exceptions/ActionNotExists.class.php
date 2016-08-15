<?php
/**
 * Exception lancée lorsqu'une action demandée n'existe pas
 * \author renrhaf
 */
class ActionNotExists extends Exception{

    /**
     * Constructeur de la classe ActionNotExists
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>