<?php

namespace OC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\Response;

use OC\AdminBundle\Entity\Admin;
use OC\QuestBundle\Entity\Questions;
use OC\QuestBundle\Form\QuestionsType;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCAdminBundle:Default:index.html.twig');
    }

   

  public function menuAction()
    {
        return $this->render('OCAdminBundle:Default:menu.html.twig');
    }



       public function merciAction()
    {
          return $this->render('OCAdminBundle:Default:merci.html.twig');
    }

      public function conectAction(){
        return $this->render('OCAdminBundle:Default:conect.html.twig');
      }
    


       public function listAction()
    {
                $repository = $this
                     ->getDoctrine()
                     ->getManager()
                     ->getRepository('OCQuestBundle:Questions')
                ;

                 $listQuest = $repository->findAll();
         
                return $this->render('OCAdminBundle:Default:list.html.twig',array('listQuest'=>$listQuest));
    }


    public function adminAction()
    {
   $repository = $this
                     ->getDoctrine()
                     ->getRepository('OCQuestBundle:Questions')
                     ;

    $lists = $repository->findAll();

    return $this->render('OCAdminBundle:Default:admin.html.twig',array(
        'lists'=>$lists));
    }


    public function editAction(Request $request, Questions $questions){
$form   = $this->get('form.factory')->create(QuestionsType::class, $questions);
    // À partir du formBuilder, on génère le formulaire

    // $request=$this->get('request');

     if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

    // $request=$this->get('request');
          $em =$this->getDoctrine()->getManager();
         // $em->persist($questions);
          $em->flush();
    
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_admin_modif', array('id' => $questions->getId()));
       }
     
  
    return $this->render('OCQuestBundle:Default:form.html.twig', array(
      'form' => $form->createView(),
    ));
    }


    
    public function deleteAction(Questions $questions)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($questions);
        $em->flush();

        return $this->render('OCAdminBundle:Default:deleted.html.twig');
    }


       public function admin_countAction()
    {
                $repository = $this
                     ->getDoctrine()
                     ->getManager()
                     ->getRepository('OCQuestBundle:Questions')
                ;


               /* $tot = $this->getDoctrine()
                       ->getRepository('OCQuestBundle:Questions')
                       ->find($id);*/
                 $result =array();
                $listQuest = $repository->findAll();
                //$result =array_merge($result,$listQuest['0']);
                                                                       
                   //print_r($result); 
                //  print_r($listQuest[1]); 
                 print_r($listQuest[1]);
         
                //    print_r($listQuest[1]['inciter:OC\QuestBundle\Entity\Questions:private']);
                      //print_r($listQuest);





                  //$lol = $repository->findByInciter('inciter');

                  //var_dump($lol);
 
  /* REPONSE 1_1 */               
$listQuest1 = $repository->findByEnfants('oui');
$listQuest2 = $repository->findByEnfants('non');

 /* REPONSE 1_2 */ 

$amis1 = $repository->findByAmis('oui');
$amis2 = $repository->findByAmis('non');

   /* REPONSE 3 */ 
$raison1 = $repository->findByRaison("Ne savent pas à quoi cela sert");
$raison2 = $repository->findByRaison("Ont d'autres priorités de dons");
$raison3 = $repository->findByRaison("L'Église est riche");
$raison4 = $repository->findByRaison("N'ont jamais été sollicités");
$raison5 = $repository->findByRaison("N'ont jamais entendu parlé du Denier");


   /* REPONSE 4 */ 

$inciter1 = $repository->findByInciter(array( 0 =>"Devoir de baptisé"));
$inciter2 = $repository->findByInciter("Impôt volontaire des catholiques");
$inciter3 = $repository->findByInciter("Faire vivre mon curé et les prêtres");
$inciter4 = $repository->findByInciter("Rémunérer les employés (secrétaires, sacristain,organiste, ...)");
$inciter5 = $repository->findByInciter("Financer les travaux : (réfections, embellissement)");
$inciter6 = $repository->findByInciter("Payer les factures : (entretien des locaux, électricité,chauffage, Internet, Impôts, ...)");
$inciter7 = $repository->findByInciter("Faire connaître l’Évangile");
$inciter8 = $repository->findByInciter("Permettre de se former, de grandir dans la Foi à la suitede Jésus-Christ (catéchisme, aumônerie pour les jeunes, catéchuménat, parcours alpha, enseignement pour les adultes)");
$inciter9 = $repository->findByInciter("Assurer une présence de l’Église dans la ville");
$inciter10 = $repository->findByInciter("Être là auprès des pauvres, des isolés et des personnes fragiles");
$inciter11 = $repository->findByInciter("Accompagner les paroissiens dans les joies et les difficultés de leur existence");
$inciter12 = $repository->findByInciter("Célébrer (eucharistie, mariage, baptême, pardon, obsèques,…)");


                return $this->render('OCAdminBundle:Default:admin_count.html.twig',array(
                    'listQuest'=>$listQuest,

                    'listQuest1'=>$listQuest1,
                    'listQuest2'=>$listQuest2,
                    'amis1'=>$amis1,
                    'amis2'=>$amis2,

                    'raison1'=>$raison1,
                    'raison2'=>$raison2,
                    'raison3'=>$raison3,
                    'raison4'=>$raison4,
                    'raison5'=>$raison5,

                    'inciter1'=>$inciter1,
                    'inciter2'=>$inciter2,
                    'inciter3'=>$inciter3,
                    'inciter4'=>$inciter4,
                    'inciter5'=>$inciter5,
                    'inciter6'=>$inciter6,
                    'inciter7'=>$inciter7,
                    'inciter8'=>$inciter8,
                    'inciter9'=>$inciter9,
                    'inciter10'=>$inciter10,
                    'inciter11'=>$inciter11,
                    'inciter12'=>$inciter12

                    ));
    }

    
    
}
