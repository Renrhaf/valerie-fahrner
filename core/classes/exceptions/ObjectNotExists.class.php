<?php
/**
 * Exception lancée lorsqu'un objet n'existe pas en base de données
 * Egalement lancée si une page demandée n'existe pas
 * \author renrhaf
 */
class ObjectNotExists extends Exception{

    /**
     * Constructeur de la classe ObjectNotExists
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>