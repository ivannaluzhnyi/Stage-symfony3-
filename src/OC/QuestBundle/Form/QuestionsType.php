<?php

namespace OC\QuestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class QuestionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('enfants', ChoiceType::class,
                    array(
                        'label' => 'À vos enfants (si vous en avez)',
                        'expanded'=>true,
                        'choices' =>array(
                            'Oui ' =>'oui',
                            'Non ' =>'non',
                            ),
                        )
                    )
              
                ->add('amis', ChoiceType::class,
                    array(
                        'label' => 'Avec vos amis proches',
                        'expanded'=>true,
                        'choices' =>array(
                            'Oui ' =>'oui',
                            'Non ' =>'non',
                            ),
                        )
                    )
    
                ->add('annee', NumberType::class,array('required'=>true))
     
                ->add('raison', ChoiceType::class,
                    array(
                        'label' => ' ',
                        'expanded'=>true,
                        'choices' =>array(
                            "Ne savent pas à quoi cela sert" =>"Ne savent pas à quoi cela sert",
                            "Ont d'autres priorités de dons" =>"Ont d'autres priorités de dons",
                            "L'Église est riche" =>"L'Église est riche",
                            "N'ont jamais été sollicités" =>"N'ont jamais été sollicités",
                            "N'ont jamais entendu parlé du Denier" =>"N'ont jamais entendu parlé du Denier",
                            ),
                        )
                    )

                ->add('inciter', ChoiceType::class,
                    array(
                        'label' => ' ',
                        'expanded'=>true,
                        'multiple'=>true,
                        'choices' =>array(
                            "Devoir de baptisé" =>"Devoir de baptisé",

                            "Impôt volontaire des catholiques" =>"Impôt volontaire des catholiques",

                            "Faire vivre mon curé et les prêtres" =>"Faire vivre mon curé et les prêtres",

                            "Rémunérer les employés (secrétaires, sacristain, organiste,…)" =>"Rémunérer les employés (secrétaires, sacristain,organiste, ...)",

                            "Financer les travaux : (réfections, embellissement)" =>"Financer les travaux : (réfections, embellissement)",

                            "Payer les factures : (entretien des locaux, électricité, chauffage, Internet, Impôts,…)" =>"Payer les factures : (entretien des locaux, électricité,chauffage, Internet, Impôts, ...)",

                            "Faire connaître l’Évangile" =>"Faire connaître l’Évangile",

                            "Permettre de se former, de grandir dans la foi à la suite de Jésus-Christ (catéchisme, aumônerie pour les jeunes, catéchuménat, parcours alpha, enseignement pour les adultes)" =>"Permettre de se former, de grandir dans la Foi à la suitede Jésus-Christ (catéchisme, aumônerie pour les jeunes, catéchuménat, parcours alpha, enseignement pour les adultes)",

                            "Assurer une présence de l’Église dans la ville" =>"Assurer une présence de l’Église dans la ville",

                            "Être là auprès des pauvres, des isolés et des personnes fragiles" =>"Être là auprès des pauvres, des isolés et des personnes fragiles",

                            "Accompagner les paroissiens dans les joies et les difficultés de leur existence" =>"Accompagner les paroissiens dans les joies et les difficultés de leur existence",

                            "Célébrer (eucharistie, mariage, baptême, pardon, obsèques,…)" =>"Célébrer (eucharistie, mariage, baptême, pardon, obsèques,…)",

                            ),
                        )
                    )

                ->add('submit', SubmitType::class)
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\QuestBundle\Entity\Questions'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_questbundle_questions';
    }

    
}
