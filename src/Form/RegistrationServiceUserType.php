<?php

namespace App\Form;

use App\Entity\CodePostal;
use App\Entity\Localite;
use App\Entity\ServiceUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationServiceUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresseNumber',IntegerType::class)
            ->add('adresseStreet',TextType::class)
            //->add('banned')
            //->add('inscribe')
            //->add('inscribeDate')
            ->add('password',PasswordType::class, [
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
            //->add('nbTry')
            ->add('email',EmailType::class)
           // ->add('roles')
            ->add('newsletter', CheckboxType::class, [
               'label'    => 'Ok Newsletter?',
               'required' => false,
           ])
            ->add('name',TextType::class)
            ->add('surname', TextType::class)
            ->add('postCode',  EntityType::class, ['class'=>CodePostal::class,'choice_label'=>'postCode'])
            ->add('city', EntityType::class, ['class'=>Localite::class,'choice_label'=>'city'])
            ->add('logo',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'entry_options' => ['label' => false],
                    'allow_add' => true,
                ])
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServiceUser::class,
        ]);
    }
}
