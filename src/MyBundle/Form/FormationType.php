<?php

namespace MyBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
class FormationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFormation')
            ->add('duree')
            ->add('prix')
            ->add('captcha', CaptchaType::class)
            ->add('matiere',ChoiceType::class,array(
                'choices'=>array(
                'Math'=>'Math',
                'UML'=>'UML',
                'JAVA'=>'JAVA',
                'SYMFONY'=>'SYMFONY',

                )


            ) );
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyBundle\Entity\Formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mybundle_formation';
    }


}
