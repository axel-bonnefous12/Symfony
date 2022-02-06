<?php

namespace App\Form;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bands;
use App\Entity\Concerts;
use App\Entity\ConcertsType;
use App\Entity\Rooms;
use App\Entity\Organisations;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class ConcertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('begin', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('end', DateType::class, [
                'widget' => 'choice',
                'format' => 'dd / MM / yyyy'
            ])
            ->add('room', EntityType::class,
                ['class' => Rooms::class,
                    'choice_label' => 'name'
                ])
            ->add('organisation', EntityType::class,
                ['class' => Organisations::class,
                    'choice_label' => 'firstName',
                ])
            ->add('band', EntityType::class,
                ['class' => Bands::class,
                    'choice_label' => 'name'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Concerts::class,
        ]);
    }
}