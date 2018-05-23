<?php

namespace ProAddress\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise', TextType::class, array(
                'label'=>'Nom de l\'entreprise'
            ))
            ->add('specialite', TextType::class, array(
                'label'=>'Spécialité'
            ))
            ->add('contact')
            ->add('email', EmailType::class)
            ->add('detail', TextareaType::class, array(
                'label'=>'Détails'
            ))
            ->add('nomrespo', TextType::class, array(
                'label'=>'Responsable'
            ))
            ->add('online')
            ->add('scategories', EntityType::class, array(
                'class'=>'ProAddressServiceBundle:SCategorie',
                'choice_label'=>'nom',
                    'multiple'=>true,
                    'expanded'=>true,
                'label'=>'Domaine')
            )
            ->add('pays', EntityType::class, array(
                'class'=>'ProAddressAppBundle:Pays',
                'choice_label'=>'nom')
            );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProAddress\ServiceBundle\Entity\Service'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proaddress_servicebundle_service';
    }


}
