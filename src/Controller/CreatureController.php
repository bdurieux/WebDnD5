<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Alignment;
use App\Entity\Creature;
use App\Entity\CreatureSize;
use App\Entity\CreatureType;
use App\Entity\Source;
use App\Repository\AlignmentRepository;
use App\Repository\SourceRepository;
use App\Repository\CreatureRepository;
use App\Repository\CreatureSizeRepository;
use App\Repository\CreatureTypeRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;

class CreatureController extends AppController{
    const BASE_TITLE = "Zgrouf - DnD5 - Créatures ";
    const CHALLENGE_XP = [
            "10" => "0",
            "25" => "1/8",
            "50" => "1/4",
            "100" => "1/2",
            "200" => "1",
            "450" => "2",
            "700" => "3",
            "1100" => "4",
            "1800" => "5",
            "2300" => "6",
            "2900" => "7",
            "3900" => "8",
            "5000" => "9",
            "5900" => "10",
            "7200" => "11",
            "8400" => "12",
            "10000" => "13",
            "11500" => "14",
            "13000" => "15",
            "15000" => "16",
            "18000" => "17",
            "20000" => "18",
            "22000" => "19",
            "25000" => "20",
            "33000" => "21",
            "41000" => "22",
            "50000" => "23",
            "62000" => "24",
            "75000" => "25",
            "90000" => "26",
            "105000" => "27",
            "120000" => "28",
            "135000" => "29",
            "155000" => "30",
        ];
    
    /**
     * @Route("/creature/compendium", name="creature.compendium")
     */
    public function compendium(CreatureRepository $creatureRepo, 
                                AlignmentRepository $alignmentRepo,
                                CreatureSizeRepository $sizeRepo,
                                CreatureTypeRepository $typeRepo,
                                SourceRepository $sourceRepo){
        $subtitle = "Compendium";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';

        $alignments = $alignmentRepo->findBy(array(),array('id' => 'ASC'));        
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC'));
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        
        // gestion des options & récupération de la liste des créatures à jour
        if(isset($_POST['creatype']) && isset($_POST['creasource'])){
            $creatures = $creatureRepo->findAllwOption($_POST['creatype'], $_POST['creasource']);
        }
        else{
            $creatures = $creatureRepo->findAllJoined();    
        }        
        
        // get list of all first letter for side menu
        $firstLetterList = [];
        $firstLetter = '';
        foreach($creatures as $creature){
            if($creature['name'][0] != $firstLetter){
                array_push($firstLetterList,$creature['name'][0]);
                $firstLetter = $creature['name'][0];
            }
        }

        return $this->render('creatures/compendium.html.twig',[
            'message' => $message,
            'title' => $title,
            'alignments' => $alignments,
            'sizes' => $sizes,
            'sources' => $sources,
            'types' => $types,
            'creatures' => $creatures,
            'challengeXP' => self::CHALLENGE_XP,
            'firstLetterList' => $firstLetterList
        ]);
    }

    /**
     * @Route("/creature/compendium/type/{id}", name="creature.compendium.type")
     */
    public function listByType($id, CreatureTypeRepository $typeRepo, CreatureRepository $creatureRepo){
        $message = '';
        $subtitle = "Compendium - ";
        $type = $typeRepo->findOneById(array('id' => $id));        
        if($type !== null){
            $subtitle .= $type->getName();
        }else{
            // redirection vers notFound
            return $this->redirectToRoute('notFound');
        }
        $creatures = $creatureRepo->findAllByType($id);
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        $title = self::BASE_TITLE . $subtitle;        
        return $this->render('creatures/listByType.html.twig',[
            'message' => $message,
            'title' => $title,
            'type' => $type,
            'types' => $types,
            'creatures' => $creatures,            
            'challengeXP' => self::CHALLENGE_XP
        ]);
    }

    /**
     * @Route("/creatures", name="creatures")
     * @Route("/creature/{id}", name="creature")
     */
    public function creatures($id = null,
                              Request $request,
                              CreatureRepository $creatureRepo, 
                              AlignmentRepository $alignmentRepo,
                              CreatureSizeRepository $sizeRepo,
                              CreatureTypeRepository $typeRepo,
                              SourceRepository $sourceRepo){
        $subtitle = "";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        
        $alignments = $alignmentRepo->findBy(array(),array('id' => 'ASC'));        
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC'));
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC', 'name' => 'ASC'));
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
   
        if($id === null){
            $creature = new Creature();
        }else{  // recuperation de la créature correspondante
            $creature = $creatureRepo->findOneById(array('id' => $id));
        }      

        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formCreature = $this->createFormBuilder($creature)
                          ->add('name')
                          ->add('challenge', ChoiceType::class, [
                            'choices' => array_flip(self::CHALLENGE_XP),
                            'choice_label' => function ($choice, $key, $value) {
                                    return $key;
                                }
                            ])
                          ->add('page')
                          ->add('idType', ChoiceType::class, [
                              'choices' => $types,
                              'choice_label' => 'getName'
                              ])
                          ->add('idSize', ChoiceType::class, [
                            'choices' => $sizes,
                            'choice_label' => 'getName',
                            'data' => $entityManager->find("App\Entity\CreatureSize",3)
                            ])
                          ->add('idAlignment', ChoiceType::class, [
                            'choices' => $alignments,
                            'choice_label' => 'getLabel',                            
                            'data' => $entityManager->find("App\Entity\Alignment",10)
                            ])
                          ->add('idSource', ChoiceType::class, [
                            'choices' => $sources,
                            'choice_label' => 'getLabel'
                            ])
                          ->getForm();
        $formCreature->handleRequest($request);
        // update ou new
        if($formCreature->isSubmitted() && $formCreature->isValid()){         
            if($creature->getId() === null){  // new                          
                $entityManager->persist($creature);
            }
            $entityManager->flush();
            return $this->redirectToRoute('creatures');
        }
        // suppression d'une créature
        if(isset($_POST['creature_del'])){       
            $creature = $creatureRepo->findOneById(array('id' => $_POST['creature_del']));
            if($creature){
                $entityManager->remove($creature);
                $entityManager->flush();
            }
        }
        
        // récupération de la liste des créatures à jour
        $creatures = $creatureRepo->findAllJoined();    
        
        return $this->render('creatures/creatures.html.twig',[
            'message' => $message,
            'title' => $title,
            'alignments' => $alignments,
            'sizes' => $sizes,
            'sources' => $sources,
            'types' => $types,
            'creatures' => $creatures,
            'challengeXP' => self::CHALLENGE_XP,
            'formCreature' => $formCreature->createView(),
            'editMode' => $creature->getId() !== null
        ]);
    }
    
