<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Products::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
                    TextField::new('name'),
                    SlugField::new('slug') ->setTargetFieldName('name'),
                    ImageField::new('Illustration')
                    ->setBasePath('upload/')
                    ->setUploadDir('public/upload/')
                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                    ->setRequired(false),
                    TextField::new('description'),
                    TextField::new('allergenes'),
                    MoneyField::new('prix')
                    ->setCurrency('EUR')
                    ->setCustomOption('storedAsCents', false),
                   AssociationField::new('category'),
        ];
    }

}
