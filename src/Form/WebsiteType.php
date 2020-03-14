<?php

namespace App\Form;

use App\Entity\Website;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebsiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // UrlType::class convertit chaque entree en un format URL
        $builder
            ->add('url', TextType::class, [
                'label' => 'Url du site web',
                'attr' => [
                    'placeholder' => 'Entrer une URL valide : http://site.fr'
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du site',
                'attr' => [
                    'placeholder' => 'Entrer le nom du site en question'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder ce site'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Website::class,
        ]);
    }
}
