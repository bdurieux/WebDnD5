<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\Framework\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Setting;
use App\Entity\Source;
use App\Repository\SettingRepository;
use App\Repository\SourceRepository;

class PublicController extends AppController{
    const BASE_TITLE = "Zgrouf - DnD5 ";
    /**
     * @Route("/", name="home")
     */
    public function home(SourceRepository $sourceRepo){
        $subtitle = "- Index";
        $title = self::BASE_TITLE . $subtitle;        

        $sources = $sourceRepo->findBy(array(),array('official' => 'DESC','name' => 'ASC'));

        return $this->render('public/home.html.twig',[
            'sources' => $sources,
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
                              SourceRepository $sourceRepo,
                              SettingRepository $settingRepo){
        $subtitle = "- Sources";
        $title = self::BASE_TITLE. $subtitle;
        $message = '';
        $sources = $sourceRepo->findBy(array(),array('name' => 'ASC','official' => 'DESC'));
        $settings = $settingRepo->findBy(array(),array('name' => 'ASC'));
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
                          ->add('idSetting', ChoiceType::class, [
                            'choices' => $settings,
                            'choice_label' => 'getName'
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

    /**
     * @Route("/settings", name="campagnes")
     * @Route("/setting/{id}", name="campagne")
     */
    public function editSetting($id = null,
                              Request $request,
                              SettingRepository $settingRepo){
        $subtitle = "- Campagnes";
        $title = self::BASE_TITLE. $subtitle;
        $message = '';
        $settings = $settingRepo->findBy(array(),array('name' => 'ASC'));

        if($id === null){
            $setting = new Setting();
        }else{  // recuperation de la setting correspondante
            $setting = $settingRepo->findOneById(array('id' => $id));
        }      

        $entityManager = $this->getDoctrine()->getManager();
        // création du formulaire
        $formSetting = $this->createFormBuilder($setting)
                          ->add('name')
                          ->getForm();
        $formSetting->handleRequest($request);
        // update ou new
        if($formSetting->isSubmitted() && $formSetting->isValid()){            
            if($setting->getId() === null){  // new                          
                $entityManager->persist($setting);
            }
            $entityManager->flush();
            return $this->redirectToRoute('campagnes');
        }
        // suppression d'une setting
        if(isset($_POST['setting_del'])){       
            $setting = $settingRepo->findOneById(array('id' => $_POST['setting_del']));
            if($setting){
                $entityManager->remove($setting);
                $entityManager->flush();
            }
        }
        // récupération de la liste des settings à jour
        $settings = $settingRepo->findBy(array(),array('name' => 'ASC'));    
        
        return $this->render('public/settings.html.twig',[
            'message' => $message,
            'title' => $title,
            'settings' => $settings,
            'formSetting' => $formSetting->createView(),
            'editMode' => $setting->getId() !== null
        ]);
    }
}