<?php

namespace ProAddress\RecrutementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecrutementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date')->add('titre')->add('poste')->add('dossier')->add('lieudepot')->add('expireDate')->add('lieuTravail')->add('email')->add('tel')->add('telCandidat')->add('structure')->add('eenvoie')->add('pays')->add('envoieEmail');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProAddress\RecrutementBundle\Entity\Recrutement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proaddress_recrutementbundle_recrutement';
    }


}
