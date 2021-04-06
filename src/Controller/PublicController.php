<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Source;
use App\Repository\SourceRepository;

class PublicController extends AppController{
    const BASE_TITLE = "Zgrouf - DnD5 ";
    /**
     * @Route("/", name="home")
     */
    public function home(){
        $subtitle = "- Index";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('public/home.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/convert", name="convert")
     */
    public function convert(){
        $subtitle = "Convertisseur";
        $title = self::BASE_TITLE . $subtitle;        

        return $this->render('public/convert.html.twig',[
            'title' => $title
        ]);
    }

    /**
     * @Route("/sources", name="sources")
     * @Route("/sources/{id}", name="source")
     */
    public function sources($id = null,
                              Request $request,
                              SourceRepository $sourceRepo){
        $subtitle = "- Sources";
        $title = self::BASE_TITLE. $subtitle;
        $message = '';
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC','official' => 'DESC'));

        if($id === null){
            $source = new Source();
        }else{  // recuperation de la source correspondante
            $source = $sourceRepo->findOneById(array('id' => $id));
        }      

        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formSource = $this->createFormBuilder($source)
                          ->add('name')
                          ->add('label')
                          ->add('official', ChoiceType::class, [
                              'choices' => ['Oui' => '1','Non' => '0'],
                              'multiple'=>false,
                              'expanded'=>true
                              ])
                          ->getForm();
        $formSource->handleRequest($request);
        // update ou new
        if($formSource->isSubmitted() && $formSource->isValid()){            
            if($source->getId() === null){  // new                          
                $entityManager->persist($source);
            }
            $entityManager->flush();
            return $this->redirectToRoute('source');
        }
        // suppression d'une source
        if(isset($_POST['source_del'])){       
            $source = $sourceRepo->findOneById(array('id' => $_POST['source_del']));
            if($source){
                $entityManager->remove($source);
                $entityManager->flush();
            }
        }
        // récupération de la liste des sources à jour
        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));    
        
        return $this->render('public/sources.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources,
            'formSource' => $formSource->createView(),
            'editMode' => $source->getId() !== null
        ]);
    }
}