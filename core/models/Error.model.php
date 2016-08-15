<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Modèle d'affichage d'une erreur
 * Affiche les informations de l'exception
 */
class Error extends \Model{
    
    /* L'exception à afficher */
    protected $exception = NULL;

    public function __construct(\Exception $exception = NULL){
        parent::__construct();
        if($exception != NULL) {
            $this->exception = $exception;
        } else {
            $this->exception = new \Exception('Erreur '.$_GET['code'], $_GET['code']);
        }
    }
    
    /**
     * Affichage de l'exception
     */
    public function show(){
        if($this->conf->get('debug')){
            return $this->show_developer();
        } else {
            return $this->show_visitor();
        }
    }
    
    /**
     * Affichage de l'exception complète pour le développeur
     */
    private function show_developer(){
        \Debug::add('<b>Error</b>', $this->exception->getMessage());
            
        if($this->conf->get('ajax')){
            echo(json_encode(Array('error' => $this->exception->getMessage())));
            exit;
        } else {
            $data = Array();
            $data['file'] = $this->exception->getFile();
            $data['line'] = $this->exception->getLine();
            $data['code'] = $this->exception->getCode();
            $data['message'] = $this->exception->getMessage();
            $data['traces'] = $this->exception->getTrace();
            $data['simple'] = $this->show_simple();

            $this->set_template('errors/error.tpl');
            $this->conf->set('site_description',  $this->exception->getMessage());
            $this->conf->set('site_title', 'Affichage de l\'exception');
            return $data;
        }
    }
    
    /**
     * Affichage d'une erreur générique pour le visiteur
     * Et envoi d'un mail d'alerte à l'administrateur
     */
    private function show_visitor(){
        require('libs/PHPMailer/class.phpmailer.php');
        $mail = new \PHPmailer();
        $mail->IsSendmail();
        $mail->SetLanguage('fr');
        $mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->SetFrom($this->conf->get('error_mail_from'), 'Eurêka Framework');
        $mail->AddAddress($this->conf->get('error_mail_dest'), 'Développeur');	
        $mail->Body = $this->show_simple();

        if($this->conf->get('ajax')){
            $mail->Subject = 'Erreur '.$this->exception->getCode().' sur '.$this->conf->get('site_title');
            $mail->Send();
            
            switch($this->exception->getCode()){
                case 401 :
                    echo(json_encode(Array('error' => 'Vous n\'êtes pas autorisé à effectuer une telle opération.')));
                    break;
                case 403 :
                    echo(json_encode(Array('error' => 'Pour des raisons de sécurité, l\'accès à cette ressource est strictement interdit.')));
                    break;
                case 404 :
                    echo(json_encode(Array('error' => 'La page que vous demandez n\'est pas ou plus disponible.')));
                    break;
                case 500 :
                    echo(json_encode(Array('error' => 'Une erreur interne au serveur vient de se produire. Nous faisons notre possible pour corriger ce problème.')));
                    break;
                default :
                    echo(json_encode(Array('error' => 'La page que vous demandez n\'est pas ou plus disponible.')));
                    break;
            }
            exit;
        } else {
            $data = Array();
            $data['message'] = $this->exception->getMessage();
            
            switch($this->exception->getCode()){
                case 401 :
                    header('HTTP/1.1 401 Unauthorized');
                    $this->conf->set('site_description',  'Une erreur 401 est survenue, vous n\êtes pas autorisé à visualiser la page');
                    $this->conf->set('site_title', 'Zone resteinte');
                    $mail->Subject = $this->conf->get('site_title');
                    $this->set_template('errors/error401.tpl');
                    break;
                case 403 :
                    header('HTTP/1.1 403 Forbidden');
                    $this->conf->set('site_description',  'Une erreur 403 est survenue, l\'accès à cette ressource est strictement interdit pour des raisons de sécurité');
                    $this->conf->set('site_title', 'Erreur 403');
                    $mail->Subject = $this->conf->get('site_title');
                    $this->set_template('errors/error403.tpl');
                    break;
                case 404 :
                    header('HTTP/1.1 404 Not Found');
                    $this->conf->set('site_description',  'Une erreur 404 est survenue, la page n\'est pas ou plus disponible');
                    $this->conf->set('site_title', 'Page introuvable');
                    $mail->Subject = $this->conf->get('site_title');
                    $this->set_template('errors/error404.tpl');
                    break;
                case 500 :
                    header('HTTP/1.1 500 Internal Server Error');
                    $this->conf->set('site_description',  'Une erreur 500 est survenue, le serveur a rencontré une erreur interne');
                    $this->conf->set('site_title', 'Erreur interne');
                    $mail->Subject = $this->conf->get('site_title');
                    notification('info', 'Nous avons été informés du problème.');
                    $this->set_template('errors/error500.tpl');
                    break;
                default :
                    header('HTTP/1.1 404 Not Found');
                    $this->conf->set('site_description',  'Une erreur 404 est survenue, la page n\'est pas ou plus disponible');
                    $this->conf->set('site_title', 'Page introuvable');
                    $mail->Subject = $this->conf->get('site_title');
                    $this->set_template('errors/error404.tpl');
                    break;
            }
            $mail->Send();
            return $data;
        }
    }
    
    
    /**
     * Affichage simplifié de l'exception
     * Notamment utilisé dans l'envoi par mail de l'exception
     * @return String 
     */
    public function show_simple(){
        ob_start();
        echo('<p>');
        echo($this->exception->getMessage().'<br/>');
        
        switch($this->exception->getCode()){
            case 401 :
                echo('Le visiteur n\'est pas autorisé à effectuer une telle opération.<br/><br/>');
                break;
            case 403 :
                echo('Le visiteur n\'est pas autorisé à visualiser le répertoire<br/><br/>');
                break;
            case 404 :
                echo('La page que le visiteur demande n\'est pas ou plus disponible<br/><br/>');
                break;
            case 500 :
                echo('</p><h1>Une erreur interne au serveur vient de se produire</h1><p><br/><br/>');
                break;
            default :
                echo('La page que le visiteur demande n\'est pas ou plus disponible<br/><br/>');
                break;
        }
        
        echo('URL de l\'erreur : <a href="'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'">'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'</a><br/>');
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '')
            echo('Page précédente : <a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a><br/><br/>');
        echo('IP de l\'utilisateur : '.$_SERVER['REMOTE_ADDR'].':'.$_SERVER['REMOTE_PORT'].'<br/>');
        echo('User-agent : '.$_SERVER['HTTP_USER_AGENT'].'<br/><br/>');
        
        echo($this->exception->getFile().' - ligne '.$this->exception->getLine().' - code '.$this->exception->getCode().'<br/><br/>');
        foreach($this->exception->getTrace() as $num => $trace){
            $num = $num+1;
            echo($num.' - '.(isset($trace['file'])?$trace['file']:'fichier inconnu').' - ligne '.(isset($trace['line'])?$trace['line']:'inconnue').'<br/>');
            
            echo((isset($trace['class'])?$trace['class']:''));echo((isset($trace['type'])?$trace['type']:''));echo((isset($trace['function'])?$trace['function']:'fonction inconnue'));
            
            if(isset($trace['args'][0])){
                echo('(');
                foreach($trace['args'] as $num2 => $arg){
                    if(is_object($arg)){
                        echo(get_class($arg));
                    } else {
                        echo($arg);
                    }
                }
                echo(');');
            } else {
                echo('();');
            }
            echo('<br/><br/>');

        }
        echo('</p>');
        $res = ob_get_contents();
        ob_clean();
        return $res;
    }
}
?>


