<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Background;
use App\Entity\Feat;
use App\Entity\Source;
use App\Repository\BackgroundRepository;
use App\Repository\FeatRepository;
use App\Repository\SourceRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RuleController extends AppController{
    const BASE_TITLE = "Zgrouf - DnD5 - Règles - ";

    /**
     * @Route("/dons", name="dons")
     */
    public function dons(FeatRepository $featRepo, SourceRepository $sourceRepo){
        $subtitle = "Dons";
        $title = "Zgrouf - DnD5 - Règles - " . $subtitle;
        $message = '';
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));
        
        // récupération de la liste des dons à jour et formatage de la description
        $rawfeats = $featRepo->findAllJoined();  
        $feats = [];
        $prerequisiteList = [];
        array_push($prerequisiteList,"-");
        foreach($rawfeats as $feat){
            $feat['description'] = $this->formatText($feat['description']);
            array_push($feats,$feat);
            if(strlen($feat["prerequisite"]) > 1 && !in_array($feat["prerequisite"],$prerequisiteList)){
                array_push($prerequisiteList,$feat["prerequisite"]);
            }
        }
        sort($prerequisiteList);
        return $this->render('rules/featList.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'feats' => $feats,
            'prerequisiteList' => $prerequisiteList
        ]);
    }


    /**
     * @Route("/feats", name="feats")
     * @Route("/feat/{id}", name="feat")
     */
    public function editFeat($id = null,
                        Request $request,
                        FeatRepository $featRepo,
                        SourceRepository $sourceRepo){
        $subtitle = "Dons";
        $title = "Zgrouf - DnD5 - Règles - " . $subtitle;
        $message = "";
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));

        if($id === null){
            $feat = new Feat();
        }else{  // recuperation du don correspondant
            $feat = $featRepo->findOneById(array('id' => $id));
        }      

        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formFeat = $this->createFormBuilder($feat)
                          ->add('name')
                          ->add('prerequisite')                          
                          ->add('description')
                          ->add('idSource', ChoiceType::class, [
                            'choices' => $sources,
                            'choice_label' => 'getLabel'
                            ])
                          ->add('page')
                          ->getForm();
        $formFeat->handleRequest($request);        

        // update ou new
        if($formFeat->isSubmitted() && $formFeat->isValid()){            
            if($feat->getId() === null){  // new                          
                $entityManager->persist($feat);
            }
            $entityManager->flush();
            return $this->redirectToRoute('feats');
        }
        // suppression d'un don
        if(isset($_POST['feat_del'])){       
            $feat = $featRepo->findOneById(array('id' => $_POST['feat_del']));
            if($feat){
                $entityManager->remove($feat);
                $entityManager->flush();
            }
        }
        // récupération de la liste des créatures à jour
        $feats = $featRepo->findAllJoined();    

        return $this->render('rules/feat.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'feats' => $feats,
            'formFeat' => $formFeat->createView(),
            'editMode' => $feat->getId() !== null
        ]);
    }

 /**
     * @Route("/historiques", name="historiques")
     */
    public function backgrounds(BackgroundRepository $backgroundRepo, SourceRepository $sourceRepo){
        $subtitle = "Historiques";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));
        
        // récupération de la liste des historiques à jour 
        $backgrounds = $backgroundRepo->findBy(array(),array('name' => 'ASC'));  
        
        return $this->render('rules/backgroundList.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'backgrounds' => $backgrounds
        ]);
    }

    /**
     * @Route("/backgrounds", name="backgrounds")
     * @Route("/background/{id}", name="background")
     */
    public function editBackground($id = null,
                        Request $request,
                        BackgroundRepository $backgroundRepo,
                        SourceRepository $sourceRepo){
        $subtitle = "Historiques";
        $title = self::BASE_TITLE . $subtitle;
        $message = "";
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));

        if($id === null){
            $background = new Background();
        }else{  // recuperation de l'historique correspondant
            $background = $backgroundRepo->findOneById(array('id' => $id));
        }      

        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formBackground = $this->createFormBuilder($background)
                          ->add('name')
                          ->add('skills')                          
                          ->add('tools')
                          ->add('languages')
                          ->add('gear')
                          ->add('featureName')
                          ->add('feature')
                          ->add('idSource', ChoiceType::class, [
                            'choices' => $sources,
                            'choice_label' => 'getLabel'
                            ])
                          ->add('page')
                          ->getForm();
        $formBackground->handleRequest($request);        

        // update ou new
        if($formBackground->isSubmitted() && $formBackground->isValid()){            
            if($background->getId() === null){  // new                          
                $entityManager->persist($background);
            }
            $entityManager->flush();
            return $this->redirectToRoute('backgrounds');
        }
        // suppression d'un historique
        if(isset($_POST['background_del'])){       
            $background = $backgroundRepo->findOneById(array('id' => $_POST['background_del']));
            if($background){
                $entityManager->remove($background);
                $entityManager->flush();
            }
        }
        // récupération de la liste des historiques à jour
        $backgrounds = $backgroundRepo->findBy(array(),array('name' => 'ASC'));    

        return $this->render('rules/background.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'backgrounds' => $backgrounds,
            'formBackground' => $formBackground->createView(),
            'editMode' => $background->getId() !== null
        ]);
    }

    /**
     * @Route("/combat", name="combat")
     */
    public function combat(){
        $subtitle = "- Combat";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('rules/combat.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/gear", name="equipement")
     */
    public function gear(){
        $subtitle = "- Equipement";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('rules/gear.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/magic_items", name="magic_items")
     */
    public function magicItems(){
        $subtitle = "- Objets Magiques";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('rules/magicItems.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/poison", name="poison")
     */
    public function poison(){
        $subtitle = "- Poison";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('rules/poison.html.twig',[
            'title' => $title
        ]);
    }
}