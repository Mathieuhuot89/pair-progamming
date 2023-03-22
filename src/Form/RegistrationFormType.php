<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Prénom',
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom',
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse',
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre ville',
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('pays', CountryType::class, [
                'label' => false,
                'preferred_choices' => ['FR', 'BE'],
                'attr' => [
                    'class' => 'form-control mb-3'
                ]
            ])

            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre code postal',
                    'class' => 'form-control mb-3'
                ]
            ])


            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control mb-3'
                ],
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Password',
                        'class' => 'form-control mb-3'
                    ]
                ],

                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirm Password',
                        'class' => 'form-control mb-3'
                    ]
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
