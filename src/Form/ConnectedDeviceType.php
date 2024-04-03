<?php

namespace App\Form;

use App\Entity\ConnectedDevice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\Timer; 
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;


class ConnectedDeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('deviceId', TypeTextType::class, ['attr' => ['class' => 'form-control']])
            ->add('name', TypeTextType::class, ['attr' => ['class' => 'form-control']])
            ->add('location', TypeTextType::class, ['attr' => ['class' => 'form-control']])
           /*  ->add('timers', EntityType::class, [
                'class' => Timer::class,
                'choice_label' => function (Timer $timer) {
                    return sprintf('%s - %s', $timer->getStartTime()->format('Y-m-d H:i:s'), $timer->getEndTime()->format('Y-m-d H:i:s'));
                },
                'multiple' => true,
                
                //'required' => false,
                
            ]); */
            ->add('timer', EntityType::class, [
                'class' => Timer::class,
                'choice_label' => function (Timer $timer) {
                    return sprintf('%s - %s', $timer->getStartTime()->format('Y-m-d H:i:s'), $timer->getEndTime()->format('Y-m-d H:i:s'));
                },
                'placeholder' => 'Select a timer', // Texte par défaut affiché dans le champ
                'required' => false, // Permet de ne pas rendre le champ obligatoire
                // Vous pouvez ajouter d'autres options selon vos besoins
            ])
            ->add('isOn', CheckboxType::class, [
                'label' => 'Is On',
                'required' => false, // Le champ n'est pas obligatoire
                'attr' => [
                    'class' => 'form-check-input', // Ajout de classes CSS Bootstrap
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConnectedDevice::class,
        ]);
    }
}
