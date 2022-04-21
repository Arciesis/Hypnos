<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use App\Entity\Suite;
use App\Form\Type\GalleryType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SuiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suite::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $pageName = "detail";

        return [
            $pageName,
            TextField::new('Title'),
            TextareaField::new('Description')->hideOnIndex(),
            IntegerField::new('Price')->onlyWhenCreating(),
            TextField::new('linkToBookingCom', 'Link to booking.com'),
            TextField::new('frontImageFile', 'Front image')->setFormType(VichImageType::class)->hideOnIndex(),
            CollectionField::new('gallery', 'Gallery of images')
                ->setEntryType(GalleryType::class)
                ->hideOnIndex()
                ->setTemplatePath(
                    'backoffice/custom-gallery-rendering.html.twig'
                )
            ->setFormTypeOption('by_reference', false)
            ,
        ];
        // TODO create an assert to validate the link probably with some regex
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular('Suite')
            ->setEntityLabelInPlural('Suites')
            ->setPageTitle(Crud::PAGE_DETAIL, fn(Suite $suite) => $suite->__toString()."details")
            ;
    }

    public function configureResponseParameters(KeyValueStore $responseParameters): KeyValueStore
    {
        if ($responseParameters->has('pageName')) {
            if ($responseParameters->get('pageName') === Crud::PAGE_DETAIL) {
                $responseParameters->set('suite', $responseParameters->get('entity'));
                $responseParameters->set('templateName', 'custom-gallery-rendering.html.twig');
                $responseParameters->set('templatePath', 'backoffice/custom-gallery-rendering.html.twig');
                // dd($responseParameters);
            }
        }

        return $responseParameters;
    }

    public function configureActions(Actions $actions): Actions
    {
        /*if ($actions->getAsDto(Crud::PAGE_DETAIL)) {
            return $actions->set(Crud::PAGE_INDEX, Crud::PAGE_DETAIL);
        }*/
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }

}
