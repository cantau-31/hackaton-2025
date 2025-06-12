<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Personnel;
use App\Entity\Planning;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('heure')
            ->add('chefChantier')
            ->add('chantier', EntityType::class, [
                'class' => Chantier::class,
                'choice_label' => 'nom',
                'label' => 'Chantier',
            ])
            ->add('employes', EntityType::class, [
                'class' => Personnel::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true, // en checkbox, sinon dropdown
                'label' => 'Employés assignés',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
        ]);
    }
}
