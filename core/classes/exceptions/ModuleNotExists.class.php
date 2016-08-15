<?php
/**
 * Exception lancée lorsqu'un module demandé n'existe pas
 * \author renrhaf
 */
class ModuleNotExists extends Exception{

    /**
     * Constructeur de la classe ModuleNotExists
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>