    /**
     * @Route("/types", name="creature.types")
     * @Route("/types/{id}", name="type")
     */
    public function editType($id = null,Request $request, CreatureTypeRepository $typeRepo){
        $subtitle = "- Type";
        $message = '';

        if($id === null){
            $type = new CreatureType();
        }else{  // recuperation du type correspondante
            $type = $typeRepo->findOneById(array('id' => $id));
            $subtitle = $type->getName();
        }      
        // création du formulaire
        $formType = $this->createFormBuilder($type)
                     ->add('name')
                     ->getForm();
        $formType->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        // update ou new
        if($formType->isSubmitted() && $formType->isValid()){            
            if($type->getId() === null){  // new                          
                $entityManager->persist($type);
            }
            $entityManager->flush();
            return $this->redirectToRoute('creature.types');
        }
        // suppression d'un type
        if(isset($_POST['type_del'])){       
            $type = $typeRepo->findOneById(array('id' => $_POST['type_del']));
            if($type){
                $entityManager->remove($type);
                $entityManager->flush();
            }
        }
        // récupération de la liste des types à jour
        $types = $typeRepo->findBy(array(),array('name' => 'ASC')); 
        $title = self::BASE_TITLE . $subtitle;
        return $this->render('creatures/creatureType.html.twig',[
            'message' => $message,
            'title' => $title,
            'types' => $types,
            'formType' => $formType->createView(),
            'editMode' => $type->getId() !== null
        ]);        
    }

    /**
     * @Route("/sizes", name="creature.sizes")
     * @Route("/sizes/{id}", name="size")
     */
    public function editSize($id = null,Request $request, CreatureSizeRepository $sizeRepo){
        $subtitle = "- Size";
        $message = '';

        if($id === null){
            $size = new CreatureSize();
        }else{  // recuperation de la taille correspondante
            $size = $sizeRepo->findOneById(array('id' => $id));
            $subtitle = $size->getName();
        }      
        // création du formulaire
        $formSize = $this->createFormBuilder($size)
                     ->add('name')
                     ->add('hitDice')
                     ->add('squareSpace')
                     ->getForm();
        $formSize->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        // update ou new
        if($formSize->isSubmitted() && $formSize->isValid()){            
            if($size->getId() === null){  // new                          
                $entityManager->persist($size);
            }
            $entityManager->flush();
            return $this->redirectToRoute('creature.sizes');
        }
        // suppression d'une taille
        if(isset($_POST['size_del'])){       
            $size = $sizeRepo->findOneById(array('id' => $_POST['size_del']));
            if($size){
                $entityManager->remove($size);
                $entityManager->flush();
            }
        }
        // récupération de la liste des tailles à jour
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC')); 
        $title = self::BASE_TITLE . $subtitle;
        return $this->render('creatures/creatureSize.html.twig',[
            'message' => $message,
            'title' => $title,
            'sizes' => $sizes,
            'formSize' => $formSize->createView(),
            'editMode' => $size->getId() !== null
        ]);        
    }

    /**
     * @Route("/alignments", name="alignments")
     * @Route("/alignment/{id}", name="alignment")
     */
    public function alignments($id = null,Request $request, AlignmentRepository $alignmentRepo){
        $subtitle = "- Alignements";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';

        if($id === null){
            $alignement = new Alignment();
        }else{  // recuperation de l'alignement correspondant
            $alignement = $alignmentRepo->findOneById(array('id' => $id));
        }      
        // création du formulaire
        $formAlgmt = $this->createFormBuilder($alignement)
                          ->add('name')
                          ->add('label')
                          ->getForm();
        $formAlgmt->handleRequest($request);
        $entityManager = $this->getDoctrine()->getManager();
        // update ou new
        if($formAlgmt->isSubmitted() && $formAlgmt->isValid()){            
            if($alignement->getId() === null){  // new                          
                $entityManager->persist($alignement);
            }
            $entityManager->flush();
            return $this->redirectToRoute('alignments');
        }
        // suppression d'un alignement
        if(isset($_POST['alignment_del'])){       
            $alignement = $alignmentRepo->findOneById(array('id' => $_POST['alignment_del']));
            if($alignement){
                $entityManager->remove($alignement);
                $entityManager->flush();
            }
        }
        // récupération de la liste des alignements à jour
        $alignments = $alignmentRepo->findBy(array(),array('id' => 'ASC')); 

        return $this->render('creatures/alignments.html.twig',[
            'message' => $message,
            'title' => $title,
            'alignments' => $alignments,
            'formAlgmt' => $formAlgmt->createView(),
            'editMode' => $alignement->getId() !== null
        ]);        
    }
}