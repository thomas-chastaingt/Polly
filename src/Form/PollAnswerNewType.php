<?php

namespace App\Form;

use App\Entity\Polls;
use App\Entity\PollAnswers;
use App\Entity\Options;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PollAnswersNewType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id= $builder->getData()->getPoll()->getId();
        $builder
            ->add('option', EntityType::class, array(
                'class' => Options::class,
                'query_builder' => function(EntityRepository $er) use ($id) {
                    return $er->createQueryBuilder('c')
                            ->where('c.polls = :id')
                            ->setParameter('id', $id)
                        ;
                },
            ))
            ->add('department')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PollAnswers::class,
        ]);
    }
}