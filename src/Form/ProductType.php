<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name", TextType::class, [
                "label" => "Nom du produit",
                "attr" => ["placeholder" => "Tapez le nom du produit"]
            ])
            ->add("shortDescription", TextareaType::class, [
                "label" => "Courte Description",
                "attr" => ["placeholder" => "Tapez une description courte mais parlante pour le visiteur"]
            ])
            ->add("price", MoneyType::class, [
                "label" => "Prix du produit",
                "attr" => ["placeholder" => "Tapez le prix du produit en €"]
            ])
            ->add("mainPicture", UrlType::class, [
                "label" => "Image du produit",
                "attr" => ["placeholder" => "Taper un URL d'image"]
            ])
            ->add("category", EntityType::class, [
                "label" => "Catégorie",
                "placeholder" => "-- Choisir une catégorie --",
                "class" => Category::class,
                "choice_label" => function (Category $category) { // Cette fonction permet d'ecrire les nom de catégorie en majuscule et d'aller chercher les catégories dans la base de données
                    return strtoupper($category->getName());
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}