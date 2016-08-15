<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Modèle de la page de contact du site
 * \author renrhaf
 */
class Contact extends \Model{

    public function __construct(){
        parent::__construct();
    }
    
    public function show(){
        $results = Array();
        if(isset($_SESSION['user']['user_mail'])){
            $results['mail'] = $_SESSION['user']['user_mail'];
        }
        $this->set_template('contact.tpl');
        $this->conf->set('site_description', 'Contactez-nous pour tous renseignements, demandes ou commentaires sur les céramiques et poteries de Valérie Fahrner, ou pour des remarques sur le site internet.');
        $this->conf->set('site_title', 'Contactez-nous');
        return $results;
    }
    
    public function send(){
        $results = Array();
        $sending = true;
        
        if(\CheckData::checkEmail($_POST['mail'])){
            $mail = $_POST['mail'];
        } else {
            $mail = '';
            notification('error','L\'adresse e-mail que vous avez indiqué est invalide.');
            $sending = false;
        }

        $message = $_POST['message'];
        if($message == ''){
            notification('error','Veuillez écrire un message avant de valider.');
            $sending = false;
        }
        
        if($sending){
            if($this->send_mail($mail, $message)){
                redirect();
            }
        }
        
        $results['message'] = $message;
        $results['mail'] = $mail;
        $this->set_template('contact.tpl');
        return $results;        
    }
    
    private function send_mail($email, $message){
        $result = false;
        
        require('libs/PHPMailer/class.phpmailer.php');
        $mail = new \PHPmailer();
        $mail->IsSendmail();
        $mail->SetLanguage('fr');
        $mail->CharSet = 'UTF-8';
       
        $mail->SetFrom($this->conf->get('mail_default_from'), $this->conf->get('mail_default_from_name'));
	$mail->AddAddress($this->conf->get('mail_user'), 'Administrateur');
	$mail->AddReplyTo($email, 'Visiteur');	
	$mail->Subject = 'Message d\'un visiteur du site : '.$this->conf->get('site_title');
	$mail->Body = 'Message de '.$email.' : '.$message;

        if(!$mail->Send()){ 
            notification('error',$mail->ErrorInfo);
            if(isset($_SESSION['mail_failed'])){
                notification('error','Le système de mail rencontre actuellement des problèmes.');
                notification('info','Si le problème persiste, vous pouvez nous joindre à l\'adresse suivante : <a href="mailto:'.$this->conf->get('mail_user').'">'.$this->conf->get('mail_user').'</a>');
                unset($_SESSION['mail_failed']);
            } else {
                $_SESSION['mail_failed'] = true;
                notification('error','Le mail n\'a pas été envoyé car un problème est survenu.<br/>Vérifiez que votre adresse mail est bien valide et réessayez.');
            }
        } else { 
            notification('validation','L\'email a été envoyé avec succès ! Nous vous répondrons dans les plus bref délais.');
            unset($_SESSION['mail_failed']);
            $result = true;
        }
        return $result;
    }
}
?>