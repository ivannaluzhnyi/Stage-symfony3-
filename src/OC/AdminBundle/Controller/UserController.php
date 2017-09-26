<?php
// sym3/OC/AdminBundle/Controller/SecurityController.php;

namespace OC\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FormType;


use OC\AdminBundle\Form\UserType;
use OC\AdminBundle\Entity\User;


class UserController extends Controller
{
  

   public function createAccountAction(Request $request){
          $em =$this->getDoctrine()->getManager();
          $user = new User();

           $form=$this->get('form.factory')->create(UserType::class, $user);
           if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

        
               $encoder = $this->container->get('security.password_encoder');

             $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
                $user->setCle($user->generateCle(25));
         
                $em->persist($user);
                 $em->flush();
    
      return $this->redirectToRoute('oc_admin_user_list', array('id' => $user->getId()));
       }
   
  
    return $this->render('OCAdminBundle:User:create.html.twig', array(
      'form' => $form->createView(),
    ));

   }

   
   public function user_listAction(){
     $repository = $this
                     ->getDoctrine()
                     ->getManager()
                     ->getRepository('OCAdminBundle:User')
                ;

                 $listQuest = $repository->findAll();
                return $this->render('OCAdminBundle:User:user_list.html.twig',array('listQuest'=>$listQuest));
}
  
   public function user_deleteAction(User $user){
     $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->render('OCAdminBundle:Default:deleted.html.twig');
   }


   public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('OCAdminBundle:User')->find($id);

        $form = $this->createForm(UserType::class, $user);


     if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
          $encoder = $this->container->get('security.password_encoder');

          $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
                $user->setCle($user->generateCle(25));
            $em->flush();
            return $this->redirectToRoute('oc_admin_user_list', array());
        }
        return $this->render('OCAdminBundle:User:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }



   public function user_editAction(Request $request, User $user){

    $em =$this->getDoctrine()->getManager();
      $form=$this->get('form.factory')->create(UserType::class, $user);
    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

        
           $encoder = $this->container->get('security.password_encoder');

          $encoded = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($encoded);
                $user->setCle($user->generateCle(25));
         
         // $em->persist($user);
          $em->flush();
    
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_admin_user_list', array('id' => $user->getId()));
       }
     
  
    return $this->render('OCAdminBundle:User:update.html.twig', array(
      'form' => $form->createView(),
    ));
   }

}