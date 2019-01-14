<?php

namespace App\Form;

use App\Entity\Worker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionWorkerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adresseNumber')
            ->add('adresseStreet')
            ->add('password')
            ->add('email')
            ->add('emailPublic')
            ->add('name')
            ->add('phoneNumber')
            ->add('tvaNb')
            ->add('webSite')
            ->add('postCode')
            ->add('city')
            ->add('services')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Worker::class,
        ]);
    }
}
