<?php

namespace App\Form;

use App\Entity\Task;
use App\Enums\TaskStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de la tâche',
                'attr'  => ['placeholder' => 'Ex: Faire les courses'],
            ])
            ->add('status', EnumType::class, [
                'class'        => TaskStatus::class,
                'label'        => 'Statut',
                'choice_label' => fn(TaskStatus $s) => ucfirst($s->value),
            ])
            ->add('priority', EntityType::class, [
                'class'        => \App\Entity\Priority::class,
                'choice_label' => 'name',
                'label'        => 'Priorité',
                'placeholder'  => 'Sélectionner une priorité',
                'required'     => false,
            ])
            ->add('folder', EntityType::class, [
                'class'        => \App\Entity\Folder::class,
                'choice_label' => 'name',
                'label'        => 'Dossier (optionnel)',
                'placeholder'  => 'Sélectionner un dossier',
                'required'     => false,
            ])
            ->add('isPinned', CheckboxType::class, [
                'label'    => 'Épingler la tâche',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class, // ← manquait, lie le form à l'entité
        ]);
    }
}