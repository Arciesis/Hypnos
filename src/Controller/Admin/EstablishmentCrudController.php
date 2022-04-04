<?php

namespace App\Controller\Admin;

use App\Entity\Establishment;
use App\Entity\Manager;
use App\Entity\Suite;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EstablishmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Establishment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Name'),
            TextField::new('city', 'City'),
            TextField::new('address', 'Address'),
            TextEditorField::new('description', 'Description'),
            AssociationField::new('manager', 'Manager')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->renderContentMaximized()
            ->setEntityLabelInSingular('Establishment')
            ->setEntityLabelInPlural('Establishments');
    }
}
