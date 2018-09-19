<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegister extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('role', ChoiceType::class, array('choices'=>array('Administrador'=>'ROLE_ADMIN', 'Usuario'=>'ROLE_USER')))
            ->add('plainpassword', RepeatedType::class, array(
                'type'=>PasswordType::class, 'required'=>false,
                'first_options'=> array('label'=>'Contraseña'),
                'second_options'=>array('label'=>'Repetir Contraseña')
            ))
        ->add('isActive', CheckboxType::class, array('required'=>false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>User::class));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_user';
    }
}
