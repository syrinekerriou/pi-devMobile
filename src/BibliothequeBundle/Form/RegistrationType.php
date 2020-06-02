<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 13/02/2019
 * Time: 01:03
 */

namespace MyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder->add('username');
        $builder->add('email');
        $builder->add('nom');
        $builder->add('prenom');
        $builder->add('password', PasswordType::class);
        $builder->add('plainPassword', PasswordType::class);
        $builder->add('datenaissance');
        $builder->add('circuitscolaire', ChoiceType::class, array('label' => 'Type ',
            'choices' => array('bac' => 'bac',
                'diplome' => 'diplome'),
            'required' => true, 'multiple' => false));
        $builder->add('diplome');
        $builder->add('nbrheure');
        $builder->add('frais');
        $builder->add('salaire');
        $builder->add('section', ChoiceType::class, array('label' => 'Type ',
            'choices' => array('cycle ingenieure' => 'ingenieur',
                'cycle prepartoire' => 'prepa'),
            'required' => true, 'multiple' => true));
        $builder->add('formation' );
    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    public function  getBlockPrefix()
    {
        return 'app_user_registration';
    }
    public function  getName()
    {
        return $this->getBlockPrefix();
    }

}