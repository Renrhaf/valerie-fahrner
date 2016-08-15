<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Classe regroupant les fonctions permettant de vérifier la cohérence des données
 * @author Quentin
 */
final class CheckData {
    
    /**
     * Vérifier la validité d'un email
     * @param String $email
     * @return Boolean 
     */
    public static function checkEmail($email){
        $res = false;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $res = true;
        }
        return $res;
    }
    
    /**
     * Vérifier la validité d'un mot de passe
     * @param String $pass
     * @return boolean 
     */
    public static function checkPassword($pass){
        $res = true;
        // TODO
        return $res;        
    }
    
    public static function checkString($string){
        $res = true;
        // TODO caractères interdits ? attention a ne pas interdire trop de chars
        // "_" devrait être interdit
        return $res;        
    }

    /**
     * Vérifier qu'une date est valide
     * Format : dd/mm/yyyy
     * @param String $date
     * @return Boolean
     */
    public static function checkDate($date){
        $res = false; $matches = array();
        if(preg_match('#(\d\d)/(\d\d)/(\d\d\d\d)#',$date,$matches)){
            if(checkdate($matches[2],$matches[1],$matches[3])){
                $res = true;
            }
        }
        return $res;
    }
    
    /**
     * Vérifier qu'un timestamp est valide
     * Format : dd/mm/yyyy hh:mm:ss
     * @param String $timestamp
     * @return Boolean
     */
    public static function checkTimestamp($timestamp){
        $res = false; $matches = array();
        if(preg_match('#(\d\d)/(\d\d)/(\d\d\d\d) (\d\d):(\d\d):(\d\d)#',$timestamp,$matches)){
            if(checkdate($matches[2],$matches[1],$matches[3])){
                if($matches[4] >= 0 && $matches[4] <= 23 && $matches[5] >= 0 && $matches[5] <= 59 && $matches[6] >= 0 && $matches[6] <= 59){
                    $res = true;
                }
            }
        } 
        return $res;
    }
    
    /**
     * Converti la date du format Base de données au format utilisé par le Framework
     * @param String $value la date à convertir 
     * @return String la date formatée si ok sinon la date non changée
     */
    public static function convertDBDDToFramework($value){
        if(preg_match('#(\d\d\d\d)-(\d\d)-(\d\d)#',$value,$matches)){
            if(checkdate($matches[2],$matches[3],$matches[1])){
                $value = $matches[3]."/".$matches[2]."/".$matches[1];
            }
        }
        return $value;
    }
    
    /**
     * Converti le timestamp du format Base de données au format utilisé par le Framework
     * @param String $value la date à convertir 
     * @return String la date formatée si ok sinon la date non changée
     */
    public static function convertTBDDToFramework($value){
        if(preg_match('#(\d\d\d\d)-(\d\d)-(\d\d) (\d\d):(\d\d):(\d\d)#',$value,$matches)){
            if(checkdate($matches[2],$matches[3],$matches[1])){
                if($matches[4] >= 0 && $matches[4] <= 23 && $matches[5] >= 0 && $matches[5] <= 59 && $matches[6] >= 0 && $matches[6] <= 59){
                    $value = $matches[3]."/".$matches[2]."/".$matches[1]." ".$matches[4].":".$matches[5].":".$matches[6];
                }
            }
        }
        return $value;
    }
    
    /**
     * Vérifier qu'une URL est valide
     * @param String $url
     * @return Boolean
     */
    public static function checkUrl($url){
        $res = false;
        if(filter_var($url, FILTER_VALIDATE_URL)){
            $res = true;
        }
        return $res;
    }
    
    /**
     * Teste si la variable est un entier positif
     * @param Int $id
     * @return Boolean
     */
    public static function checkId($id){
        return (!empty($id) && $id != NULL && is_numeric($id));
    }
}
?>