<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\Framework\Controller\AbstractController;
use App\Entity\Source;
use App\Repository\SourceRepository;

class PublicController extends AppController{
    
    /**
     * @Route("/sources", name="sources")
     */
    public function sources(SourceRepository $srcRepo){
        $subtitle = "Sources";
        $title = "Zgrouf - DnD5 - " . $subtitle;
        $message = '';
        
        if(isset($_POST)){
            $source = new Source();
            if(isset($_POST['src_name'])){     // Ajout d'une source
                // vérification de la validité des champs
                $message = $this->checkSource($_POST);
                if(empty($message)){
                    //vérification de l'unicité du name                
                    $response = $srcRepo->findOneByName(array('name' => $_POST['src_name']));
                    if($response){
                        $message = "Une source avec ce nom existe déjà.";
                    }else{
                        // on ajoute la nouvelle source en bdd
                        $entityManager = $this->getDoctrine()->getManager();
                        $source->setName($this->secureData($_POST['src_name']))
                             ->setLabel($this->secureData($_POST['src_label']));
                        $entityManager->persist($source);
                        $entityManager->flush();
                    }
                }                
            }elseif(isset($_POST['source_del'])){       // suppression d'une source
                $entityManager = $this->getDoctrine()->getManager();
                $source = $srcRepo->findOneById(array('name' => $_POST['source_del']));
                if($source){
                    $entityManager->remove($source);
                    $entityManager->flush();
                }
            }
        }        
        $sources = $srcRepo->findBy(array(),array('name' => 'ASC'));
        return $this->render('public/sources.html.twig',[
            'message' => $message,
            'title' => $title,
            'sources' => $sources
        ]);
    }


    /**
     * @Route("/sources/{id}", name="source")
     */
    public function source($id,SourceRepository $srcRepo){
        $subtitle = "Source";
        $message = '';
        $source = $srcRepo->findOneById(array('id' => $id));        
        if($source !== null){
            $subtitle = $source->getName();
        }else{
            // redirection vers notFound
            return $this->redirectToRoute('notFound');
        }
        if(isset($_POST['src_name'])){
            // vérification de la validité du nouveau nom
            $message = $this->checkSource($_POST);
            if(empty($message)){
                // vérification de l'unicité
                $existingSrc = $srcRepo->findOneByName(array('name' => $_POST['src_name']));
                $existingLbl = $srcRepo->findOneByName(array('label' => $_POST['src_label']));
                if($existingSrc != null and ($existingSrc->getId() != $id)){
                    $message = "Nom de source déjà utilisé";
                }elseif($existingLbl != null and ($existingLbl->getId() != $id)){
                    $message = "Label déjà utilisé";
                }else{
                    // update de la modification
                    $entityManager = $this->getDoctrine()->getManager();
                    $source->setName($this->secureData($_POST['src_name']))
                         ->setLabel($this->secureData($_POST['src_label']));
                    $entityManager->flush();
                    return $this->redirectToRoute('sources');
                }                
            }else{
                $message = "Nom/label invalide";
            }            
        }
        $formSrc = $this->createFormBuilder($source)
                     ->add('name')
                     ->add('label')
                     ->getForm();
        $title = "Zgrouf - DnD5 - " . $subtitle;
        return $this->render('public/source.html.twig',[
            'message' => $message,
            'title' => $title,
            'source' => $source,
            'formSrc' => $formSrc->createView()
        ]);
    }

    /**
     * @Route("/{slug}", name="notFound")
     */
    /* public function home(){
        $subtitle = "Page introuvable";
        $title = "Zgrouf - DnD5 - " . $subtitle;        

        return $this->render('public/notFound.html.twig',[
            'title' => $title
        ]);
    } */
}