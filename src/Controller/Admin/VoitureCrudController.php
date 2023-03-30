<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Voitures')
            ->setEntityLabelInSingular('Voiture')
            ->setPageTitle('index', 'Toutes les voitures');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('title'),
            // TextEditorField::new('description'),
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('nom'),
            TextField::new('couleur'),
            TextField::new('slug'),
            NumberField::new('prixJournalier'),
            NumberField::new('stock'),
            ImageField::new('imageUrl')
                ->setBasePath('public/assets/images/')
                ->setUploadDir('public/assets/images/')
                ->setUploadedFileNamePattern('[year]/[month]/[day]/[slug]-[contenthash].[extension]'),
            DateTimeField::new('createdAt'),
            TextEditorField::new('description'),
            // AssociationField::new('marque')
            // ->setFormTypeOptions(['by_reference' => true]),
            AssociationField::new('marque')
                ->setFormTypeOptions([
                    'class' => 'App\Entity\Marque',
                    'choice_label' => 'nom',
                    'placeholder' => 'Sélectionnez une marque',
                ])
        ];
    }
}
