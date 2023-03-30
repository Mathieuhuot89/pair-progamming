<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud  
            ->setEntityLabelInPlural('Commandes')
            ->setEntityLabelInSingular('Commande')
            ->setPageTitle('index', 'Toutes les commandes');
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            NumberField::new('montant'),
            NumberField::new('nbJourLoc'),
            DateTimeField::new('jourDepart'),
            DateTimeField::new('jourArrive'),
            DateTimeField::new('createdAt'),
            AssociationField::new ('user')
            ->setFormTypeOptions(['by_reference' => true]),
            //updateEntity
        ];
        
    }
    
}
