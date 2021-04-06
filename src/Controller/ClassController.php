<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Source;
use App\Entity\Classe;
use App\Entity\ClasseOption;
use App\Entity\Subclass;
use App\Entity\SubclassTrait;
use App\Repository\SourceRepository;
use App\Repository\ClasseRepository;
use App\Repository\ClasseOptionRepository;
use App\Repository\SubclassRepository;
use App\Repository\SubclassTraitRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ClassController extends AppController{
    const BASE_TITLE = "Zgrouf - DnD5 - Classes ";
    const HIT_DICE = [6,8,10,12
        /* "1" => "6",
        "2" => "8",
        "3" => "10",
        "4" => "12" */
    ];

    /**
     * @Route("/class", name="classes")
     */
    public function showClasses(Request $request,ClasseRepository $classeRepo,SourceRepository $sourceRepo){
        $title = self::BASE_TITLE;
        $entityManager = $this->getDoctrine()->getManager();
        $classe = new Classe();
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));
        // création du formulaire
        $formClasse = $this->createFormBuilder($classe)
                          ->add('name')
                          ->add('description')
                          ->add('armors')
                          ->add('weapons')
                          ->add('tools')
                          ->add('saves')
                          ->add('skills')
                          ->add('hit_dice', ChoiceType::class, [
                              'choices' => array_flip(self::HIT_DICE)
                              ])
                          ->add('idSource', ChoiceType::class, [
                            'choices' => $sources,
                            'choice_label' => 'getLabel'
                            ])
                          ->add('page')
                          ->getForm();
        $formClasse->handleRequest($request);
        
        // new
        if($formClasse->isSubmitted() && $formClasse->isValid()){            
            if($classe->getId() === null){  // new                          
                $entityManager->persist($classe);
            }
            $entityManager->flush();
            return $this->redirectToRoute('classes');
        }
        
        return $this->render("classes/classes.html.twig",[
            'title' => $title,
            'sources' => $sources,
            'formClasse' => $formClasse->createView()
        ]);
    }

    /**
     * @Route("/class/options", name="class.options")
     * @Route("/class/options/{id}", name="class.option")
     */
    public function editOptions($id = null,
                                Request $request,
                                ClasseRepository $classeRepo,
                                ClasseOptionRepository $classeOptionRepo){

        $subtitle = "- Options";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        if($id === null){
            $classeOption = new ClasseOption();
        }else{  // recuperation de l'option correspondante
            $classeOption = $classeOptionRepo->findOneById(array('id' => $id));
        }  
        $entityManager = $this->getDoctrine()->getManager();
        $classes = $classeRepo->findBy(array(),array('name' => 'ASC'));
        $classeOptions = $classeOptionRepo->findAllOrdered();        
        // création du formulaire
        $formClasseOption = $this->createFormBuilder($classeOption)
                          ->add('name')
                          ->add('description')
                          ->add('level')
                          ->add('idClass', ChoiceType::class, [
                            'choices' => $classes,
                            'choice_label' => 'getName'
                            ])
                          ->getForm();
        $formClasseOption->handleRequest($request);
        // update ou new
        if($formClasseOption->isSubmitted() && $formClasseOption->isValid()){            
            if($classeOption->getId() === null){  // new                          
                $entityManager->persist($classeOption);
            }
            $entityManager->flush();
            return $this->redirectToRoute('class.options');
        }
        // suppression d'une source
        if(isset($_POST['option_del'])){       
            $classeOption = $classeOptionRepo->findOneById(array('id' => $_POST['option_del']));
            if($classeOption){
                $entityManager->remove($classeOption);
                $entityManager->flush();
            }
        }
        // récupération de la liste des options à jour
        $classeOptions = $classeOptionRepo->findAllOrdered(); 

        return $this->render("classes/options.html.twig",[
            'message' => $message,
            'title' => $title,
            //'classes' => $classes,
            'classeOptions' => $classeOptions,
            'formClasseOption' => $formClasseOption->createView(),
            'editMode' => $classeOption->getId() !== null
        ]);
    }

    /**
     * @Route("/class/subclasses", name="class.subclasses")
     * @Route("/class/subclasses/{id}", name="class.subclass")
     */
    public function editSubClass($id = null,
                                Request $request,
                                ClasseRepository $classeRepo,
                                SubclassRepository $subclassRepo,
                                SourceRepository $sourceRepo){

        $subtitle = "- Subclasses";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        if($id === null){
            $subclass = new Subclass();
        }else{  // recuperation de la subclass correspondante
            $subclass = $subclassRepo->findOneById(array('id' => $id));
        }  
        $entityManager = $this->getDoctrine()->getManager();
        $classes = $classeRepo->findBy(array(),array('name' => 'ASC'));
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC'));
        $subclasses = $subclassRepo->findAllOrdered();        
        // création du formulaire
        $formSubclass = $this->createFormBuilder($subclass)
                          ->add('name')
                          ->add('description')                          
                          ->add('idClass', ChoiceType::class, [
                            'choices' => $classes,
                            'choice_label' => 'getName'
                            ])
                          ->add('idSource', ChoiceType::class, [
                            'choices' => $sources,
                            'choice_label' => 'getLabel'
                            ])
                          ->add('page')
                          ->getForm();
        $formSubclass->handleRequest($request);
        // update ou new
        if($formSubclass->isSubmitted() && $formSubclass->isValid()){            
            if($subclass->getId() === null){  // new                          
                $entityManager->persist($subclass);
            }
            $entityManager->flush();
            return $this->redirectToRoute('class.subclasses');
        }
        // suppression d'une source
        if(isset($_POST['option_del'])){       
            $subclass = $subclassRepo->findOneById(array('id' => $_POST['subclass_del']));
            if($subclass){
                $entityManager->remove($subclass);
                $entityManager->flush();
            }
        }
        // récupération de la liste des subclass à jour
        $subclasses = $subclassRepo->findAllOrdered(); 

        return $this->render("classes/subclasses.html.twig",[
            'message' => $message,
            'title' => $title,
            //'classes' => $classes,
            'subclasses' => $subclasses,
            'formSubclass' => $formSubclass->createView(),
            'editMode' => $subclass->getId() !== null
        ]);
    }

    private function cleanFileName($name){  //TODO: regex pour éliminer caractères spéciaux
        return str_replace(" ","_",trim(htmlspecialchars($name)));
    }

    /**
     * @Route("/class/subclasstraits", name="class.subclasstraits")
     * @Route("/class/subclasstraits/{id}", name="class.subclasstrait")
     */
    public function editSubClassTrait($id = null,
                                Request $request,
                                ClasseRepository $classeRepo,
                                SubclassRepository $subclassRepo,
                                SubclassTraitRepository $subclasstraitRepo,
                                SourceRepository $sourceRepo){

        $subtitle = "- Traits de sous-classes";
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        if($id === null){
            $subclasstrait = new SubclassTrait();
        }else{  // recuperation du trait correspondant
            $subclasstrait = $subclasstraitRepo->findOneById(array('id' => $id));
        }  
        $entityManager = $this->getDoctrine()->getManager();
        $classes = $classeRepo->findBy(array(),array('name' => 'ASC'));
        $subClasses = $subclassRepo->findAllOrdered();
        //$subclasstraits = $subclasstraitRepo->findAllOrdered();
        // création du formulaire
        $formSubclassTrait = $this->createFormBuilder($subclasstrait)
                          ->add('name')
                          ->add('description')                          
                          ->add('idSubclass', EntityType::class, [
                              'class' => Subclass::class,
                              'choice_label' => function(Subclass $subclass) {
                                return $subclass->getName();
                            }
                              /*'choices' => $subClasses ,
                            'choice_label' => function ($choice, $key, $value) {
                                return $choice;
                                } */
                            ]) 
                            /* 'choice_label' => 'getName'
                            ]) */ 
                          ->add('level')
                          ->getForm();
        $formSubclassTrait->handleRequest($request);
        // update ou new
        if($formSubclassTrait->isSubmitted() && $formSubclassTrait->isValid()){            
            if($subclasstrait->getId() === null){  // new                          
                $entityManager->persist($subclasstrait);
            }
            $entityManager->flush();
            return $this->redirectToRoute('class.subclasstraits');
        }
        // suppression d'une source
        if(isset($_POST['option_del'])){       
            $subclasstrait = $subclasstraitRepo->findOneById(array('id' => $_POST['subclasstrait_del']));
            if($subclasstrait){
                $entityManager->remove($subclasstrait);
                $entityManager->flush();
            }
        }
        // récupération de la liste des traits à jour
        $subclasstraits = $subclasstraitRepo->findAllOrdered(); 
        return $this->render("classes/subclasstraits.html.twig",[
            'message' => $message,
            'title' => $title,
            'classes' => $classes,
            'subClasses' => $subClasses,
            'subclasstraits' => $subclasstraits,
            'formSubclassTrait' => $formSubclassTrait->createView(),
            'editMode' => $subclasstrait->getId() !== null
        ]);
    }

    /**
     * @Route("/class/{id}", name="class")
     */
    public function showClass(  
                            $id,
                            SubclassRepository $subclassRepo,
                            ClasseRepository $classeRepo,
                            SubclassTraitRepository $subclasstraitRepo
                            ){
        $classe = $classeRepo->findOneById(array('id' => $id));
        // no class match the id
        if($classe === null){
            return $this->redirectToRoute('classes');
        }
        $subClasses = $subclassRepo->findByIdClassOrdered($id);
        $subtitle = "- " . ucfirst(strtolower($classe->getName()));
        $title = self::BASE_TITLE . $subtitle;
        $message = '';
        $subclasstraits = $subclasstraitRepo->findAllOrdered();

        return $this->render("classes/classe.html.twig",[
            'message' => $message,
            'title' => $title,
            'classe' => $classe,
            'subClasses' => $subClasses,
            'subclasstraits' => $subclasstraits
        ]);
    }
}