<?php

namespace App\Controller\Admin;

use App\Entity\Projets;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjetsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projets::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            ImageField::new('imageName')
            ->setBasePath('upload/projets/')
            ->setUploadDir('public/upload/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
   
}
