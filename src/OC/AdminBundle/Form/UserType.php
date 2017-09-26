<?php

namespace OC\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder->add('username', TextType::class,
                  array('label' => 'Pseudonyme'))
                ->add('nom', TextType::class,
                  array('label' => 'Nom'))
                ->add('prenom', TextType::class,
                    array('label' => 'Prénom'))
                ->add('password', PasswordType::class,
                  array('label' => 'Mot de passe'))
                ->add('email', EmailType::class,
                  array('label' => 'Email'))
                ->add('roles', ChoiceType::class,
                  array(
                    'label' => 'Droits',
                    'multiple' => true,
                        'expanded' => true,
                        'choices'  => array('Administrateur' => 'ROLE_ADMIN',
                          'Super-administrateur'=>'ROLE_SUPER_ADMIN',
                                             ),))
                ->add('Valider', SubmitType::class, array(
    'attr' => array('class' => 'save'),
    ))
                ;
    }

    public function buildYearChoices()
    {
        $first = new \DateTime('01/01/2010');
        $now = new \DateTime();
        $years = array();
        $years[0] = $first->format('Y');
        $i = 1;
        $oneYear = new \DateInterval('P1Y');
        while($first->format('Y') != $now->format('Y')) {
            $first->add($oneYear);
            $years[$i] = $first->format('Y');
            $i++;
        }
        return array_combine($years, $years);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\AdminBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_adminbundle_user';
    }


}
