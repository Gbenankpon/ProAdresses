<?php

namespace ProAddress\AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date')
            ->add('enseigne')
            ->add('adresse')
            ->add('ville')
            ->add('departement')
            ->add('region')
            ->add('tel')
            ->add('email')
            //->add('online')
            ->add('pays', EntityType::class, array(
                'class'=>'ProAddressAppBundle:Pays',
                'choice_label'=>'nom')
            )
            ->add('categorie', EntityType::class, array(
                'class'=>'ProAddressAppBundle:Categorie',
                'choice_label'=>'nom')
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProAddress\AppBundle\Entity\Structure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proaddress_appbundle_structure';
    }


}
