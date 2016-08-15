<?php
/**
 * Exception lancée lorsqu'une action demandée n'est pas implementée dans un modèle
 * \author renrhaf
 */
class ActionNotAllowed extends Exception{

    /**
     * Constructeur de la classe ActionNotAllowed
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>