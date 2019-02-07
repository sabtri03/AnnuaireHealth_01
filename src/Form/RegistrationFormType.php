<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Localite;
use App\Entity\Services;
use App\Entity\Worker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('emailPublic', EmailType::class)
            ->add('password', PasswordType::class, [
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('adresseNumber', TextType::class)
            ->add('adresseStreet', TextType::class)
           // ->add('banned', null, array('default' => 0))
           // ->add('inscribe', null, array('default' => 0))
            //->add('inscribeDate', DateType::class, array('widget' => 'single_text','input' => 'string','format' => 'yyyy-MM-dd','attr' => array('placeholder' => 'yyyy-MM-dd',)))
            //->add('nbTry', null, array('default' => 0))
            //->add('roles', ChoiceType::class, ['choices' => ['User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN'], 'expanded' => true, 'multiple' => true])
            ->add('phoneNumber',IntegerType::class)
            ->add('tvaNb', IntegerType::class)
            ->add('webSite', UrlType::class)
            ->add('postCode', EntityType::class, ['class'=>CodePostal::class,'choice_label'=>'postCode'])
            ->add('city', EntityType::class, ['class'=>Localite::class,'choice_label'=>'city'])
            ->add('services',
                EntityType::class,
                [
                    'class' => Services::class,
                    'choice_label' => 'nom',
                    'expanded'     => false,
                    'multiple'     => true,
                    'by_reference' => false,
                ])
            ->add('logo',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,

                ])

            ->add('save', SubmitType::class, array('label' => 'Create Task'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Worker::class,
        ]);
    }
}
