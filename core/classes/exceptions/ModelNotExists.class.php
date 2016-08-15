<?php
/**
 * Exception lancée lorsqu'un modèle demandé n'existe pas
 * \author renrhaf
 */
class ModelNotExists extends Exception{

    /**
     * Constructeur de la classe ModelNotExists
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>