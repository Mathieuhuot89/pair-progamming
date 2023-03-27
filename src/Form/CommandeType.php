<?php

namespace App\Form;

use App\Entity\Voiture;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // $builder
        //     ->add('montant')
        //     ->add('nbJourLoc')
        //     ->add('jourDepart')
        //     ->add('jourArrive')
        //     ->add('createdAt')
        //     ->add('status')
        //     ->add('user')
        //     ->add('voiture')
        // ;

        $builder
            // ->add('montant', IntegerType::class)
            ->add('jourDepart', DateTimeType::class, [
                // 'widget' => 'single_text',
                // 'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker form-control',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy',
                ],
                'data' => new \DateTime()
            ])
            ->add('jourArrive', DateTimeType::class, [
                // 'widget' => 'single_text',
                'html5' => false,
                'attr' => [
                    'class' => 'js-datepicker form-control',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd/mm/yyyy',
                ],
                'data' => new \DateTime()
            ])
            // ->add('nbJourLoc', IntegerType::class)
            // ->add('status', CheckboxType::class, [
            //     'label'    => 'status commande',
            //     'required' => false,
            // ])
            // ->add('voiture', EntityType::class, [
            //     'class' => Voiture::class,
            //     'attr' => [
            //         'class' => 'form-control mb-3',
            //     ],
            //     'label' => false
            // ])
            ->add('submit', SubmitType::class, [
                'label' => 'Réserver',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
