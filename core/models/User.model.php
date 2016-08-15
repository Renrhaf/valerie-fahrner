<?php
namespace Core;

if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');

/**
 * Objet définissant un utilisateur
 */
class User extends \ObjectModel{
    
    /**
     * Constructeur de la classe User
     */
    public function __construct(Array $data = NULL){
        $table = new \Table('user', 'utilisateur');
        \Field::create('Identifiant', 'user_id', \Field::INT, true, 1)->add_primary($table);
        \Field::create('Email', 'user_mail', \Field::MAIL, true, 6, 128)->add_unique($table,'uk_mail');
        \Field::create('Prénom', 'user_fname', \Field::STRING, true, 1, 64)->add($table);
        \Field::create('Nom', 'user_lname', \Field::STRING, true, 1, 64)->add($table);
        \Field::create('Mot de passe', 'user_password', \Field::STRING, true, 40, 40)->on_select('HEX(?)')->on_insert('UNHEX(?)')->add($table);
        \Field::create('Date de création', 'user_created', \Field::TIMESTAMP, false)->add($table);
        \Field::create('Site web', 'user_website', \Field::URL, false, 8, 128)->add($table);
        \Field::create('Profession', 'profession_id', \Field::INT, false, 1)->add($table);
        \Field::create('Validation', 'hash_validation', \Field::STRING, false, 40, 40)->add($table);
        \Field::create('Visibilité', 'user_active', \Field::INT, false, 0, 1)->add($table);
        $this->set_table($table);
        
        $this->redirect = Array(\Model::FRONTEND => 'model=User&action=showlist', \Model::BACKEND => 'model=Users&action=showlist&admin');
        
        parent::__construct($data);
    }

    public function validate($hash){
	$sql = 'UPDATE user SET hash_validation = \'\' WHERE hash_validation = ?';
        $params = Array($hash);
        \DB::getInstance()->preparedQuery($sql, array($hash));
    }

    public function login($mail, $password){
        $this->set('user_mail', $mail);
        try{
            $this->load();
        } catch(\Exception\ObjectNotExists $e){
            notification('error','Erreur dans les informations de connexion');
            redirect();
        }

        if($this->get('user_password') == strtoupper(sha1(sha1($password).\Config::getInstance()->get('db_salt')))){
            if(!$this->get('user_active')){
                notification('error','Votre compte à été désactivé par un administrateur');
                redirect();
            }
            
            $_SESSION['user'] = $this->get_values();
            $this->redirect[\Model::BACKEND] = 'model=Home&admin';
            $this->redirect[\Model::FRONTEND] = 'model=Home';
            return true;
        } else {
            notification('error','Erreur dans les informations de connexion');
            redirect();
        }
    }
    
    public function logout(){
        // ajout du champ user_last_connection...
        // calcul de la durée passée sur le site
        // etc
    }
    
    /**
     * Affichage de l'utilisateur
     */
    public function show(){ 
       $data = $this->get_values();
       
       // On vérifie que l'url est bien la bonne : user/id/prenom-nom
       $data['urlrw'] = \Tools::formatURLRewrite($this->get('user_fname').' '.$this->get('user_lname'));
       if(isset($_GET['urlrwtxt']) && $_GET['urlrwtxt'] != $data['urlrw']){
            header('HTTP/1.1 301 Moved Permanently');
            $location = $this->conf->get('realpath').'user/'.$this->get('user_id').'/'.\Tools::formatURLRewrite($this->get('user_fname').' '.$this->get('user_lname'));
            header('Location: '.$location);
            header('Connection: close');
       }
       
       $data['profession'] = $this->db->preparedQuery('SELECT * FROM profession WHERE profession_id = ?', Array($this->get('profession_id')), \DB::SINGLE_ROW);
       
       $this->set_template('user.tpl');
       $this->conf->set('site_description', $this->conf->get('site_title').' : visualisation du profil de '.$this->get('user_fname').' '.$this->get('user_lname'));
       $this->conf->set('site_title', 'Profil de '.$this->get('user_fname').' '.$this->get('user_lname').' - '.$this->conf->get('site_title'));
       return $data;
    }
    
    /**
     * Affichage d'une liste d'utilisateurs
     * Uniquement en BACKEND
     */
    public function showlist(){
        if($this->mode == \Model::FRONTEND){
            throw new \Exception\AccessDenied('action uniquement Backend');
        }
        
        $query = 'SELECT * FROM user LEFT JOIN profession ON profession.profession_id = user.profession_id';
        $tmp = $this->db->query('SELECT COUNT(*) FROM user', \DB::SINGLE_ROW);
        $this->conf->set('site_description', 'Gestion des utilisateurs');
        $this->conf->set('site_title', 'Gestion des utilisateurs');
        
        $data['multipage'] = $this->get_multipage_data($tmp['COUNT(*)']);
        $query = $this->add_order_limit($query, $data['multipage'], Array('profession_name'));
        $data['users'] = $this->db->query($query);
        
        $this->set_template('user_list_admin.tpl', \Model::BACKEND);
        return $data;
    }

