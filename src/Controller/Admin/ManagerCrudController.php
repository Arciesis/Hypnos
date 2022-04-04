<?php

namespace App\Controller\Admin;

use App\Entity\Establishment;
use App\Entity\Manager;
use App\Form\Type\EstablishmentType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ManagerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Manager::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('Email'),
            TextField::new('Firstname'),
            TextField::new('Lastname'),
            AssociationField::new('establishment', 'Establishment'),
            /*CollectionField::new('Establishment')
                ->allowAdd()
                ->setEntryIsComplex(true)
                ->showEntryLabel()
                ->setEntryType(EstablishmentType::class)*/
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->renderContentMaximized()
            ->setEntityLabelInSingular('Manager')
            ->setEntityLabelInPlural('Managers');
    }
}
