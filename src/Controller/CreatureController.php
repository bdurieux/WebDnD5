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
    
    /**
     * @Route("/", name="home")
     */
    public function home(){
        $subtitle = "Index";
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        

        return $this->render('creatures/home.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/creature/compendium", name="creature.compendium")
     */
    public function compendium(CreatureRepository $creatureRepo, 
                                AlignmentRepository $alignmentRepo,
                                CreatureSizeRepository $sizeRepo,
                                CreatureTypeRepository $typeRepo,
                                SourceRepository $sourceRepo){
        $subtitle = "Compendium";
        $title = "Zgrouf - DnD5 - Créatures" . $subtitle;
        $message = '';

        $alignments = $alignmentRepo->findBy(array(),array('id' => 'ASC'));        
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC'));
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        $challengeXP = [
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
        // gestion des options & récupération de la liste des créatures à jour
        if(isset($_POST['creatype']) && isset($_POST['creasource'])){
            $creatures = $creatureRepo->findAllwOption($_POST['creatype'], $_POST['creasource']);
        }
        else{
            $creatures = $creatureRepo->findAllJoined();    
        }        
        
        return $this->render('creatures/compendium.html.twig',[
            'message' => $message,
            'title' => $title,
            'alignments' => $alignments,
            'sizes' => $sizes,
            'sources' => $sources,
            'types' => $types,
            'creatures' => $creatures,
            'challengeXP' => $challengeXP
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
        $challengeXP = [
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
        $creatures = $creatureRepo->findAllByType($id);
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        $title = "Zgrouf - DnD5 - Créatures" . $subtitle;        
        return $this->render('creatures/listByType.html.twig',[
            'message' => $message,
            'title' => $title,
            'type' => $type,
            'types' => $types,
            'creatures' => $creatures,            
            'challengeXP' => $challengeXP
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
        $title = "Zgrouf - DnD5 - Créatures" . $subtitle;
        $message = '';
        
        $alignments = $alignmentRepo->findBy(array(),array('id' => 'ASC'));        
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC'));
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        $challengeXP = [
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
                            'choices' => array_flip($challengeXP),
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
                            'data' => $entityManager->getReference("App\Entity\CreatureSize",3)
                            ])
                          ->add('idAlignment', ChoiceType::class, [
                            'choices' => $alignments,
                            'choice_label' => 'getLabel',                            
                            'data' => $entityManager->getReference("App\Entity\Alignment",10)
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
        // suppression d'un alignement
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
            'challengeXP' => $challengeXP,
            'formCreature' => $formCreature->createView(),
            'editMode' => $creature->getId() !== null
        ]);
    }

    /**
     * @Route("/types", name="creature.types")
     */
    public function types(CreatureTypeRepository $typeRepo){
        $subtitle = "Types";
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        $message = '';
        
        if(isset($_POST)){
            $type = new CreatureType();
            if(isset($_POST['type_name'])){     // Ajout d'un type
                // vérification de la validité du nouveau nom
                $message = $this->checkName($_POST['type_name']);
                if(empty($message)){
                    //vérification de l'unicité du name                
                    $response = $typeRepo->findOneByName(array('name' => $_POST['type_name']));
                    if($response){
                        $message = "Un type de créature avec ce nom existe déjà.";
                    }else{
                        // on ajoute le nouveau type en bdd
                        $entityManager = $this->getDoctrine()->getManager();
                        $type->setName($this->secureData($_POST['type_name']));
                        $entityManager->persist($type);
                        $entityManager->flush();
                    }
                }else{
                    $message = "Nom invalide";
                }                
            }elseif(isset($_POST['type_del'])){       // suppression d'un type
                $entityManager = $this->getDoctrine()->getManager();
                $type = $typeRepo->findOneById(array('name' => $_POST['type_del']));
                if($type){
                    $entityManager->remove($type);
                    $entityManager->flush();
                }
            }
        }        
        $types = $typeRepo->findBy(array(),array('name' => 'ASC'));
        return $this->render('creatures/types.html.twig',[
            'message' => $message,
            'title' => $title,
            'types' => $types
        ]);
    }

    /**
     * @Route("/types/{id}", name="type")
     */
    public function type($id, CreatureTypeRepository $typeRepo){
        $subtitle = "Type";
        $message = '';
        $type = $typeRepo->findOneById(array('id' => $id));        
        if($type !== null){
            $subtitle = $type->getName();
        }else{
            // redirection vers notFound
            return $this->redirectToRoute('notFound');
        }
        if(isset($_POST['type_name'])){
            // vérification de la validité du nouveau nom
            $message = $this->checkName($_POST['type_name']);
            if(empty($message)){
                // vérification de l'unicité
                $existingType = $typeRepo->findOneByName(array('name' => $_POST['type_name']));
                if($existingType != null and ($existingType->getId() != $id)){
                    $message = "Nom de type déjà utilisé";
                }else{
                    // update de la modification
                    $entityManager = $this->getDoctrine()->getManager();
                    $type->setName($this->secureData($_POST['type_name']));
                    $entityManager->flush();
                    return $this->redirectToRoute('creature.types');
                }                
            }else{
                $message = "Nom invalide";
            }            
        }
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        return $this->render('creatures/type.html.twig',[
            'message' => $message,
            'title' => $title,
            'type' => $type
        ]);
    }

    /**
     * @Route("/sizes", name="creature.sizes")
     */
    public function sizes(CreatureSizeRepository $sizeRepo){
        $subtitle = "Tailles";
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        $message = '';
        
        if(isset($_POST)){
            $size = new CreatureSize();
            if(isset($_POST['size_name'])){     // Ajout d'une taille
                // vérification de la validité des champs
                $message = $this->checkSize($_POST);
                if(empty($message)){
                    //vérification de l'unicité du name                
                    $response = $sizeRepo->findOneByName(array('name' => $_POST['size_name']));
                    if($response){
                        $message = "Une taille de créature avec ce nom existe déjà.";
                    }else{
                        // on ajoute la nouvelle taille en bdd
                        $entityManager = $this->getDoctrine()->getManager();
                        $hit_dice = (int) $_POST['size_hit_dice'];
                        $space = (float) $_POST['size_space'];
                        $size->setName($this->secureData($_POST['size_name']))
                             ->setHitDice($hit_dice)
                             ->setSquareSpace($space);
                        $entityManager->persist($size);
                        $entityManager->flush();
                    }
                }                
            }elseif(isset($_POST['size_del'])){       // suppression d'un type
                $entityManager = $this->getDoctrine()->getManager();
                $size = $sizeRepo->findOneById(array('name' => $_POST['size_del']));
                if($size){
                    $entityManager->remove($size);
                    $entityManager->flush();
                }
            }
        }        
        $sizes = $sizeRepo->findBy(array(),array('hitDice' => 'ASC'));
        return $this->render('creatures/sizes.html.twig',[
            'message' => $message,
            'title' => $title,
            'sizes' => $sizes
        ]);
    }

    /**
     * @Route("/sizes/{id}", name="size")
     */
    public function size($id,CreatureSizeRepository $sizeRepo){
        $subtitle = "Size";
        $message = '';
        $size = $sizeRepo->findOneById(array('id' => $id));        
        if($size !== null){
            $subtitle = $size->getName();
        }else{
            // redirection vers notFound
            return $this->redirectToRoute('notFound');
        }
        if(isset($_POST['size_name'])){
            // vérification de la validité du nouveau nom
            $message = $this->checkName($_POST['size_name']);
            if(empty($message)){
                // vérification de l'unicité
                $existingSize = $sizeRepo->findOneByName(array('name' => $_POST['size_name']));
                if($existingSize != null and ($existingSize->getId() != $id)){
                    $message = "Nom de taille déjà utilisé";
                }else{
                    // update de la modification
                    $entityManager = $this->getDoctrine()->getManager();
                    $hit_dice = (int) $_POST['size_hit_dice'];
                    $space = (float) $_POST['size_space'];
                    $size->setName($this->secureData($_POST['size_name']))
                         ->setHitDice($hit_dice)
                         ->setSquareSpace($space);
                    $entityManager->flush();
                    return $this->redirectToRoute('creature.sizes');
                }                
            }else{
                $message = "Nom invalide";
            }            
        }
        $formSize = $this->createFormBuilder($size)
                     ->add('name')
                     ->add('hitDice')
                     ->add('squareSpace')
                     ->getForm();
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
        return $this->render('creatures/size.html.twig',[
            'message' => $message,
            'title' => $title,
            'size' => $size,
            'formSize' => $formSize->createView()
        ]);
    }
    
    /**
     * @Route("/alignments", name="alignments")
     * @Route("/alignment/{id}", name="alignment")
     */
    public function alignments($id = null,Request $request, AlignmentRepository $alignmentRepo){
        $subtitle = "Alignements";
        $title = "Zgrouf - DnD5 - Créatures - " . $subtitle;
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