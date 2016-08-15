<?php
/**
 * Exception lancée lorsque la connection à la base de données échoue
 * \author renrhaf
 */
class DBConnectFailed extends Exception{

    /**
     * Constructeur de la classe DBConnectFailed
     */
    public function __construct($message,$code = 0){
        parent::__construct($message,$code);
    }
}
?>