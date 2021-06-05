<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Zgrouf;
use App\Repository\ZgroufRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserController extends AppController{
    
    const ROLE_INDEX = [
        "0" => "Visiteur",
        "1" => "Zgrouf",
        "10" => "GM"
    ];

    /**
     * @Route("/user/inscription", name="user.inscription")
     * @Route("/user/edit/{id}", name="user.edit")
     */
    public function edit($id = null,
                        ZgroufRepository $userRepo,
                        Request $request,
                        ValidatorInterface $validator
                        ){
        $message = "";
        if($id === null){
            $user = new Zgrouf();
        }else{  // recuperation du user correspondant
            $user = $userRepo->findOneById(array('id' => $id));
        } 
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $message = (string) $errors;
        }
        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formUser = $this->createFormBuilder($user)
                          ->add('mail')
                          ->add('username')
                          ->add('password', RepeatedType::class, [
                                'type' => PasswordType::class,
                                'invalid_message' => 'Les 2 champs mot de passe doivent être identiques.',
                                'options' => ['attr' => ['class' => 'password-field']],
                                'required' => true,
                                'first_options'  => ['label' => 'Mot de passe'],
                                'second_options' => ['label' => 'Répéter mot de passe'],
                            ])
                          ->add('role', ChoiceType::class, [
                            'choices' => array_flip(self::ROLE_INDEX),
                            'choice_label' => function ($choice, $key, $value) {
                                    return $key;
                                }
                            ])
                          ->getForm();
        $formUser->handleRequest($request);
        // vérification de l'unicité du pseudo  A TESTER // TODO: securiser mot de passe & login & modifier params
        //var_dump($_POST['form']['username']);        
        if(isset($_POST['form']['username'])){
            $pseudoUser = $userRepo->findOneByUsername($_POST['form']['username']);
            if($pseudoUser !== null && ($pseudoUser->getId() != $user->getId())){
                $message .= "Pseudo déjà utilisé.";
            }else{                
                // on sauve les données
                if($formUser->isSubmitted() && $formUser->isValid()){            
                    // on sécurise le mot de passe
                    $user->setPassword(password_hash($this->secure($_POST['password']),PASSWORD_DEFAULT));
                    if($user->getId() === null){  // new                          
                        $entityManager->persist($user);
                    }
                    $entityManager->flush();
                    return $this->redirectToRoute('login');
                }
            }
        }
        $subtitle = "Inscription";
        $title = "Zgrouf - DnD5 - Zgroufs - " . $subtitle;
        return $this->render('users/edit.html.twig',[
            'title' => $title,
            'roleIndex' => self::ROLE_INDEX,
            'formUser' => $formUser->createView(),
            'editMode' => $user->getId() !== null,
            'message' => $message
        ]);
    }

    /**
     * @Route("/user/login", name="user.login")
     */
    public function login(){
        
    }

    /**
     * ferme la session en cours et redirige vers la page de connexion
     * @Route("/user/logout", name="user.logout")
     */
    public function logout(SessionInterface $session){
        $session->clear();
		return $this->redirectToRoute('login');
    }
}