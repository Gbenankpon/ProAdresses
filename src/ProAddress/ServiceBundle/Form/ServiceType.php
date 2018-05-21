<?php

namespace ProAddress\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entreprise')
            ->add('specialite')
            ->add('contact')
            ->add('detail')
            ->add('nomrespo')
            //->add('date')
            //->add('online')
            ->add('scategories', EntityType::class, array(
                'class'=>'ProAddressServiceBundle:SCategorie',
                'choice_label'=>'nom',
                    'multiple'=>true,
                    'expanded'=>true)
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
