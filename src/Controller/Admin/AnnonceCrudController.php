<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType ; 

class AnnonceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonce::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
          
            TextField::new('titre'),
            TextField::new('description'),
            TextField::new('salaire'),
            TextField::new('adresse'),
            ImageField::new('image')->setBasePath('uploads/images/annoc/')->setUploadDir('public/uploads/images/annoc'),
           

        ];
    }
    
}