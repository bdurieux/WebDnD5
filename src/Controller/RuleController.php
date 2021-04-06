<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Feat;
use App\Entity\Source;
use App\Repository\FeatRepository;
use App\Repository\SourceRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RuleController extends AppController{
    
    /**
     * @Route("/dons", name="dons")
     */
    public function dons(FeatRepository $featRepo, SourceRepository $sourceRepo){
        $subtitle = "Dons";
        $title = "Zgrouf - DnD5 - Règles - " . $subtitle;
        $message = '';
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));
        
        // récupération de la liste des dons à jour et formatage de la description
        $rawfeats = $featRepo->findAllJoined();  
        $feats = [];
        foreach($rawfeats as $feat){
            $feat['description'] = $this->formatText($feat['description']);
            array_push($feats,$feat);
        }
        return $this->render('rules/featList.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'feats' => $feats
        ]);
    }


    /**
     * @Route("/feats", name="feats")
     * @Route("/feat/{id}", name="feat")
     */
    public function feat($id = null,
                        Request $request,
                        FeatRepository $featRepo,
                        SourceRepository $sourceRepo){
        $subtitle = "Dons";
        $title = "Zgrouf - DnD5 - Règles - " . $subtitle;
        $message = "";
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));

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
}