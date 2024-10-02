<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Form;

use App\Entity\Conference;
use App\Entity\Talk;
use App\Enum\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class TalkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('conference', EntityType::class, [
                'class' => Conference::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a conference',
            ])
            ->add('track', EnumType::class, [
                'class' => Track::class,
                'placeholder' => 'Select a track',
            ])
            ->add('speakers', LiveCollectionType::class, [
                'entry_type' => SpeakerAutocompleteType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'app.ui.speakers',
            ])
            ->add('description')
            ->add('startsAt', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('endsAt', DateTimeType::class, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Talk::class,
        ]);
    }
}