    public function createform(){
        $res = Array();
        $this->db->setFetchMode(\DB::TWO_COLUMNS);
        $res['professions'] = $this->db->query('SELECT * FROM profession');
        $this->db->setFetchMode(\DB::ARRAY_ASSOC);
        $this->set_template('user_form.tpl'); 
        return $res;
    }
    
    public function editform(){
        $res = Array();
        $res = $this->get_values();
        $this->db->setFetchMode(\DB::TWO_COLUMNS);
        $res['professions'] = $this->db->query('SELECT * FROM profession');
        $this->db->setFetchMode(\DB::ARRAY_ASSOC);
        $this->set_template('user_form.tpl'); 
        return $res;
    }
    
    /**
     * Réinitialisation du mot de passe
     */
    public function send(){
        $this->set('user_mail', $_POST['mail']);
        
        $new_password = '';
        $chaine = 'abcdefghijklmnpqrstuvwxy1234567890';
        srand((double)microtime(true)*1000000);
        for($i=0; $i<10; $i++) {
            $new_password .= $chaine[rand()%strlen($chaine)];
        }
        $this->set('user_password', sha1(sha1($new_password).$this->conf->get('db_salt')));
        if($this->update()){
            $this->load();
            require('libs/PHPMailer/class.phpmailer.php');
            $mail = new \PHPmailer();
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = $this->conf->get('mail_host');
            $mail->From = $this->conf->get('mail_default_from');
            $mail->FromName = $this->conf->get('mail_default_from_name');
            $mail->AddAddress($this->get('user_mail'), $this->get('user_fname').' '.$this->get('user_lname'));
            $mail->AddReplyTo($this->conf->get('mail_user'), 'Administrateur du site');	
            $mail->Subject = 'Récupèration de votre mot de passe : '.$this->conf->get('site_title');
            $mail->Body = 'Bonjour, vous avez demandé le renvoi d\'un nouveau mot de passe. Le voici : '.$new_password.', vous pouvez le changer dans votre espace personnel.';
            $send = $mail->Send();
            $mail->SmtpClose();

            if(!$send){
                notification('error',$mail->ErrorInfo);
                notification('error','Une erreur est survenue lors de l\'envoi de votre mot de passe, veuillez recommencer.');    
            } else {
                notification('validation','Votre mot de passe à été changé avec succès, il vous a été transmis à votre adresse mail.');    
            }
        } else {
            if(isset($_POST['mail']) && $_POST['mail'] != '')
                notification('error','Veuillez vérifier votre adresse mail puis réessayez. Si le problème persiste veuillez nous contacter : <a href="index.php?model=Contact">Ici</a>');    
        }
        redirect();
    }
    
    /**
     * Insertion d'un utilisateur en BDD
     */
    public function create(){
        $this->get_field('user_password')->set_required(false);
        $this->get_field('user_password')->unset_value();
        
        $user_password = $_POST['user_password'];
        $user_password_confirm = $_POST['user_password_confirm'];
        if(!\CheckData::checkString($user_password)){
            notification('error','Le mot de passe contient des caractères invalides');
        } else {
            if($user_password != $user_password_confirm){
                notification('error','Les deux mots de passes ne sont pas identiques');
            } else {
                if(isset($_POST['user_id'])){
                    if($user_password != '')
                        $this->set('user_password', sha1(sha1($user_password).$this->conf->get('db_salt')));
                    parent::update();
                } else {
                    $this->set('user_password', sha1(sha1($user_password).$this->conf->get('db_salt')));
                    $this->set('hash_validation', sha1(uniqid(mt_rand(),true)));
                    $this->set('user_active', 1);
                    if(parent::create()){
                        notification('validation','Le compte à été créé avec succès.');
                    } else {
                        notification('error','Erreur lors de la création du compte !');
                    }
                }
            }
        }
        redirect('model=User&action=showlist&admin');
    }
    
    public function update(){
        $this->get_field('user_password')->set_required(false);
        $this->get_field('user_password')->unset_value();
        
        $user_password = $_POST['user_password'];
        $user_password_confirm = $_POST['user_password_confirm'];
        if(!\CheckData::checkString($user_password)){
            notification('error','Le mot de passe contient des caractères invalides');
        } else {
            if($user_password != $user_password_confirm){
                notification('error','Les deux mots de passes ne sont pas identiques');
            } else {
                if($user_password != '')
                    $this->set('user_password', sha1(sha1($user_password).$this->conf->get('db_salt')));
                parent::update();
            }
        }
        redirect('model=User&action=showlist&admin');
    }
    
    /**
     * Suppression d'un utilisateur
     */
    public function delete(){
        $id = $this->get('user_id');
        $bool = parent::delete();
        if($bool){
            if($_SESSION['user']['user_id'] == $id){
                unset($_SESSION['user']);
                if($this->conf->get('ajax')){
                    echo(json_encode(Array('validation' => 'Vous venez de supprimer votre compte, par conséquent vous avez été déconnecté',
                        'redirect' => Array('location' => 'index.php', 'wait' => 2000))));
                    exit;
                } else {
                    notification('info', 'Vous venez de supprimer votre compte, par conséquent vous avez été déconnecté');
                    redirect();
                }
            }
        }
        return $bool;
    }
}
?>