<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ZgroufRepository;
use App\Entity\Zgrouf;

class AppController extends AbstractController{

	/**
	*	vérifie le mot de passe fourni avec celui en base de donnée
	*	@param $username
	*	@param $password
	*	@return boolean renvoie true si le mot de passe correspond
	*/
	public function checkLogin($username, $password, $session, ZgroufRepository $accountRepo){
        $user = new Zgrouf();
        $response = $accountRepo->findOneByUsername($username);
        if($response){
            $user = $response;
        }
		if ($user->getId() !== null) {
			if(password_verify($password,$user->getPassword())){
				$session->set('auth',$user->getId());
				return true;
			}			
		}
		return false;
    }

	/**
	 * vérifie si l'utilisateur est connecté
	 */
	public function logged(SessionInterface $session){
		return $session->get('auth') !== null;
    }

     /**
	 * nettoie une chaine de caractère
	 * @return
	 */
	protected function secureData($data){
		if(is_string($data)){			
			$data = htmlspecialchars(htmlspecialchars(stripslashes(trim($data))));
		}
        return $data;
    }

    /**
     * @Route("/notFound", name="notFound")
     */
    public function home(){
        $subtitle = "Page introuvable";
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        

        return $this->render('public/notFound.html.twig',[
            'title' => $title
        ]);
    }

    /**
	 * formate un texte en ajoutant des <li></li> si un ':' est suivi de ';'
	 * @param $text le texte à formatter
	 * @return
	 */
	protected function formatText($text){
		$html = "";
		$pattern = "#:+(.+;+).+#";
		if (preg_match($pattern, $text)){
			// on décompose le text en phrase
			$parts = explode(".",$text);
			foreach($parts as $part){		
				if(preg_match($pattern, $part)){
					$pieces = explode(':',$part);
					$debut = $pieces[0];
					$reste = substr($part, strlen($debut)+1);
					$ul = explode(';', $reste);
					$html .= $debut . '<ul>';
					foreach ($ul as $li) {
						$html .= '<li>' . $li . '</li>';
					}
					$html .= '</ul>';
				}else{
					$html .= $part . '.';
				}
			}
		}else{
			$html = $text;
		}
		return $html;
	}

    /**
     * vérifie la validité d'un nom
     * @return string message
     */
    protected function checkName($name){
        $message = "";
        if(!is_string($name)){
            $message = "Nom invalide.";
        }elseif(strlen($this->secureData($name)) < 2){
            $message = "Nom trop court.";
        }elseif(strlen($this->secureData($name)) > 255){
            $message = "Nom trop long.";
        }

        return $message;
    }

    /**
	 * vérifie la validité des paramètres de taille
	 * @param param
	 * @return string message 
	 */
	protected function checkSize($params){
		$message = "";
		
		if(isset($_POST['size_name'])){
			$message .= $this->checkName($_POST['size_name']);
		}
		if(isset($_POST['size_hit_dice'])){
            $int_value = (int) $_POST['size_hit_dice'];
            $dice = array(2,3,4,5,6,8,10,12,16,20,24,30,100);
            if(!in_array($int_value,$dice)){
                $message .= "Les dés de vie doivent type de dé existant <br>";
            }			
		}
		if(isset($_POST['size_space'])){
            $float_value = (float) $_POST['size_space'];
            if($float_value <= 0 or $float_value > 100){
                $message .= "La largeur doit êre un nombre entre 1 et 100 <br>";
            }			
		}
		return $message;
    }
    
    /**
	 * vérifie la validité des paramètres de source
	 * @param param
	 * @return string message 
	 */
	protected function checkSource($params){
		$message = "";
		
		if(isset($_POST['src_name'])){
			$message .= $this->checkName($_POST['src_name']);
		}
		if(!is_string($_POST['src_label'])){
            $message = "Label invalide.";
        }elseif(strlen($this->secureData($_POST['src_label'])) < 2){
            $message = "Label trop court.";
        }elseif(strlen($this->secureData($_POST['src_label'])) > 8){
            $message = "Label trop long.";
        }
		return $message;
    }
}