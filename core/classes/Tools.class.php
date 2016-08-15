<?php
if(!defined('_G_INCLUDED')) die('WTF are you trying to do ?!');


final class Tools {
    
    /**
     * Supprime les accents d'une chaîne
     * @param String $str
     * @return String 
     */
    public static function stripAccents($str){
        $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }
    
    /**
     * Traite le téléchargement d'une image
     * @param Array $FILE[error,size,type,tmp_name,name,max_file_size]
     * @param string $dest_path : destination du fichier
     * @return bool
     */
    public static function uploadImage($FILE, $dest_path){
        // Traitements des erreurs possibles
        switch($FILE['error']){
            case UPLOAD_ERR_INI_SIZE:
                notification('error', $FILE['name'].' : Le fichier dépasse la limite autorisée par le serveur.');   
                return false;
                break;
            case UPLOAD_ERR_FORM_SIZE:
                notification('error', $FILE['name'].' : Le fichier dépasse la limite autorisée dans le formulaire HTML.');
                return false;
                break;
            case UPLOAD_ERR_PARTIAL:
                notification('error', $FILE['name'].' : L\'envoi du fichier a été interrompu pendant le transfert.');  
                return false;
                break;
            case UPLOAD_ERR_NO_FILE:
                notification('error', $FILE['name'].' : Le fichier que vous avez envoyé a une taille nulle.');
                return false;
                break;
            default :
                break;      
        }
        
        // Vérification de la taille du fichier
        if($FILE['size'] > $FILE['max_file_size']){
            notification('error', $FILE['name'].' : dépasse la taille maximale autorisée.');
            return false;
        }

        // Vérification du type de fichier
        if($FILE['type'] == 'image/jpg' || $FILE['type'] == 'image/pjpg' || $FILE['type'] == 'image/jpeg'){
            $img_src_resource = imagecreatefromjpeg($FILE['tmp_name']);
            $img_size = getimagesize($FILE['tmp_name']);
            if($img_size['mime'] != 'image/jpeg' && $img_size['mime'] != 'image/jpg' && $img_size['mime'] != 'image/pjpg'){
                notification('error', $FILE['name'].' : type de fichier incorrect.');
                return false;
            }
        } else if($FILE['type'] == 'image/gif'){
            $img_src_resource = imagecreatefromgif($FILE['tmp_name']);
            $img_size = getimagesize($FILE['tmp_name']);
            if($img_size['mime'] != 'image/gif'){
                notification('error', $FILE['name'].' : type de fichier incorrect.');
                return false;
            }
        } else if($FILE['type'] == 'image/png'){
            $img_src_resource = imagecreatefrompng($FILE['tmp_name']);
            $img_size = getimagesize($FILE['tmp_name']);
            if($img_size['mime'] != 'image/png'){
                notification('error', $FILE['name'].' : type de fichier incorrect.');
                return false;
            }
        } else if($FILE['type'] == 'image/bmp'){
            $img_src_resource = imagecreatefromwbmp($FILE['tmp_name']);
            $img_size = getimagesize($FILE['tmp_name']);
            if($img_size['mime'] != 'image/bmp'){
                notification('error', $FILE['name'].' : type de fichier incorrect.');
                return false;
            }
        } else {
            notification('error', $FILE['name'].' : type de fichier incorrect.');
            return false;
        }

        if(!move_uploaded_file($FILE['tmp_name'], $dest_path)){
            notification('error', $FILE['name'].' : erreur lors du déplacement du fichier.');
            return false;
        }
        
        return true;
    }
    
    /**
     * Redimensionne une image, avec conservation des proportions
     * @param string src_path : le chemin vers l'image source
     * @param string dest_path : le chemin pour la nouvelle image
     * @param string type : "image/[jpg|pjpg|jpeg|gif|png|bmp]"
     * @param int width : la nouvelle largeur
     * @param int height : la nouvelle hauteur
     * @param int quality : qualité de 0 à 100
     * @param string bcolor : couleur du fond, en hexadécimal sans le #
     * @return bool
     */
    public static function resizeImage($src_path, $dest_path, $type, $width, $height, $quality, $bcolor){
        if(!($size = getimagesize($src_path))){
            notification('error', 'impossible de récupèrer la taille de l\'image');
            return false;
        }
        
        $x_c = $width;
        $y_c = $height;
        
        if($size[0] >= $x_c AND $size[1] >= $y_c) {
            if(($size[0]/$x_c) > ($size[1]/$y_c)) {
                $x_t = $x_c;
                $y_t = floor(($size[1]*$x_c)/$size[0]);
                $x_p = 0;
                $y_p = ($y_c/2)-($y_t/2);
            } else {
                $x_t = floor(($size[0]*$y_c)/$size[1]);
                $y_t = $y_c;
                $x_p = ($x_c/2)-($x_t/2);
                $y_p = 0;
            }
        } else {
            $x_t = $size[0];
            $y_t = $size[1];
            $x_p = ($x_c/2)-($x_t/2);
            $y_p = ($y_c/2)-($y_t/2);
        }
        
        switch($type){
            case 'image/jpg': case 'image/pjpg': case 'image/jpeg':
                if(!($image_new = imagecreatefromjpeg($src_path))){
                    notification('error', 'Impossible de charger l\'image '.$type);
                    return false; 
                }
                break;
            case 'image/gif':
                if(!($image_new = imagecreatefromgif($src_path))){
                    notification('error', 'Impossible de charger l\'image '.$type);
                    return false;
                }
                break;
            case 'image/png':
                if(!($image_new = imagecreatefrompng($src_path))){
                    notification('error', 'Impossible de charger l\'image '.$type);
                    return false;
                }
                break;
            case 'image/bmp':
                if(!($image_new = imagecreatefromwbmp($src_path))){
                    notification('error', 'Impossible de charger l\'image '.$type);
                    return false;
                }
                break;       
            default:
                notification('error', 'Type d\'image non supporté : '.$type);
                return false;
                break;
        }
        
        if(!($image = imagecreatetruecolor($x_c, $y_c))){
            return false;
        }
        if(($color = imagecolorallocate($image, hexdec($bcolor[0].$bcolor[1]), hexdec($bcolor[2].$bcolor[3]), hexdec($bcolor[4].$bcolor[5]))) === false){
            return false;
        }
        if(!(imagefilledrectangle($image,0,0,$x_c,$y_c,$color))){
            return false;
        }
        if(!(imagecopyresampled($image,$image_new,$x_p,$y_p,0,0,$x_t,$y_t,$size[0],$size[1]))){
            return false;
        }
        imagedestroy($image_new);
        
        switch($type){
            case 'image/jpg': case 'image/pjpg': case 'image/jpeg':
                return imagejpeg($image, $dest_path, $quality);
                break;
            case 'image/gif':
                return imagegif($image, $dest_path);
                break;
            case 'image/png':
                return imagepng($image, $dest_path, ($quality/100));
                break;
            case 'image/bmp':
                return imagewbmp($image, $dest_path);
                break;       
            default:
                return false;
                break;
        }
    } 
    
    /**
     * Met en forme une chaîne pour l'url rewriting
     * @param String
     * @return String
     */
    public static function formatURLRewrite($string){
        $string = mb_strtolower($string);
        $string = \Tools::stripAccents($string);
        $string = preg_replace('#[^\w ]#','',$string);
        $string = trim($string, ' \t.');
        $string = str_replace(' ', '-', $string);
        return $string;
    }
}
?>