<?php

namespace ProAddress\AnnonceBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('date')
            ->add('titre')
            ->add('detail')
            ->add('prix')
            ->add('contact')
            ->add('expiration')
            ->add('acategorie', EntityType::class, array(
                'class'=>'ProAddressAnnonceBundle:ACategorie',
                'choice_label'=>'nom'
            ))
            ->add('pays', EntityType::class, array(
                'class'=>'ProAddressAppBundle:Pays',
                'choice_label'=>'nom'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProAddress\AnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proaddress_annoncebundle_annonce';
    }


}
