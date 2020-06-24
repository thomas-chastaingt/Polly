<?php

namespace App\Form;
use App\Entity\Polls;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\OptionsType;


class PollsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('hide')
            ->add('country')    
        ;
        $builder->add('options', OptionsType::class, array(
            'data_class'   =>  null,
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Polls::class,
        ]);
    }
}
