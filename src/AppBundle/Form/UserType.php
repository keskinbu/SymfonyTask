<?php

namespace AppBundle\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $form = $builder
            ->add('userName', 'text', array('label' => false, 'attr' => array('placeholder' => 'Kullanıcı Adı', 'class' => 'form-control')))
            ->add('email', 'email', array('label' => false, 'attr' => array('placeholder' => 'Email', 'class' => 'form-control')))
            ->add('password', 'email', array('label' => false, 'attr' => array('placeholder' => 'Email', 'class' => 'form-control')))
            ->add('Kaydet', 'submit', array('attr' => array('class' => 'btn btn-lg btn-primary btn-block')))
            ->getForm();
        return $form;
    }

    public function getName()
    {
        return 'admin_user_type';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }
}