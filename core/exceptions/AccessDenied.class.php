<?php
namespace Exception;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Exception lancée lorsqu'un utilisateur n'a pas les droits requis
 */
class AccessDenied extends EurekaException{
    
    /**
     * Constructeur de la classe AccessDenied
     */
    public function __construct($conditions){
        $message = 'L\'utilisateur n\'a pas les droits requis pour visualiser cette page. Vérifiez que les conditions d\'accès à cette page sont valides, et le cas échéant, que vous remplissez bien toutes ces conditions : <br/><b> - '.$conditions.'</b>';
        $message .= '<br/><br/>Les vérifications de droits se font dans les actions, et parfois dans les modèles.';
        $this->developer_message = $message;
        parent::__construct(401);
    }
}
?>