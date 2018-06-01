<?php

namespace ProAddress\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                  'choices'=>array(
                      'Slide'=>'slide',
                      'Pub'=>'pub'
                  )
            ))
            ->add('nom', ChoiceType::class, array(
                'choices'=>array(
                    'Slide1'=>'slide1',
                    'Slide2'=>'slide2',
                    'slide3'=>'slide3',
                    'slide4'=>'slide4',
                    'slide5'=>'slide5',
                    'Pub'=>'pub'
                )
            ))
            ->add('file', FileType::class, array(
                'label'=>'Image'
            ))
            ->add('legende')
            ->add('legendetitre')
            ->add('legendeslogan')
            ->add('legendedescription')
            ->add('legendeadresse');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProAddress\AppBundle\Entity\Image'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'proaddress_appbundle_image';
    }


}
